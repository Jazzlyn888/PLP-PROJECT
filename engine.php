<?php session_start(); ?>
<?php 

		//Calling the connection page
	include('includes/connection.php');

	//Receive the engine identification
	$eng = $_GET['eng'];
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//The begining of functions definitions
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// Function of Item recording engine
	function itmeng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		
		//Tables to be used
		$table_name1 = "Items";
		
	//Receive form inputs
	$item = $_POST['item'];
	$quantity = $_POST['quantity'];
	$unit = $_POST['unit'];
	$bPrice = $_POST['bPrice'];
	$sPrice = $_POST['sPrice'];
	
if($item == "" || $quantity == "" || $unit == "" || $bPrice == "" || $sPrice == "")
	{
	include('default5555555.php');
	echo "<script>alert('Sorry, you have left some important field!; try again carefully')</script>";	
	}
else
	{
//Check whether the record already present in the database
$query1 = "SELECT COUNT(itemID) AS COUNT FROM $table_name1 WHERE ItemName = '$item'";
$result1 = mysql_query($query1);
$row1 = mysql_fetch_array($result1);
$count1 = $row1['COUNT'];

	if($count1 > 0)
		{
		include('default0.php');
		echo "<script>alert('The Item already present in the Database. Go to the Update data')</script>";
		}
	else
		{
			
	//Create and execute the query to insert Item in the table
	$query2 = "INSERT INTO $table_name1(ItemName, Quantity, Unit, BuyingPrice, SellingPrice, Date)
	 			VALUES('$item', '$quantity', '$unit', '$bPrice', '$sPrice', DATE(NOW()))";
	$result2 = mysql_query($query2);
	 
	 	//Check for the result
		if(!$result2)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
			include('default0.php');		
			}

		}
	}
 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// Function of Item Edit engine
	function itmeeng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		$itemID = $_GET['it'];
		
		//Tables to be used
		$table_name1 = "Items";
		
	//Receive form inputs
	$item = $_POST['item'];
	$quantity = $_POST['quantity'];
	$unit = $_POST['unit'];
	$bPrice = $_POST['bPrice'];
	$sPrice = $_POST['sPrice'];
	
if($item == "" || $quantity == "" || $unit == "" || $bPrice == "" || $sPrice == "")
	{
	include('default5555555.php');
	echo "<script>alert('Sorry, you have left some important field!; try again carefully')</script>";	
	}
