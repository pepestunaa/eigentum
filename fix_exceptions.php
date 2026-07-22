<?php
$dir = 'D:/coding/eigentum/app/Http/Controllers';
$files = glob($dir . '/*.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    $original = $content;

    // Pattern for catch (Exception $e) { return $e; }
    // We will use regex to be more robust against whitespace differences
    $pattern = '/catch\s*\(\s*Exception\s+\$e\s*\)\s*\{\s*return\s+\$e;\s*\}/';
    $replacement = 'catch (Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return back()->with(\'error\', \'Terjadi kesalahan pada sistem, silakan coba lagi.\');
        }';

    $content = preg_replace($pattern, $replacement, $content);
    
    // Also handle \Exception if present
    $pattern2 = '/catch\s*\(\s*\\\\Exception\s+\$e\s*\)\s*\{\s*return\s+\$e;\s*\}/';
    $replacement2 = 'catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error($e->getMessage());
            return back()->with(\'error\', \'Terjadi kesalahan pada sistem, silakan coba lagi.\');
        }';

    $content = preg_replace($pattern2, $replacement2, $content);

    if ($original !== $content) {
        file_put_contents($file, $content);
        echo "Fixed exceptions in: " . basename($file) . "\n";
    }
}
