<?php
// SetFile will only work on a mac

// Function to update the creation and modification date of a file
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
        $formattedDate = $dateTime->format('m/d/y H:i:s'); // Format as 'YYYY-MM-DD HH:MM:00'

		// Escape the shell arguments
		$formattedDate = escapeshellarg($formattedDate);
		$filePath = escapeshellarg($filePath);

		$command = "SetFile -d $formattedDate -m $formattedDate $filePath";

        $output = shell_exec($command);

        // Check if the command was successful
        if ($output === null) {
            $result = "✅ Success! Creation and modification updated to {$formattedDate}"; // Green check emoji and formatted date
        } else {
            $result = "❌ Failed to update creation and modification date.";
        }
    }

    return $result;
}