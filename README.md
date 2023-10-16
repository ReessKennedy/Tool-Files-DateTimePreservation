## What ℹ️
Easily and quickly change, tame and backup file dates via your terminal. No need to remember bash commands or proper date format syntax, these six php scripts will prompt you for necessary info to do what you wish to do and use php's very flexible strtotime function to allow resilience with the entered date and time values. 
## Why 🤷‍♂️
- File dates sometimes are changed by tools without user consent or knowledge
- GoogleDrive and other cloud services, or backup tools, will do this when restoring files
- I have been burned by file date changes before and there aren't many good Mac apps to help with file DateTime changes and Macs don't have great way to change dates that is built into the user interface of the operating system. 
- Remembering dash commands for changing file meta is annoying AND remembering proper DateTime formatting is also annoying and this endeavors to fix both of these things. 
## Date Actions ⚙️
Disclaimer: These tools edit file information and while I'm confident you'll be okay, make sure you have a backup of your files.

### Redate File
Update the creation date for one file at a time. See usage via embedded GIF. 

![|500](https://drive.google.com/uc?id=16qF2w0HHNsjwiZzAoW3pVZeFP3viGuxa&usp=drive_fs)


### Redate File From CSV
Redate many files at once using a CSV file storing filepath and date information. See gif embedded below and sample .csv included with the repository. 

![|500](https://drive.google.com/uc?id=16ocaZLbCwfygqK1iaJS1M8nyAzfpekzF&usp=drive_fs)
### Add Dates to Filename
Transfer the files current timestamp to the beginning or end of a file in any format. 
Useful as a backup method or when you want to view files with various names in chronological order even when your filesystem is set to order files by name by default. See usage via embedded gif. 

![|500](https://drive.google.com/uc?id=16pFaCRisLSrvzRIKv7la5SbuLNnb6GmF&usp=drive_fs)


### Removing added dates from filename
See GIF for usage. 

![|500](https://drive.google.com/uc?id=16mMi-1FntVF0te7OYE1q5qq0Wo71BJyX&usp=drive_fs)

### Search for Filenames & Return Dates
Create a CSV list of filenames and then search for all these names in a specified directory and return the file dates for these files. 

This is very useful if something has gone wrong with your files in GoogleDrive. In this case, you could just replace these files with the files from a backup but then all your files will be reuploaded and treated as new files which can be a big problem if you have shared these files online because all these links will now break as new IDs will be issued by Google for these new files. This is why having a way to programmatically update these dates by looking at a backup containing the proper dates is helpful. 

![|500](https://drive.google.com/uc?id=16nTxk-NLvtOax4E72ciRw3PNCLiarM-x&usp=drive_fs)
### Backup Dates for Files
This allows you to specify a directory and then create a CSV containing all filepaths in that directory, filenames and important defining meta data include file size, width and timestamp ... in the event file dates are changed, this can serve as an additional possible backup method to restore dates. 

![|500](https://drive.google.com/uc?id=16sBXINX6vpiRmW9mW6OZsVmeEKlY6dam&usp=drive_fs)