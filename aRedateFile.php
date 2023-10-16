<?php
/*
What: Change the creation date for a file 
How: Run script in terminal. Answer prompts to pass proper variables for path and date. 

**/

// Config
include("-config.php");
// Define the path to your includes directory
$includesDir = __DIR__ . '/includes';
include($includesDir."/NormalizeFilePath.php");
include($includesDir."/DateTimeUpdateCreationSetFile.php");


// Main loop to continue updating files
while (true) {
    // Prompt user for a file path
    echo "Enter a file path (or type 'exit' to quit): ";
    $filePath = readline();

    // Check if the user wants to exit the loop
    if (strtolower(trim($filePath)) === 'exit') {
        break;
    }

    // Normalize and sanitize the file path
    $filePath = normalizeFilePath($filePath);

    // Check if the file exists
    if (file_exists($filePath)) {
        // Get the file's timestamp
        $timestamp = date("Y-m-d H:i:s", filemtime($filePath));

        // Print success message
        echo "✅ File Found! \n🕐 Current DateTime = $timestamp\n";

        // Prompt user for a new creation date
        echo "Enter new creation date and time (e.g., 'tomorrow', '2 days ago', '2023-09-30 15:30:00'): ";
        $newCreationDate = readline();

        // Update the file's creation date
        echo updateFileCreationDate($filePath, $newCreationDate) . "\n";
    } else {
        // Print error message
        echo "❌ - File Not Found!\n";
    }
}

echo "Exiting the script.\n";