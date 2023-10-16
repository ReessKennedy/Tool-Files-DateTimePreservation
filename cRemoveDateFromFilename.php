<?php

// Function to remove prepended or appended date values from a file
function removeDateFromFilename($filePath, $position) {
    $fileInfo = pathinfo($filePath);
    $fileName = $fileInfo['filename'];
    
    if ($position === 'start') {
        $newFileName = preg_replace('/^.*?_/', '', $fileName); // Remove everything before the first underscore
    } elseif ($position === 'end') {
        $newFileName = preg_replace('/_[^_]*$/', '', $fileName); // Remove everything after the last underscore
    }
    
    $newFileName = $newFileName . '.' . $fileInfo['extension'];
    
    if (rename($filePath, $fileInfo['dirname'] . '/' . $newFileName)) {
        echo "Date removed from: $newFileName\n";
    } else {
        echo "Failed to remove date from: $filePath\n";
    }
}

// Function to recursively process files in a directory
function processFilesInDirectory($directory, $position) {
    $files = scandir($directory);
    
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $filePath = $directory . '/' . $file;
            
            if (is_dir($filePath)) {
                processFilesInDirectory($filePath, $position); // Recurse into subdirectories
            } else {
                removeDateFromFilename($filePath, $position);
            }
        }
    }
}

// Get the directory path from the user
echo "Enter the directory path: ";
$directoryPath = trim(fgets(STDIN));

if (is_dir($directoryPath)) {
    echo "Remove date from the start or end of the file? (start/end): ";
    $position = trim(fgets(STDIN));
    
    if ($position === 'start' || $position === 'end') {
        processFilesInDirectory($directoryPath, $position);
        echo "Date removed from filenames in the directory and its subdirectories.\n";
    } else {
        echo "Invalid position. Please enter 'start' or 'end'.\n";
    }
} else {
    echo "Invalid directory path.\n";
}