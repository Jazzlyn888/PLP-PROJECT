 <?php
 
//Define some variables to be used

 $mysql_hostname = "localhost";
 $mysql_user = "root";
 $mysql_password = "";
 $mysql_database = "msisira";

 //Open connection to the server.
 $con = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Could not connect to the server");

 //Select the database to be used.
 mysql_select_db($mysql_database, $con) or die("Unable to select the database");
 
 ?>