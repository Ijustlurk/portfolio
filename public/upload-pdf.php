<?php

// Prevent direct warning/notice outputs from breaking JSON structure
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Increase execution time limit to 5 minutes for converting larger PDFs
set_time_limit(300);

// Start output buffering to prevent any bootstrap notices from sending headers early
ob_start();

// Bootstrap Laravel to access configuration, environment, and user session
require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$app->instance('request', $request);
$kernel->bootstrap();

// Decrypt cookies so Laravel session/auth can read them correctly in this standalone script
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Cookie\CookieValuePrefix;

$encrypter = $app['encrypter'];
foreach ($request->cookies as $key => $cookie) {
    try {
        $decrypted = $encrypter->decrypt($cookie, false);
        $validated = CookieValuePrefix::validate($key, $decrypted, $encrypter->getAllKeys());
        $request->cookies->set($key, $validated);
    } catch (DecryptException $e) {
        // Ignore unencrypted cookies
    }
}

// Boot sessions and authenticate
$session = $app['session']->driver();
$session->setId($request->cookies->get($session->getName()));
$request->setLaravelSession($session);
$request->session()->start();

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

// Clean and log any bootstrap outputs
$bootstrapOutput = ob_get_clean();
if (!empty($bootstrapOutput)) {
    Log::warning('Unexpected bootstrap output in upload-pdf.php: ' . $bootstrapOutput);
}

if (headers_sent($sentFile, $sentLine)) {
    Log::error("Headers already sent in $sentFile on line $sentLine. Captured output: " . var_export($bootstrapOutput, true));
} else {
    header('Content-Type: application/json');
}

// Check if test local mode is enabled and allowed
$isLocalTest = isset($_GET['test_local']) && $_GET['test_local'] == 1 && App::environment('local');

// Enforce authentication unless in local test mode
if (!$isLocalTest && !Auth::check()) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Unauthorized access. Please log in first.'
    ]);
    exit;
}

$uniqueId = 'book_' . uniqid();
$destDir = public_path('uploads/flipbooks/' . $uniqueId);
$pdfPath = '';

// Intake & validate file
if ($isLocalTest) {
    // Process local test file
    $localPdf = storage_path('app/public/comics/AQUA NL sd.pdf');
    if (!file_exists($localPdf)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Test PDF file not found at storage/app/public/comics/AQUA NL sd.pdf'
        ]);
        exit;
    }
    $pdfPath = $localPdf;
} else {
    // Standard file upload validation
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid request method. Only POST requests are allowed.'
        ]);
        exit;
    }

    if (!isset($_FILES['pdf_file']) || $_FILES['pdf_file']['error'] !== UPLOAD_ERR_OK) {
        $errorCode = isset($_FILES['pdf_file']) ? $_FILES['pdf_file']['error'] : 'file_missing';
        echo json_encode([
            'status' => 'error',
            'message' => 'No file uploaded or upload error occurred. Code: ' . $errorCode
        ]);
        exit;
    }

    $uploadedFile = $_FILES['pdf_file'];
    $tempPath = $uploadedFile['tmp_name'];
    $fileSize = $uploadedFile['size'];

    // Limit maximum file size (50MB)
    $maxSize = 50 * 1024 * 1024;
    if ($fileSize > $maxSize) {
        echo json_encode([
            'status' => 'error',
            'message' => 'File size exceeds the maximum limit of 50MB.'
        ]);
        exit;
    }

    // Strict mime-type verification with fallback
    $mimeType = '';
    if (function_exists('finfo_open')) {
        $finfo = @finfo_open(FILEINFO_MIME_TYPE);
        if ($finfo) {
            $mimeType = @finfo_file($finfo, $tempPath);
            @finfo_close($finfo);
        }
    }
    
    if (empty($mimeType) && function_exists('mime_content_type')) {
        $mimeType = @mime_content_type($tempPath);
    }
    
    if (empty($mimeType)) {
        // Fallback to extension check if mime-type functions are unavailable
        $ext = strtolower(pathinfo($uploadedFile['name'], PATHINFO_EXTENSION));
        if ($ext === 'pdf') {
            $mimeType = 'application/pdf';
        }
    }

    if ($mimeType !== 'application/pdf') {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid file type. Only PDF documents are accepted.'
        ]);
        exit;
    }

    $pdfPath = $tempPath;
}

// Create destination directory
if (!file_exists($destDir)) {
    if (!mkdir($destDir, 0755, true)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to create destination directory: ' . $destDir
        ]);
        exit;
    }
}

$generatedPages = [];
$conversionMethod = '';
$conversionError = '';

// Helper to convert PNG to WebP via GD
function convertPngToWebp($sourcePath, $destPath) {
    if (!function_exists('imagecreatefrompng') || !function_exists('imagewebp')) {
        return false;
    }
    $image = @imagecreatefrompng($sourcePath);
    if (!$image) {
        return false;
    }
    imagealphablending($image, false);
    imagesavealpha($image, true);
    $success = @imagewebp($image, $destPath, 85);
    imagedestroy($image);
    if ($success) {
        @unlink($sourcePath); // Clean up PNG file
    }
    return $success;
}

