<?php
$sample_rate = 8000;
$duration = 0.12; // 120 ms
$num_samples = $sample_rate * $duration;

$data = '';
for ($i = 0; $i < $num_samples; $i++) {
    $t = $i / $sample_rate;
    // Frequency drops rapidly from 120Hz to 40Hz
    $freq = 120 - ($t / $duration) * 80;
    // Square wave + simple pseudo-random noise for 8-bit texture
    $val = sin(2 * M_PI * $freq * $t) > 0 ? 0.5 : -0.5;
    
    // Add 8-bit grit/noise
    if (rand(0, 100) > 85) {
        $val += (rand(-50, 50) / 100);
    }
    
    // Clamp to -1..1
    $val = max(-1.0, min(1.0, $val));
    
    // Convert to 8-bit unsigned sample (0..255, silence = 128)
    $sample = (int)(($val + 1.0) * 127.5);
    $data .= chr($sample);
}

// WAV Header
$header = 'RIFF';
$header .= pack('V', 36 + strlen($data)); // Chunk Size
$header .= 'WAVEfmt ';
$header .= pack('V', 16); // Subchunk1 Size
$header .= pack('v', 1); // Audio Format (1 = PCM)
$header .= pack('v', 1); // Num Channels (1 = Mono)
$header .= pack('V', $sample_rate); // Sample Rate
$header .= pack('V', $sample_rate * 1 * 1); // Byte Rate
$header .= pack('v', 1); // Block Align
$header .= pack('v', 8); // Bits Per Sample (8 bits)
$header .= 'data';
$header .= pack('V', strlen($data)); // Subchunk2 Size

$wav = $header . $data;

@mkdir(__DIR__ . '/../public/audio', 0755, true);
file_put_contents(__DIR__ . '/../public/audio/bump.wav', $wav);
echo "WAV generated successfully!";
