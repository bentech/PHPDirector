<?php

// We assume PHP >= 4.0.7 (for version_compare())

// Primitive implementation that only accepts a filename
if (!function_exists('file_get_contents')) {
    function file_get_contents($filename) {
        $handle = fopen($filename, 'rb');
        $contents = '';
        while (!feof($handle)) {
            $contents .= fread($handle, 8192);
        }
        fclose($handle);
        return $contents;
    }
}

// Leave off trailing PHP tag because it isn't needed, and this file should
// always be included anyway. This helps prevent against whitespace mistakes
// that can bother sessions