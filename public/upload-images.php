<?php

// Prevent direct warning/notice outputs from breaking JSON structure
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Increase execution time limit to 5 minutes
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
    Log::warning('Unexpected bootstrap output in upload-images.php: ' . $bootstrapOutput);
}

header('Content-Type: application/json');

// Enforce authentication
if (!Auth::check()) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Unauthorized access. Please log in first.'
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method. Only POST requests are allowed.'
    ]);
    exit;
}

if (!isset($_FILES['image_files']) || !is_array($_FILES['image_files']['name'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No files uploaded or invalid request format.'
    ]);
    exit;
}

$uploadedFiles = $_FILES['image_files'];
$fileCount = count($uploadedFiles['name']);

if ($fileCount === 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'No files selected for upload.'
    ]);
    exit;
}

$validatedFiles = [];
$maxSize = 10 * 1024 * 1024; // 10MB limit per image

// 1. First Pass: Validate all files before moving any of them
for ($i = 0; $i < $fileCount; $i++) {
    if ($uploadedFiles['error'][$i] !== UPLOAD_ERR_OK) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Upload error occurred for file: ' . $uploadedFiles['name'][$i] . '. Error Code: ' . $uploadedFiles['error'][$i]
        ]);
        exit;
    }

    $name = $uploadedFiles['name'][$i];
    $tmpPath = $uploadedFiles['tmp_name'][$i];
    $size = $uploadedFiles['size'][$i];

    // Enforce 10MB limit
    if ($size > $maxSize) {
        echo json_encode([
            'status' => 'error',
            'message' => 'File size for "' . $name . '" exceeds the 10MB limit. Upload aborted.'
        ]);
        exit;
    }

    // Verify MIME-type is strictly an image
    $mimeType = '';
    if (function_exists('finfo_open')) {
        $finfo = @finfo_open(FILEINFO_MIME_TYPE);
        if ($finfo) {
            $mimeType = @finfo_file($finfo, $tmpPath);
            @finfo_close($finfo);
        }
    }
    if (empty($mimeType) && function_exists('mime_content_type')) {
        $mimeType = @mime_content_type($tmpPath);
    }
    if (empty($mimeType)) {
        // Fallback check based on extension
        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
            $mimeType = 'image/' . ($ext === 'jpg' ? 'jpeg' : $ext);
        }
    }

    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mimeType, $allowedMimeTypes)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'File "' . $name . '" is not a supported image format. Only JPEG, PNG, GIF, and WEBP are allowed.'
        ]);
        exit;
    }

    $validatedFiles[] = [
        'name' => $name,
        'tmp_path' => $tmpPath,
        'extension' => strtolower(pathinfo($name, PATHINFO_EXTENSION))
    ];
}

// 2. Sort files naturally by original filename to preserve reader order
usort($validatedFiles, function ($a, $b) {
    return strnatcasecmp($a['name'], $b['name']);
});

// 3. Save files to unique destination folder
$uniqueId = 'book_' . uniqid();
$destDir = public_path('uploads/flipbooks/' . $uniqueId);

if (!file_exists($destDir)) {
    if (!mkdir($destDir, 0755, true)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to create destination directory.'
        ]);
        exit;
    }
}

$generatedPages = [];
foreach ($validatedFiles as $index => $file) {
    $pageNumber = $index + 1;
    $pageName = "page_{$pageNumber}.{$file['extension']}";
    $outputPath = $destDir . DIRECTORY_SEPARATOR . $pageName;

    if (move_uploaded_file($file['tmp_path'], $outputPath)) {
        $generatedPages[] = "uploads/flipbooks/{$uniqueId}/{$pageName}";
    } else {
        deleteDir($destDir);
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to write file: ' . $file['name']
        ]);
        exit;
    }
}

echo json_encode([
    'status' => 'success',
    'pages' => $generatedPages
]);

function deleteDir($dirPath) {
    if (!is_dir($dirPath)) return;
    $files = array_diff(scandir($dirPath), array('.', '..'));
    foreach ($files as $file) {
        (is_dir("$dirPath/$file")) ? deleteDir("$dirPath/$file") : @unlink("$dirPath/$file");
    }
    return @rmdir($dirPath);
}

exit;
