#!/bin/bash

# Simplest possible version example
: <<'COMMENT'
# Need to use asbolute path ...
filePath="/Users/FileForTesting.md"
newCreationDate="2016-09-01 13:23:33"

# Convert the date to a timestamp
timestamp=$(date -j -f "%Y-%m-%d %H:%M:%S" "$newCreationDate" "+%s")

# Format the date and time components
formattedDate=$(date -r "$timestamp" "+%Y%m%d%H%M.%S")

# Update the file's timestamp
touch -t "$formattedDate" "$filePath"
echo "New TimeStamp: $formattedDate - Formatted: $formattedDate"
COMMENT
	



#!/bin/bash

# Choose the method for updating the file date
METHOD="touch"  # Default to using the touch command

# Function to validate and parse date strings into timestamps
function strtotime() {
    local date_string="$1"
    local format="$2"

    # Use date command to parse date string with specified format
    local timestamp=$(date -jf "$format" "$date_string" "+%s" 2>/dev/null)

    if [ $? -ne 0 ]; then
        echo "Failed to parse the date and time input. Make sure the format is 'YYYY-MM-DD HH:MM'."
        return 1
    fi

    echo "$timestamp"
}

# Function to update file date
function update_file_date() {
    read -p "Enter the file path: " file_path
    read -p "Enter the new date and time (e.g., '2023-10-15 15:30'): " new_date

    # Use the strtotime function to convert the new_date string
    timestamp=$(strtotime "$new_date" "%Y-%m-%d %H:%M")

    if [ $? -ne 0 ]; then
        # The strtotime function will display an error message, so no need to duplicate it.
        return
    fi

    if [ "$METHOD" = "setfile" ]; then
        # Format the timestamp as YYYYmmddHHMM.ss (without separators)
        new_date_formatted=$(date -r $timestamp "+%Y%m%d%H%M.%S")

        # Update file's modification and creation date using SetFile
        SetFile -d "$new_date_formatted" -m "$new_date_formatted" "$file_path"
        echo "File date updated successfully using SetFile."
    else
        # Update file's modification and creation date using touch (use seconds since epoch)
        touch -t "$(date -r $timestamp "+%Y%m%d%H%M.%S")" "$file_path"
        echo "File date updated successfully using touch."
    fi
}

while true; do
    update_file_date
    read -p "Do you want to update another file? (y/n): " choice
    case "$choice" in
        [Yy]*) continue ;;
        [Nn]*) break ;;
        *) echo "Invalid choice. Please enter 'y' or 'n'." ;;
    esac
done