// METHOD 1: Try ImageMagick / Imagick extension
if (class_exists('Imagick')) {
    try {
        $imagick = new Imagick();
        // Set web-optimized resolution (150 DPI)
        $imagick->setResolution(150, 150);
        $imagick->readImage($pdfPath);
        
        $numPages = $imagick->getNumberImages();
        for ($i = 0; $i < $numPages; $i++) {
            $imagick->setIteratorIndex($i);
            $imagick->setImageFormat('webp');
            $imagick->setImageCompressionQuality(85);
            
            $pageName = "page_" . ($i + 1) . ".webp";
            $outputPath = $destDir . DIRECTORY_SEPARATOR . $pageName;
            
            $imagick->writeImage($outputPath);
            $generatedPages[] = "uploads/flipbooks/{$uniqueId}/{$pageName}";
        }
        
        $imagick->clear();
        $imagick->destroy();
        $conversionMethod = 'Imagick PHP extension';
    } catch (Exception $e) {
        $conversionError = 'Imagick failed: ' . $e->getMessage();
        Log::warning('Imagick flipbook conversion failed: ' . $e->getMessage());
    }
}

// METHOD 2: Try pdftoppm (shell execution) if Imagick is unavailable or failed
if (empty($generatedPages)) {
    $pdftoppmPath = 'C:\\Users\\benja\\AppData\\Local\\Microsoft\\WinGet\\Packages\\oschwartz10612.Poppler_Microsoft.Winget.Source_8wekyb3d8bbwe\\poppler-25.07.0\\Library\\bin\\pdftoppm.exe';
    if (!file_exists($pdftoppmPath)) {
        $pdftoppmPath = 'pdftoppm'; // Fallback to system PATH
    }
    $outputPrefix = $destDir . DIRECTORY_SEPARATOR . 'page';

    // Attempt 2A: Direct WebP extraction
    $cmdWebp = sprintf('%s -webp -r 150 %s %s 2>&1', escapeshellarg($pdftoppmPath), escapeshellarg($pdfPath), escapeshellarg($outputPrefix));
    exec($cmdWebp, $outputWebp, $returnCodeWebp);

    if ($returnCodeWebp === 0) {
        $files = glob($destDir . DIRECTORY_SEPARATOR . 'page*.webp');
        if (!empty($files)) {
            natsort($files);
            $files = array_values($files);
            foreach ($files as $index => $file) {
                $pageNumber = $index + 1;
                $newName = "page_{$pageNumber}.webp";
                $newPath = $destDir . DIRECTORY_SEPARATOR . $newName;
                rename($file, $newPath);
                $generatedPages[] = "uploads/flipbooks/{$uniqueId}/{$newName}";
            }
            $conversionMethod = 'pdftoppm shell execution (direct WebP)';
        }
    } else {
        $conversionError .= ' | pdftoppm -webp exit code: ' . $returnCodeWebp . ', output: ' . implode(' ', $outputWebp);
    }
}

// METHOD 3: Try pdftoppm PNG extraction + GD WebP conversion as a final fallback
if (empty($generatedPages)) {
    $outputPrefix = $destDir . DIRECTORY_SEPARATOR . 'page';
    $cmdPng = sprintf('%s -png -r 150 %s %s 2>&1', escapeshellarg($pdftoppmPath), escapeshellarg($pdfPath), escapeshellarg($outputPrefix));
    exec($cmdPng, $outputPng, $returnCodePng);

    if ($returnCodePng === 0) {
        $files = glob($destDir . DIRECTORY_SEPARATOR . 'page*.png');
        if (!empty($files)) {
            natsort($files);
            $files = array_values($files);
            foreach ($files as $index => $file) {
                $pageNumber = $index + 1;
                $webpName = "page_{$pageNumber}.webp";
                $webpPath = $destDir . DIRECTORY_SEPARATOR . $webpName;

                // Convert PNG to WebP via GD
                $success = convertPngToWebp($file, $webpPath);
                if ($success) {
                    $generatedPages[] = "uploads/flipbooks/{$uniqueId}/{$webpName}";
                } else {
                    // Fallback to plain PNG rename if WebP conversion fails
                    $pngName = "page_{$pageNumber}.png";
                    $pngPath = $destDir . DIRECTORY_SEPARATOR . $pngName;
                    rename($file, $pngPath);
                    $generatedPages[] = "uploads/flipbooks/{$uniqueId}/{$pngName}";
                }
            }
            $conversionMethod = 'pdftoppm shell execution (PNG fallback)';
        }
    } else {
        $conversionError .= ' | pdftoppm -png exit code: ' . $returnCodePng . ', output: ' . implode(' ', $outputPng);
    }
}

// Clean up uploaded temp file if not local test
if (!$isLocalTest && file_exists($pdfPath)) {
    @unlink($pdfPath);
}

// Return response or error
if (!empty($generatedPages)) {
    echo json_encode([
        'status' => 'success',
        'method' => $conversionMethod,
        'pages' => $generatedPages
    ]);
} else {
    // Clean up created folder
    if (file_exists($destDir)) {
        deleteDir($destDir);
    }
    // If we get here, all conversion attempts failed
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to convert PDF file. Error Details: ' . trim($conversionError, ' | '),
        'requirements' => 'Ensure ImageMagick PHP extension (with Ghostscript installed) or poppler-utils (pdftoppm) is enabled on the server.'
    ]);
}

function deleteDir($dirPath) {
    if (!is_dir($dirPath)) return;
    $files = array_diff(scandir($dirPath), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$dirPath/$file")) ? deleteDir("$dirPath/$file") : @unlink("$dirPath/$file");
    }
    return @rmdir($dirPath);
}

exit;
