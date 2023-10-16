<?php
/*
What: Add creation date to the filename
How: 

**/


function renameFileWithDate($filePath, $dateFormat, $addToStart)
{
    $fileInfo = pathinfo($filePath);

    // Get the file's creation time as a Unix timestamp
    $creationTime = filectime($filePath);

    if ($creationTime === false) {
        echo "Error: Unable to retrieve file creation time. Exiting the script.\n";
        exit(1);
    }

    // Format the creation time using the user-specified DateTime format
    $datePart = date($dateFormat, $creationTime);

    $newName = $addToStart ? $datePart . '-' . $fileInfo['filename'] : $fileInfo['filename'] . '-' . $datePart;
    $newName = $newName . '.' . $fileInfo['extension'];

    $newPath = $fileInfo['dirname'] . '/' . $newName;

    // Check if the new filename already exists, and rename if necessary
    $counter = 1;
    while (file_exists($newPath)) {
        $newName = $addToStart ? $datePart . '-' . $fileInfo['filename'] : $fileInfo['filename'] . '-' . $datePart;
        $newName = $newName . '-' . $counter . '.' . $fileInfo['extension'];
        $newPath = $fileInfo['dirname'] . '/' . $newName;
        $counter++;
    }

    if (rename($filePath, $newPath)) {
        echo "Renamed: $filePath to $newPath\n";
    } else {
        echo "Failed to rename: $filePath\n";
    }
}

// Prompt the user for the directory to scan
echo "Enter the directory path to scan: ";
$directoryToRename = readline();
$directoryToRename = trim($directoryToRename);

if (!is_dir($directoryToRename)) {
    echo "Directory not found. Exiting the script.\n";
    exit(1);
}

// Prompt the user for the DateTime format
echo "Enter the DateTime format (e.g., 'Y-m-d', 'Ymd', etc.): ";
$dateFormat = readline();

// Prompt the user for whether to add the date to the start or end of the filename
echo "Add date to start or end of filename? (start/end): ";
$addToStart = strtolower(trim(readline())) === 'start';

foreach (glob("$directoryToRename/*") as $filePath) {
    if (is_file($filePath)) {
        renameFileWithDate($filePath, $dateFormat, $addToStart);
    }
}

echo "File renaming process complete.\n";
