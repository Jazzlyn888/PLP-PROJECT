<?php session_start(); ?>
<?php 
//Receive the form inputs
$user = $_POST['user'];
$pass = $_POST['pass'];

//Check if all inputs have been sent
	if ($user == '' || $pass == '')
		{
	include('index.php');
	echo "<script>alert('You have to enter both Username and Password')</script>";
	exit;
		}
		
		//Calling the connection page
	include('includes/connection.php');
	
	//Table to be used
	$table_name = "Staffs";
	
//Create and execute the query to check whether the user exist
 $query1 = "SELECT COUNT(staffID) AS COUNT FROM $table_name WHERE Username = '$user' AND Password = '$pass'";
 $result1 = mysql_query($query1);
 $row1 = mysql_fetch_array($result1);
 $count1 = $row1['COUNT'];
 
 if($count1 > 0)
 	{
// Execute the second query to retrieve the user information
 $query2 = "SELECT staffID, StaffName, Position, Username
 			FROM $table_name 
			WHERE Username = '$user' AND Password = '$pass'";
 $result2 = mysql_query($query2);
 $row2 = mysql_fetch_array($result2);
 		$_SESSION['staffID'] = $row2['staffID'];
		$_SESSION['name'] = $row2['StaffName'];
		$_SESSION['position'] = $row2['Position'];
		$_SESSION['user'] = $row2['Username'];

	// The code to call the home page of the operation	
	 include('home0.php');	
	}
else
 { 
  include('index.php');
  echo "<script>alert('Wrong Password or Username!, try again')</script>";
 exit;
 }


?>