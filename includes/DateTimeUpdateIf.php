<?php

// Function to check if a string is sufficiently formatted to convert to a timestamp
function DateTime_Format_Check($string)
{
    // Check if the input string is null or empty
    if ($string === null || trim($string) === '') {
        return false; // Return false for empty strings or null input
    }

    // Parse the input date string and convert it to a timestamp
    $timestamp = strtotime($string);

    // Check if the timestamp is valid (not equal to false)
    if ($timestamp === false) {
        // Date is not properly formatted
        $result = false;
    } else {
        // Date is properly formatted
        $result = true;
    }

    return $result;
}