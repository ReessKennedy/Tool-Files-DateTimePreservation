<?php

include('-config.php');


function searchFileAndGetCreationDate($directory, $filename) {
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory), RecursiveIteratorIterator::SELF_FIRST);

    foreach ($iterator as $fileInfo) {
        if ($fileInfo->isFile() && $fileInfo->getFilename() === $filename) {
            return [
                'creationDate' => $fileInfo->getCTime(), // Creation date in Unix timestamp format
                'filepath' => $fileInfo->getPathname(), // Filepath
            ];
        }
    }

    return ['creationDate' => null, 'filepath' => null]; // File not found
}

// Open input and output CSV files
$inputCSV = fopen($inputCSVFile, 'r');
$outputCSV = fopen($outputCSVFile, 'w');


if ($inputCSV && $outputCSV) {
    // Write headers to the output CSV
    fputcsv($outputCSV, ['Filename', 'Filepath', 'Creation Date (YYYY-MM-DD HH:MM:SS)']);

    // Read and process each line of the input CSV
    while (($data = fgetcsv($inputCSV)) !== false) {
        $filename = $data[0];

        // Search for the file in the specified directory and get its creation date and filepath
        $result = searchFileAndGetCreationDate($searchDirectory, $filename);

        if ($result !== null) {
            $creationDate = $result['creationDate'];
            $filepath = $result['filepath'];

            // Format the creation date as YYYY-MM-DD HH:MM:SS
            $formattedCreationDate = $creationDate ? date('Y-m-d H:i:s', $creationDate) : 'Not found';

            // Write the data to the output CSV
            fputcsv($outputCSV, [$filename, $filepath, $formattedCreationDate]);
        }
    }

    // Close input and output CSV files
    fclose($inputCSV);
    fclose($outputCSV);

    echo "CSV processing complete. Output saved to $outputCSVFile\n";
} else {
    echo "Error opening CSV files\n";
}