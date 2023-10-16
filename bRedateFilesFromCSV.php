<?php


// Define the CSV file path
// This should be an absolute path if running in the terminal

// Config
include("-config.php");
$includesDir = __DIR__ . '/includes';
include($includesDir."/NormalizeFilePath.php");
include($includesDir."/DateTimeUpdateCreationSetFile.php");
require($includesDir."/TruncateString.php");
require($includesDir."/ExtractDateTimeFromImageName.php");
require($includesDir."/DateTimeUpdateIf.php");


// Check if the file exists
if (!file_exists($csvFilePath)) {
    die("CSV file not found.");
}

// Open the CSV file for reading
$file = fopen($csvFilePath, "r");

// Check if the file was opened successfully
if ($file === false) {
    die("Unable to open CSV file.");
}



// Output table header
echo "+----------------------------+--------------------------------------------------------+\n";
echo "| NewDate                    | Path                                                   |\n";
echo "+----------------------------+--------------------------------------------------------+\n";

// Loop through each row in the CSV file
while (($data = fgetcsv($file)) !== false) {
	

    // Ensure that the row has exactly 2 columns (NewDate and Path)
    if (count($data) === 2) {
        
		
		// Dates
		$csvdateinput = $data[0];
		
		
		$status = DateTime_Format_Check($csvdateinput);

		
        $path = $data[1];
        
        // Get the filename and the last three folders of the path
        $parts = explode('/', $path);
        $filename = end($parts);
        $truncatedPath = '...' . implode('/', array_slice($parts, -3));

        // Normalize and sanitize the file path
        $normalizedPath = normalizeFilePath($path);

        // Check if the file exists and set the status icon
        $pathexists = file_exists($normalizedPath) ? '✅' : '❌';

        // Concatenate the path and status icon
        // $output = "$truncatedPath $statusIcon";
		



        // Update the file creation date if the file exists
        	if ($pathexists === '✅') {
            // $updateResult = updateFileCreationDate($normalizedPath, $newDate);			
			//	$dateresult =  "$newDate";
			

			
			if ($status == true) {
			
				// Update
			
				$finalstatus = '✅✅ Cell value';
				
				$corrected = updateFileCreationDate($normalizedPath, $csvdateinput);
			
			} else {
			
				$extracteddatetime = extractDateTimeFromString($csvdateinput);
			
				$status = DateTime_Format_Check($extracteddatetime);
			
				if ($status == true) {
				
					$finalstatus = '✅ Extracted!';
					
					$corrected = updateFileCreationDate($normalizedPath, $extracteddatetime);
					
	
			
				} else {
				
					$finalstatus = '❌ No DateTime Recognized';
				}	
			
			}

			
        } else {
        	$finalstatus =  "❌";
        }
		
	
		
		// $dateresult = truncateString($dateresult, '25');
		$output = truncateString($truncatedPath, '50');
		
	
        // Print the data in a single column
        printf("| %-26s | %-55s |\n", $finalstatus, $output);


    }
}

// Close the CSV file
fclose($file);

// Output table footer
echo "+---------------------+---------------------------------------------------------------+\n";