else
	{

	//Create and execute the query to Update Item in the table
	$query2 = "UPDATE $table_name1 
				SET ItemName = '$item', Quantity = '$quantity', Unit = '$unit', BuyingPrice = '$bPrice', SellingPrice = '$sPrice'
	 			WHERE itemID = '$itemID'";
	$result2 = mysql_query($query2);
	 
	 	//Check for the result
		if(!$result2)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
			include('default0.php');		
			}

	}
 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	// Function of Item Delete engine
	function itmdeng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		$itemID = $_GET['it'];
		
		//Tables to be used
		$table_name1 = "Items";

	//Create and execute the query to Delete Item from the table
	$query2 = "DELETE FROM $table_name1 WHERE itemID = '$itemID'";
	$result2 = mysql_query($query2);
	 
	 	//Check for the result
		if(!$result2)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
			include('default0.php');		
			}

 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// Function of Transaction recording engine
	function trseng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		
		//Tables to be used
		$table_name1 = "Items";
		$table_name2 = "Transaction";
		$table_name3 = "MonthlyTransaction";
		$table_name4 = "Account";
		
	//Receive form inputs
	$item = $_POST['item'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	
if($price == "")
	{
	//Receive the price from Items
	$query = "SELECT SellingPrice FROM $table_name1 WHERE itemID = '$item'";
 	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$price = $row['SellingPrice'];	
	}
	
	//Calculate the total price
	$tPrice = $quantity * $price;
				
	//Create and execute the query to record transaction in the table
	$query1 = "INSERT INTO $table_name2(ItemID, Quantity, Price, staffID, DateTime)
	 			VALUES('$item', '$quantity', '$tPrice', '" . $_SESSION['staffID'] . "', NOW())";
	$result1 = mysql_query($query1);
	 
	 	//Check for the result
		if(!$result1)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
		//Check whether the Monthly record already present
		$query2 = "SELECT COUNT(monIncID) AS COUNT FROM $table_name3 WHERE Date = DATE(NOW())";
		$result2 = mysql_query($query2);
		$row2 = mysql_fetch_array($result2);
		$count = $row2['COUNT'];
		
				if($count > 0)
				{
			//Update Monthly Transaction Table
			$query3 = "UPDATE $table_name3 SET Amount = Amount + $tPrice WHERE Date = DATE(NOW())";
			$result3 = mysql_query($query3);	
			
			//Update Account Table
			$query4 = "UPDATE $table_name4 SET BusinessAccount = BusinessAccount + $tPrice";
			$result4 = mysql_query($query4);
				}
				else
				{
			//Insert Monthly records
			$query3 = "INSERT INTO $table_name3(Amount, Date)
						VALUES('$tPrice', DATE(NOW()))";
			$result3 = mysql_query($query3);
			
			//Update Account Table
			$query4 = "UPDATE $table_name4 SET BusinessAccount = BusinessAccount + $tPrice";
			$result4 = mysql_query($query4);
				}
			
			//Deduct the Item in Stock
			$query5 = "UPDATE $table_name1 SET Quantity = Quantity - $quantity
						WHERE itemID = '$item'";
			$result5 = mysql_query($query5);
				
			include('default0.php');		
			}

 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// Function of Transaction Edit engine
	function trseeng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		$transID = $_GET['tr'];
		
	//Tables to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Account";
	$table_name4 = "MonthlyTransaction";
	
	//Receive form inputs (these are the new data)
	$item = $_POST['item'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	$tPrice = $price * $quantity;

	//Retrieve the item ID and quantity (these are the curent data)
	$query = "SELECT itemID, Quantity, Price, DATE(DateTime) AS Date
 				FROM $table_name1
				WHERE transID = '$transID'";
 	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$itemID = $row['itemID'];
	$quant = $row['Quantity'];
	$amount = $row['Price'];
	$tarehe = $row['Date'];
	
	//Create and execute the query to Update transaction record from the table
	$query1 = "Update $table_name1 SET itemID = '$item', Quantity = '$quantity', Price = '$tPrice' WHERE transID = '$transID'";
	$result1 = mysql_query($query1);
	 
	 	//Check for the result
		if(!$result1)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
			//Update Items with Undo operation
			$query2 = "UPDATE $table_name2 SET Quantity = Quantity + $quant WHERE itemID = '$itemID'";
			$result2 = mysql_query($query2);
			
			//Update Items with new entry
			$query3 = "UPDATE $table_name2 SET Quantity = Quantity - $quantity WHERE itemID = '$item'";
			$result3 = mysql_query($query3);
			
			//Update Monthly Transaction with undo operation and New entry
			$query4 = "UPDATE $table_name4 SET Amount = Amount - $amount, Amount = Amount + $tPrice WHERE Date = '$tarehe'";
			$result4 = mysql_query($query4);
			
			//Update Business Account with undo operation and New entry
			$query5 = "UPDATE $table_name3 SET BusinessAccount = BusinessAccount - $amount, BusinessAccount = BusinessAccount + $tPrice";
			$result5 = mysql_query($query5);
			
			include('default0.php');		
			}

 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	// Function of Transaction Delete engine
	function trsdeng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		$transID = $_GET['tr'];
		
	//Tables to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Account";
	$table_name4 = "MonthlyTransaction";

	//Retrieve the item ID and quantity
	$query = "SELECT itemID, Quantity, Price, DATE(DateTime) AS Date
 				FROM $table_name1
				WHERE transID = '$transID'";
 	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$itemID = $row['itemID'];
	$quantity = $row['Quantity'];
	$amount = $row['Price'];
	$tarehe = $row['Date'];
	
	//Create and execute the query to Delete transaction record from the table
	$query1 = "DELETE FROM $table_name1 WHERE transID = '$transID'";
	$result1 = mysql_query($query1);
	 
	 	//Check for the result
		if(!$result1)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
			//Update Items with Undo operation
			$query2 = "UPDATE $table_name2 SET Quantity = Quantity + $quantity WHERE itemID = '$itemID'";
			$result2 = mysql_query($query2);
			
			//Update Monthly Transaction
			$query3 = "UPDATE $table_name4 SET Amount = Amount - $amount WHERE Date = '$tarehe'";
			$result3 = mysql_query($query3);
			
			//Update Business Account
			$query4 = "UPDATE $table_name3 SET BusinessAccount = BusinessAccount - $amount";
			$result4 = mysql_query($query4);
			
			include('default0.php');		
			}

 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// Function of Expenditure recording engine
	function expeng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		
		//Tables to be used
		$table_name2 = "Expenditure";
		$table_name3 = "MonthlyExpenditure";
		$table_name4 = "Account";
		
	//Receive form inputs
	$amount = $_POST['amount'];
	$reason = $_POST['reason'];
			
	//Create and execute the query to insert expenditure in the table
	$query1 = "INSERT INTO $table_name2(Amount, Description, staffID, DateTime)
	 			VALUES('$amount', '$reason', '" . $_SESSION['staffID'] . "', NOW())";
	$result1 = mysql_query($query1);
	 
	 	//Check for the result
		if(!$result1)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
		//Check whether the Monthly record already present
		$query2 = "SELECT COUNT(monExpID) AS COUNT FROM $table_name3 WHERE Date = DATE(NOW())";
		$result2 = mysql_query($query2);
		$row2 = mysql_fetch_array($result2);
		$count = $row2['COUNT'];
		
				if($count > 0)
				{
			//Update Monthly Expenditure Table
			$query3 = "UPDATE $table_name3 SET Amount = Amount + $amount WHERE Date = DATE(NOW())";
			$result3 = mysql_query($query3);	
			
			//Update Account Table
			$query4 = "UPDATE $table_name4 SET BusinessAccount = BusinessAccount - $amount";
			$result4 = mysql_query($query4);
				}
				else
				{
			//Insert Monthly records
			$query3 = "INSERT INTO $table_name3(Amount, Date)
						VALUES('$amount', DATE(NOW()))";
			$result3 = mysql_query($query3);
			
			//Update Account Table
			$query4 = "UPDATE $table_name4 SET BusinessAccount = BusinessAccount - $amount";
			$result4 = mysql_query($query4);
				}

			include('default0.php');		
			}

 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	// Function of Expenditure Editing engine
	function expeeng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		$expID = $_GET['xp'];
		
		//Tables to be used
		$table_name2 = "Expenditure";
		$table_name3 = "MonthlyExpenditure";
		$table_name4 = "Account";
		
	//Receive form inputs
	$amount = $_POST['amount'];
	$reason = $_POST['reason'];
	
	//Retrieve the curent records
 	$query = "SELECT Amount, DATE(DateTime) AS Date
 				FROM $table_name2
				WHERE expID = '$expID'";
 	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$amo = $row['Amount'];
	$date = $row['Date'];
			
	//Editing expenditure record
	$query1 = "UPDATE $table_name2 SET Amount = '$amount', Description = '$reason' WHERE expID = '$expID'";
	$result1 = mysql_query($query1);
	 
	 	//Check for the result
		if(!$result1)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again with the correct inputs.')</script>";
			}
		else
			{
			//Update Monthly Expenditure Table
			$query3 = "UPDATE $table_name3 SET Amount = Amount - $amo, Amount = Amount + $amount WHERE Date = '$date'";
			$result3 = mysql_query($query3);	
			
			//Update Account Table
			$query4 = "UPDATE $table_name4 SET BusinessAccount = BusinessAccount + $amo, BusinessAccount = BusinessAccount - $amount";
			$result4 = mysql_query($query4);

				
			include('default0.php');		
			}

 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	// Function of Expenditure Delete engine
	function expdeng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		$expID = $_GET['xp'];
		
		//Tables to be used
		$table_name1 = "Expenditure";
		$table_name2 = "MonthlyExpenditure";
		$table_name3 = "Account";

	//Retrieve the date expenditure done
	$query = "SELECT Amount, DATE(DateTime) AS Date
 				FROM $table_name1
				WHERE expID = '$expID'";
 	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$amount = $row['Amount'];
	$date = $row['Date'];
	
	//Create and execute the query to Delete Expenditure from the table
	$query1 = "DELETE FROM $table_name1 WHERE expID = '$expID'";
	$result1 = mysql_query($query1);
	 
	 	//Check for the result
		if(!$result1)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
			//Update Monthly Expenditure
			$query2 = "UPDATE $table_name2 SET Amount = Amount - $amount WHERE Date = '$date'";
			$result2 = mysql_query($query2);
			
			//Update Account
			$query3 = "UPDATE $table_name3 SET BusinessAccount = BusinessAccount + $amount";
			$result3 = mysql_query($query3);
			
			include('default0.php');		
			}

 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	// Function of Dept recording engine
	function dpreng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		
		//Tables to be used
		$table_name1 = "Items";
		$table_name2 = "DeptsRecords";
		$table_name3 = "Account";
		
	//Receive form inputs
	$debtor = $_POST['debtor'];
	$item = $_POST['item'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	
if($price == "")
	{
	//Receive the price from Items
	$query = "SELECT SellingPrice FROM $table_name1 WHERE itemID = '$item'";
 	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$price = $row['SellingPrice'];	
	}
	
	//Calculate the total price
	$tPrice = $quantity * $price;
				
	//Create and execute the query to record debt in the table
	$query1 = "INSERT INTO $table_name2(ItemID, Quantity, Amount, Debtor, DateTime, AmountRemain)
	 			VALUES('$item', '$quantity', '$tPrice', '$debtor', NOW(), '$tPrice')";
	$result1 = mysql_query($query1);
	 
	 	//Check for the result
		if(!$result1)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
			//Deduct the Item in Stock
			$query2 = "UPDATE $table_name1 SET Quantity = Quantity - $quantity
						WHERE itemID = '$item'";
			$result2 = mysql_query($query2);
			
			//Update Debt Account
			$query3 = "UPDATE $table_name3 SET DeptAccount = DeptAccount + $tPrice";
			$result3 = mysql_query($query3);
				
			include('default0.php');		
			}

 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	// Function of Dept editing engine
	function dpreeng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		$deptID = $_GET['dp'];
		
		//Tables to be used
		$table_name1 = "Items";
		$table_name2 = "DeptsRecords";
		$table_name3 = "Account";
		
	//Receive form inputs
	$debtor = $_POST['debtor'];
	$item = $_POST['item'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	
	//Calculate the total price
	$tPrice = $quantity * $price;
	
	//Retrieve the curent records
	$query = "SELECT itemID, Quantity, Amount 
				FROM $table_name2
				WHERE deptID = '$deptID'";
 	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$itemID = $row['itemID'];
	$quant = $row['Quantity'];
	$amount = $row['Amount'];
				
	//Create and execute the query to update debt record in the table
	$query1 = "UPDATE $table_name2 
				SET ItemID = '$item', Quantity = '$quantity', Amount = '$tPrice', Debtor = '$debtor', AmountRemain = '$tPrice'
				WHERE deptID = '$deptID'";
	$result1 = mysql_query($query1);
	 
	 	//Check for the result
		if(!$result1)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
			//Update Items in Stock
			$query2 = "UPDATE $table_name1 SET Quantity = Quantity + $quant
						WHERE itemID = '$itemID'";
			$result2 = mysql_query($query2);
			
			$query3 = "UPDATE $table_name1 SET Quantity = Quantity - $quantity
						WHERE itemID = '$item'";
			$result3 = mysql_query($query3);
			
			//Update Debt Account
			$query4 = "UPDATE $table_name3 SET DeptAccount = DeptAccount - $amount, DeptAccount = DeptAccount + $tPrice";
			$result4 = mysql_query($query4);
				
			include('default0.php');		
			}

 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	// Function of Dept record Delete engine
	function dprdeng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		$deptID = $_GET['dp'];
		
	//Tables to be used
	$table_name1 = "DeptsRecords";
	$table_name2 = "Items";
	$table_name3 = "Account";

	//Retrieve the item ID and quantity
	$query = "SELECT itemID, Quantity, Amount
 				FROM $table_name1
				WHERE deptID = '$deptID'";
 	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$itemID = $row['itemID'];
	$quantity = $row['Quantity'];
	$amount = $row['Amount'];
	
	//Create and execute the query to Delete dept record from the table
	$query1 = "DELETE FROM $table_name1 WHERE deptID = '$deptID'";
	$result1 = mysql_query($query1);
	 
	 	//Check for the result
		if(!$result1)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
			//Update Items with Undo operation
			$query2 = "UPDATE $table_name2 SET Quantity = Quantity + $quantity WHERE itemID = '$itemID'";
			$result2 = mysql_query($query2);
			
			//Update Debt Account
			$query3 = "UPDATE $table_name3 SET DeptAccount = DeptAccount - $amount";
			$result3 = mysql_query($query3);
			
			include('default0.php');		
			}

 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	// Function of Dept Payment engine
	function dptpayleng()
		{////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		$ID = $_GET['id'];
		$deptID = $_GET['dp'];
		
		//Tables to be used
		$table_name1 = "Items";
		$table_name2 = "DeptsRecords";
		$table_name3 = "DeptsPayments";
		$table_name4 = "Transaction";
		$table_name5 = "MonthlyTransaction";
		$table_name6 = "Account";
		
	//Receive form inputs
	$amount = $_POST['amount'];
	
	//Retrieve the curent records
	$query = "SELECT itemID, Quantity, Amount, AmountRemain
				FROM $table_name2
				WHERE deptID = '$deptID'";
 	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$itemID = $row['itemID'];
	$quant = $row['Quantity'];
	$amo = $row['Amount'];
	$amoRemain = $row['AmountRemain'];
	
		if($amount > $amoRemain)
		{
		include('default0.php');
		echo "<script>alert('The Operation failed. The amount entered exceed the remain amount.')</script>";		
		}
		else
		{				
	//Record Dept payment
	$query1 = "INSERT INTO $table_name3(deptID, Amount, Date) 
				VALUES('$deptID', '$amount', DATE(NOW()))";
	$result1 = mysql_query($query1);
	 
	 	//Check for the result
		if(!$result1)
			{
			include('default0.php');
			echo "<script>alert('The Operation failed. Please try again.')</script>";
			}
		else
			{
			//Update Depts records
			$query2 = "UPDATE $table_name2 SET AmountRemain = AmountRemain - $amount
						WHERE deptID = '$deptID'";
			$result2 = mysql_query($query2);
			
	//Retrieve Dept record status
	$query3 = "SELECT AmountRemain FROM $table_name2
			WHERE deptID = '$deptID'";
 	$result3 = mysql_query($query3);
	$row3 = mysql_fetch_array($result3);
	$AmountRemain = $row3['AmountRemain'];
	
				if($AmountRemain == 0.00)
					{
			//Record dept payment to Transaction
			$query4 = "INSERT INTO $table_name4(itemID, Quantity, Price, staffID, DateTime) 
						VALUES('$itemID', '$quant', '$amo', '" . $_SESSION['staffID'] . "', NOW())";
			$result4 = mysql_query($query4);			
					}

			//Check whether the Monthly record already present
		$query5 = "SELECT COUNT(monIncID) AS COUNT FROM $table_name5 WHERE Date = DATE(NOW())";
		$result5 = mysql_query($query5);
		$row5 = mysql_fetch_array($result5);
		$count = $row5['COUNT'];
		
				if($count > 0)
				{
			//Update Monthly Transaction Table
			$query6 = "UPDATE $table_name5 SET Amount = Amount + $amo WHERE Date = DATE(NOW())";
			$result6 = mysql_query($query6);	
				}
				else
				{
			//Insert Monthly records
			$query6 = "INSERT INTO $table_name5(Amount, Date)
						VALUES('$amo', DATE(NOW()))";
			$result6 = mysql_query($query6);
				}

			//Update Account
			$query7 = "UPDATE $table_name6 SET BusinessAccount = BusinessAccount + $amount, DeptAccount = DeptAccount - $amount";
			$result7 = mysql_query($query7);
				
			include('default0.php');		
			}
		}
 		}/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//The end of functions definitions
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Calling the Function
	echo $eng();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>