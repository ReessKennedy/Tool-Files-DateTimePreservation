## What ℹ️
A set of six easy-to-use command line scripts for changing file dates. 

If you feel like running a command line tool requires serious tech chops, it doesn't! This quick guide I wrote demonstrates how to do it if you're on a mac: [Running Command Line Scripts](https://github.com/ReessKennedy/GithubUsage). In short, after [downloading this code](https://github.com/ReessKennedy/DateTimePreservation/archive/refs/heads/main.zip) just type `php` in the little terminal window and drag in the file you wish to work with. All the actions for these six files are detailed below. 

The more advanced scripts give you methods to bulk update the timestamps for many files using multiple methods and a method to backup timestamp info for all the files in a directory to a .csv file to help with timestamp restoration should the timestamps of your precious files change against your desires. 

## Why 🤷‍♂️
**Cloud services can't be trusted with your file dates**
GoogleDrive and other cloud services, or backup tools, will sometimes mess up files creations dates when restoring files or, randomly, it seems. 

**File Dates are important to me**
I really value being able to sort my files by creation date and can't tolerate the loss of this piece of file data and I have been burned by file date changes before via GoogleDrive and the thought of being at risk of losing it again was needling me! : )

**Mac OS file date changing support is poor**
Mac doesn't have built in file redating so you have to turn to custom apps or or the command line.

**Mac apps don't allow customization**
The paid Mac apps in the app store for file redating are not that good AND, sometimes I need to batch update files based on specific criteria and pull new dates from either a CSV or read from the timestamp still present in the file's named, e.g. "Screenshot 2023-11-02 13:12PM" and having a simple script allows me to do this and customize how it works.

**Remembering command line date update commands is hard**
Command line is quick and easy BUT I always have to remember the command. Remembering proper php DateTime syntax is also annoying so creating a more resilient DateTime recognition tool that allows even more natural language date entry is nice. 

## Date Actions ⚙️
❕Disclaimer: These tools edit file information and while I'm confident you'll be okay, make sure you have a backup of your files. I use backblaze and like it. 
### Redate File
Update the creation date for one file at a time. Just follow prompts after running. See usage via embedded GIF. 

![|400](https://drive.google.com/thumbnail?id=1oseT4EpCQ85WoxAom5tZBp298JXjeQf_&usp=drive_fs&sz=s4000)


==Bash version==: I also snuck in here a fully bash version aRedateFile.sh so just run this by starting with `bash` instead of `php`. The php version may be more resilient but if you don't have PHP installed, perhaps if you need to run on Ubuntu, the bash version is nice too. It also gives you the ability to set the file changing function between SetFile, if you're on a Mac, so you have the ability to also forward-date files, and touch as the default on other machines. 

### Redate File From CSV
Redate many files at once using a CSV file storing filepath and date information. See gif embedded below and sample .csv included with the repository. 
![|400](https://drive.google.com/thumbnail?id=1olhlwe3DHTp-FPFfCFNELPA9rfgJLMlL&usp=drive_fs&sz=s4000)

Note: 
If you want to update the dates of screenshots and the date uses a format like this (common a mac) this script uses a custom function called `extractDateTimeFromString` that will use some RegEx to extract the computer-recognizable date for you. If this occurs you'll see "Extracted" in the output in your terminal, like you see below. It's possible this could be extended to handle more complicated or custom extractions of this sort. 

|   |   |   |
|---|---|---|
|✅|Extracted|<- Extracted from filename like "Screen shot 2010-11-15 at 9.20.20 AM"|
|✅✅|Cell value|<- Understood standard formatting "2023/10/15 01:01:01"|
|❌|No DateTime Recognized|<- Could not understand|

### Add Dates to Filename
Transfer the files current timestamp to the beginning or end of a file in any format. 
Useful as a backup method or when you want to view files with various names in chronological order even when your filesystem is set to order files by name by default. See usage via embedded gif. 

![|400](https://drive.google.com/thumbnail?id=1ohcJcRxAAapAoUA7NQqjYWXUze0j7_OU&usp=drive_fs&sz=s4000)



### Removing added dates from filename

See GIF for usage. 
![|400](https://drive.google.com/thumbnail?id=1orTJPv9jCipauTTlAJpULuJdYaDLATJR&usp=drive_fs&sz=s4000)

### Search for Filenames & Return Dates
Create a CSV list of filenames and then search for all these names in a specified directory and return the file dates for these files. 

This is very useful if something has gone wrong with your files in GoogleDrive. In this case, you could just replace these files with the files from a backup but then all your files will be reuploaded and treated as new files which can be a big problem if you have shared these files online because all these links will now break as new IDs will be issued by Google for these new files. This is why having a way to programmatically update these dates by looking at a backup containing the proper dates is helpful. 
![|400](https://drive.google.com/thumbnail?id=1okYrzHh9K_n9ZVNgfP4Yd9QkTigWqZWP&sz=s4000)


### Backup Dates for Files
This allows you to specify a directory and then create a CSV containing all filepaths in that directory, filenames and important defining meta data include file size, width and timestamp ... in the event file dates are changed, this can serve as an additional possible backup method to restore dates. 

![|400](https://drive.google.com/thumbnail?id=1oq4SSl1zni_cMTCCmt-3P-hEfu_Pn4bS&usp=drive_fs&sz=s4000)

## More
### Instructions
Quick reference on how to download and try it out: https://github.com/ReessKennedy/GithubUsage
### Notes
- SetFile only works on Mac but can forward date
- Touch works on Mac but can only backdate
- Created created two different functions for both set file in touch
- Might be more clear to list the filenames as headers under "Dates Actions" - maybe this is unnecessary.
- The Bulk File Redate: The commercial Mac app I have used before is called "Bulk File Redate" and it will allows the redating of up to 10 files at a time for free but it's clunky and I think this method of using these little scripts is faster and more flexible.  

### Ideas
- Should look to see if PHP can detect whether using a Mac or not and switch between the two automatically so you could just use one update function
- Should specify that you're using PHP because of the strength of the strength to time function to allow people to enter in relative dates as well as partial dates or full dates if they want but it just gets more flexibility and recognizing that you could maybe create some bash for this but it's more complicated than that also probably python has some library that does this as well but we're just using 
- Could maybe put all includes or all paths in a config file so although maybe that's more complicated because they need up to have two files and it's easier to just divide it in the file not sure
- Modification time -> Creation: I had this up and working and I had to use it after the GDrive debacle of 2023 but not actually sure if this is a common need ... maybe could add this as a 7th date changing tool ... loop through all files and change create date to mirror mod date ... I think this was my best chance of recovering some create dates after GDrive changed create but kept proper mod date. 
- ==Note:== Could also some update savings if compares existing timestamp to new one and does NOT update if it is already the same ... a check for this

### Todos
- [x] Scan directory files --> Create CSV with file backup data
- [x] bulk update via CSV

### Links

From other sources: 
- [SetFile](https://ss64.com/osx/setfile.html) reference
- ["Touch command in Linux, with examples"](https://www.geeksforgeeks.org/touch-command-in-linux-with-examples/)
- [PHP strtotime function](https://www.php.net/manual/en/function.strtotime.php)
- [Regular Expressions info](https://www.w3schools.com/php/php_regex.asp)if you wish to extend the custom `extractDateTimeFromString` function. 

From me: 
- [Cheatsheet I made on computer DateTime](https://github.com/ReessKennedy/DateTimeCheatsheet)
- [Info on downloading code from](https://github.com/ReessKennedy/GithubUsage) Github and running bash, php or python scripts via terminal
