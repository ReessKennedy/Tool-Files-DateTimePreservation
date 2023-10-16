<?php

function extractDateTimeFromString($inputString) {
    // Check if the input string is null or empty
    if ($inputString === null || trim($inputString) === '') {
        return null; // Return null for empty strings or null input
    }

    // Define a more flexible regular expression pattern to capture date and time
    $pattern = "/(\d{4}[-.]\d{2}[-.]\d{2}).*?(\d{1,2}[:.]\d{2}[:.]\d{2}\s*[APap][Mm])/";

    // Perform the regular expression match
    if (preg_match($pattern, $inputString, $matches)) {
        // $matches[1] will contain the date part
        // $matches[2] will contain the time part

        // Convert periods in the time part to colons
        $timePart = str_replace('.', ':', $matches[2]);

        // Combine date and time into a single DateTime string
        $dateTimeValue = $matches[1] . ' ' . $timePart;

        // Create a DateTime object from the extracted value
        $dateTimeObject = date_create_from_format('Y-m-d h:i:s A', $dateTimeValue);
        if ($dateTimeObject !== false) {
            // Format the DateTime for computer understanding
            $formattedDateTime = $dateTimeObject->format('Y-m-d H:i:s');
            return $formattedDateTime;
        }
    }

    // Return null if no DateTime element was found or if the input was empty
    return null;
}