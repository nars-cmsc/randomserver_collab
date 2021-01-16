1. store the backupandrestore.bat, backuponly.bat and restoreoonly.bat in \xampp\mysql\bin
	note that :
	backupandrestore.bat backs up the database and immediately restores the saved sql file IN THE SAME DATABASE
	backup only.bat only backups the database with cmsc127group3_backup.sql as its name
	restoreonly.bat restores the database cmsc127group3_backup.sql to the database cmsc127group3backup TO CHECK IF IT WORKS

2. edit the batchfiles first to where the location file is 
	change "E:\installerscs\xampp\htdocs\backup\" in the "E:\installerscs\xampp\htdocs\backup\cs127group3_%mydate%_%mytime%.sql" and "E:\installerscs\xampp\htdocs\backup\cs127group3_backup.sql"  to where you would like the sql file to be. 

	//if confused just ask me
3. to run them just click the batch file to be used
	no password has been set for ease of checking, just click enter (twice if backup and recovery)
4. to automatically backup/restore, use a task scheduler
	