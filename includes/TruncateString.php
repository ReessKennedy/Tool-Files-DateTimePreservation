<?php

function truncateString($inputString, $maxLength) {
    // Check if the input string is longer than the maximum length
    if (strlen($inputString) > $maxLength) {
        // If it is, truncate the string and return the last $maxLength characters
        return substr($inputString, -1 * $maxLength);
    } else {
        // If the string is shorter than or equal to the maximum length, return the original string
        return $inputString;
    }
}