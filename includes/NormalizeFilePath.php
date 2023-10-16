<?php

// Function to sanitize and normalize a file path
function normalizeFilePath($path)
{
    // Remove trailing and leading whitespace and quotes
    $path = trim($path, " \t\n\r\0\x0B\"'");

    // Replace backslashes followed by a space with just a space
    $path = preg_replace('/\\\\ +/', ' ', $path);

    // Normalize directory separators to /
    $path = str_replace('\\', '/', $path);

    // Resolve relative paths
    $path = realpath($path);

    return $path;
}