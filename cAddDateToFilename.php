<?php


// Function to append the creation timestamp to a file
function appendCreationTimestampToFilename($filePath, $dateFormat, $position) {
    $fileInfo = pathinfo($filePath);
    $creationTimestamp = getCreationTimestamp($filePath);
    $formattedTimestamp = date($dateFormat, $creationTimestamp);
    
    if ($position === 'start') {
        $newFileName = $formattedTimestamp . '_' . $fileInfo['filename'] . '.' . $fileInfo['extension'];
    } else {
        $newFileName = $fileInfo['filename'] . '_' . $formattedTimestamp . '.' . $fileInfo['extension'];
    }
    
    if (rename($filePath, $fileInfo['dirname'] . '/' . $newFileName)) {
        echo "Creation timestamp appended to: $newFileName\n";
    } else {
        echo "Failed to append creation timestamp to: $filePath\n";
    }
}

// Function to retrieve the creation timestamp of a file on macOS
function getCreationTimestamp($filePath) {
    $stat = shell_exec("stat -f %B " . escapeshellarg($filePath));
    return (int)$stat;
}

// Function to recursively process files in a directory
function processFilesInDirectory($directory, $dateFormat, $position) {
    $files = scandir($directory);
    
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $filePath = $directory . '/' . $file;
            
            if (is_dir($filePath)) {
                processFilesInDirectory($filePath, $dateFormat, $position); // Recurse into subdirectories
            } else {
                appendCreationTimestampToFilename($filePath, $dateFormat, $position);
            }
        }
    }
}

// Get the directory path from the user
echo "Enter the directory path: ";
$directoryPath = trim(fgets(STDIN));

if (is_dir($directoryPath)) {
    echo "Enter the date format (e.g., yymm, Ym, etc.): ";
    $dateFormat = trim(fgets(STDIN));
    
    echo "Add date to start or end of the file? (start/end): ";
    $position = trim(fgets(STDIN));
    
    if ($position === 'start' || $position === 'end') {
        processFilesInDirectory($directoryPath, $dateFormat, $position);
        echo "Creation timestamps appended to filenames in the directory and its subdirectories.\n";
    } else {
        echo "Invalid position. Please enter 'start' or 'end'.\n";
    }
} else {
    echo "Invalid directory path.\n";
}
