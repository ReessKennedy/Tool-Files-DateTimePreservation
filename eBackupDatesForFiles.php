<?php

// Function to get image width if the file is an image
function get_image_width($file_path) {
    $image_formats = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
    $file_extension = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

    if (in_array($file_extension, $image_formats)) {
        list($width, $height) = getimagesize($file_path);
        return $width;
    }

    return null;
}

// Function to gather file information
function gather_file_info($directory_path) {
    $file_info = array();

    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory_path));
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            $file_path = $file->getPathname();
            // Use stat command to get birth (creation) time
            $creation_timestamp = intval(shell_exec('stat -f %B -t %s ' . escapeshellarg($file_path)));
            $creation_date = date('Y-m-d', $creation_timestamp);
            $file_size = filesize($file_path);
            $image_width = get_image_width($file_path);

            $file_info[] = array(
                'FILENAME' => $file->getFilename(),
                'FILEPATH' => $file_path,
                'CreationTimestamp' => $creation_timestamp,
                'CreationDate' => $creation_date,
                'FileSize' => $file_size,
                'ImageWidth' => $image_width,
            );
        }
    }

    return $file_info;
}

// Prompt for the directory path
$directory_path = readline('Enter the directory path: ');

// Get file information
$file_info = gather_file_info($directory_path);

// Prompt for the output CSV file path and filename
$output_path = readline('Enter the output CSV file path and filename (e.g., /path/to/output/filename.csv): ');

// Create a CSV file
$csv = fopen($output_path, 'w');
if (!$csv) {
    die('Error creating the CSV file.');
}

// Write the CSV header
fputcsv($csv, array('FILENAME', 'FILEPATH', 'CreationTimestamp', 'CreationDate', 'FileSize', 'ImageWidth'));

// Write file information to the CSV
foreach ($file_info as $info) {
    fputcsv($csv, $info);
}

fclose($csv);

echo "File information saved to $output_path\n";
