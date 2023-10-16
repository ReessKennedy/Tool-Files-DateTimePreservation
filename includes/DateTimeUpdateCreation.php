<?php

// Function to update the creation date of a file
function updateFileCreationDate($filePath, $newCreationDate)
{
    // Parse the input date string and convert it to a timestamp
    $timestamp = strtotime($newCreationDate);

    // Check if the timestamp is valid (not equal to false)
    if ($timestamp === false) {
        // Date is not properly formatted
        $result = "❌ Inputted time string not properly formatted. ";
    } else {
        $dateTime = new DateTime();
        $dateTime->setTimestamp($timestamp);

        // Format the date and time components
        $formattedDate = $dateTime->format('Y-m-d H:i:s'); // Common and easy to read format

        // Adjust the date format for the touch command
        $touchFormattedDate = $dateTime->format('YmdHi.s'); // Format with optional seconds

        // Escape the shell arguments
        $touchFormattedDate = escapeshellarg($touchFormattedDate);
        $filePath = escapeshellarg($filePath);

        $command = "touch -t $touchFormattedDate $filePath";

        $output = shell_exec($command);

        $result = "✅ $formattedDate"; // Green check emoji and formatted date
    }

    return $result;
}