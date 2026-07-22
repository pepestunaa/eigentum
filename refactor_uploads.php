<?php
$dir = 'D:/coding/eigentum/app/Http/Controllers';
$files = glob($dir . '/*.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    $original = $content;

    // Pattern for $var->getClientOriginalName() . "." . $var->getClientOriginalExtension()
    // It captures the variable part before ->getClientOriginalName()
    $pattern = '/(\$[a-zA-Z0-9_]+(?:->\{\$[a-zA-Z0-9_]+\})?)(?:->getClientOriginalName\(\)\s*\.\s*[\'"]\.[\'"]\s*\.\s*\1)?->getClientOriginalExtension\(\)/';
    
    // Wait, the regex needs to be precise. Let's just use simple str_replace for known patterns.
    
    $patterns = [
        '$request->{$image}->getClientOriginalName() . "." . $request->{$image}->getClientOriginalExtension()' => '$request->{$image}->hashName()',
        '$imageField->getClientOriginalName() . "." . $imageField->getClientOriginalExtension()' => '$imageField->hashName()',
        '$file->getClientOriginalName() . "." . $file->getClientOriginalExtension()' => '$file->hashName()',
        '$license->getClientOriginalName() . \'.\' . $license->getClientOriginalExtension()' => '$license->hashName()',
        '$imageFieldName->getClientOriginalName() . "." . $imageFieldName->getClientOriginalExtension()' => '$imageFieldName->hashName()',
        '$fieldName->getClientOriginalName() . "." . $fieldName->getClientOriginalExtension()' => '$fieldName->hashName()',
        'Str::limit($uploadedImage->getClientOriginalName(), 8) . \'.\' . $uploadedImage->getClientOriginalExtension()' => '$uploadedImage->hashName()',
    ];

    $content = str_replace(array_keys($patterns), array_values($patterns), $content);

    if ($original !== $content) {
        file_put_contents($file, $content);
        echo "Refactored: " . basename($file) . "\n";
    }
}
