<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'abhishek@28');
   define('DB_DATABASE', 'test');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

	if ( !$db ) {
		die("Connection failed : " . mysql_error());
	}
	
	
   
?>
