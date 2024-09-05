    <?php 

	//Calling the connection page
	include('connection.php');

//The begining of functions definitions //////////////////////////////////////////////////////////////////////////

// Function Items list display 
function itmdsp()
	{
	//Table to be used
	$table_name1 = "Items";
	
	//Retrieve different dates
	$query = "SELECT DISTINCT Date
				FROM $table_name1 ORDER BY Date";
	$result = mysql_query($query);
	
	echo "<center>";
	echo "<font size = '5'><b>Items List</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Item Name</th><th>Quantity</th><th>Buying Price</th><th>Selling Price</th></tr>";
		$no = 1; $c = 1;
	while($row = mysql_fetch_array($result))
			{	if($c % 2 == 0){$bgcolor = "#CCCCCC"; } else{$bgcolor = "#EEEEEE";}
			
	$query2 = "SELECT DATE_FORMAT(Date, '%d %M, %Y') AS Tarehe 
				FROM $table_name1 WHERE Date = '$row[0]'";
	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array($result2);
	$tarehe = $row2['Tarehe'];
			
		echo "<tr bgcolor = '$bgcolor'>";
			echo "<th colspan = '5'>";
			echo $tarehe;
			echo "</th>";
		echo "</tr>";
	// Query to retrieve Items' information
 	$query1 = "SELECT itemID, ItemName, Quantity, Unit, BuyingPrice, SellingPrice
 				FROM $table_name1 WHERE Date = '$row[0]' AND Quantity > 0 ORDER BY Date";
 	$result1 = mysql_query($query1);
		
	//Create a loop arround the results.
		
  	while($row1 = mysql_fetch_array($result1))
   		{	
		echo "<tr bgcolor = '$bgcolor'>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['ItemName'] . "</td>";
			echo "<td align = 'center'>" . $row1['Quantity'] . " " . $row1['Unit'] . "</td>";
			echo "<td align = 'right'>" . $row1['BuyingPrice'] . "&nbsp;</td>";
			echo "<td align = 'right'>" . $row1['SellingPrice'] . "&nbsp;</td>";
		echo "</tr>";
		$no = $no + 1;
		}
		$c = $c + 1;
			}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=itmfrm' > Add Item </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=itmedsp' > Edit Item </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=itmddsp' > Delete Item </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Items list display

// Function Item form display 
function itmfrm()
	{
		$ID = $_GET['id'];
	echo "<center>";

		echo "<fieldset style = 'width:600px'><legend style='font-size:22px'>Item's Recording Form</legend>";
		echo "<table border = '0' cellpadding = '1' cellspacing = '0'>";
		echo "<form method = 'post' action = 'engine.php?eng=itmeng&id=itmdsp' >";
		echo "<tr><td align = 'right'>";
		echo "<fieldset>";
		echo "<br /><br />";
		echo "Item Name &nbsp;<input type = 'text' name = 'item' size='40' required = 'required' /><br /><br />";
		echo "Quantity &nbsp;&nbsp;<input type = 'text' name = 'quantity' size='5' required = 'required' />";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit&nbsp;<input type = 'text' name = 'unit' size='5' value='PCS' required = 'required' /><br /><br />";
		echo "Buying Price &nbsp;&nbsp;<input type = 'text' name = 'bPrice' required = 'required' /><br /><br />";
		echo "Selling Price &nbsp;&nbsp;<input type = 'text' name = 'sPrice' required = 'required' />";
		echo "<br /><br />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "<tr><td align = 'center'>";
		echo "<fieldset>";
		echo "<input type = 'reset' value = 'Reset Form' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type = 'submit' value = 'Save' />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</fieldset>";

 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=itmfrm' > Add Item </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=itmedsp' > Edit Item </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=itmddsp' > Delete Item </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Item form display

// Function Edit Items list display 
function itmedsp()
	{
	//Table to be used
	$table_name1 = "Items";
	
	//Retrieve different dates
	$query = "SELECT DISTINCT Date
				FROM $table_name1 ORDER BY Date";
	$result = mysql_query($query);
	
	echo "<center>";
	echo "<font size = '5'><b>Items List</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Item Name</th><th>Quantity</th><th>Buying Price</th><th>Selling Price</th><th>Edit</th></tr>";
		$no = 1; $c = 1;
	while($row = mysql_fetch_array($result))
			{	if($c % 2 == 0){$bgcolor = "#CCCCCC"; } else{$bgcolor = "#EEEEEE";}
			
	$query2 = "SELECT DATE_FORMAT(Date, '%d %M, %Y') AS Tarehe 
				FROM $table_name1 WHERE Date = '$row[0]'";
	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array($result2);
	$tarehe = $row2['Tarehe'];
			
		echo "<tr bgcolor = '$bgcolor'>";
			echo "<th colspan = '6'>";
			echo $tarehe;
			echo "</th>";
		echo "</tr>";
	// Query to retrieve Items' information
 	$query1 = "SELECT itemID, ItemName, Quantity, Unit, BuyingPrice, SellingPrice
 				FROM $table_name1 WHERE Date = '$row[0]' AND Quantity > 0 ORDER BY Date";
 	$result1 = mysql_query($query1);
		
	//Create a loop arround the results.
		
  	while($row1 = mysql_fetch_array($result1))
   		{	
		echo "<tr bgcolor = '$bgcolor'>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['ItemName'] . "</td>";
			echo "<td align = 'center'>" . $row1['Quantity'] . " " . $row1['Unit'] . "</td>";
			echo "<td align = 'right'>" . $row1['BuyingPrice'] . "&nbsp;</td>";
			echo "<td align = 'right'>" . $row1['SellingPrice'] . "&nbsp;</td>";
			echo "<td align = 'center'><a href = 'default.php?id=itmefrm&it=$row1[0]' title='Edit'><img src='Images/edit.png' /></a></td>";
		echo "</tr>";
		$no = $no + 1;
		}
		$c = $c + 1;
			}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=itmfrm' > Add Item </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=itmedsp' > Edit Item </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=itmddsp' > Delete Item </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Edit Items list display

// Function Item Edit form display 
function itmefrm()
	{
	//Receive Item ID
	$item = $_GET['it'];
	
	//Table to be used
	$table_name1 = "Items";
		
	//Retrieve Item Info
	$query1 = "SELECT itemID, ItemName, Quantity, Unit, BuyingPrice, SellingPrice
 				FROM $table_name1 WHERE itemID = '$item'";
 	$result1 = mysql_query($query1);
	$row1 = mysql_fetch_array($result1);
		$itemID = $row1['itemID'];
		$ItemName = $row1['ItemName'];
		$Quantity = $row1['Quantity'];
		$Unit = $row1['Unit'];
		$BuyingPrice = $row1['BuyingPrice'];
		$SellingPrice = $row1['SellingPrice'];
		
	echo "<center>";

		echo "<fieldset style = 'width:600px'><legend style='font-size:22px'>Item's Recording Form</legend>";
		echo "<table border = '0' cellpadding = '1' cellspacing = '0'>";
		echo "<form method = 'post' action = 'engine.php?eng=itmeeng&id=itmedsp&it=$item' >";
		echo "<tr><td align = 'right'>";
		echo "<fieldset>";
		echo "<br /><br />";
		echo "Item Name &nbsp;<input type = 'text' name = 'item' value='$ItemName' size='40' required = 'required' /><br /><br />";
		echo "Quantity &nbsp;&nbsp;<input type = 'text' name = 'quantity' value='$Quantity' size='5' required = 'required' />";
		echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit&nbsp;<input type = 'text' name = 'unit' size='5' value='$Unit' required = 'required' /><br /><br />";
		echo "Buying Price &nbsp;&nbsp;<input type = 'text' name = 'bPrice' value='$BuyingPrice' required = 'required' /><br /><br />";
		echo "Selling Price &nbsp;&nbsp;<input type = 'text' name = 'sPrice' value='$SellingPrice' required = 'required' />";
		echo "<br /><br />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "<tr><td align = 'center'>";
		echo "<fieldset>";
		echo "<input type = 'reset' value = 'Reset Form' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type = 'submit' value = 'Save Changes' />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</fieldset>";

 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=itmfrm' > Add Item </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=itmedsp' > Edit Item </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=itmddsp' > Delete Item </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Item Edit form display

// Function Delete Items list display 
function itmddsp()
	{
	//Table to be used
	$table_name1 = "Items";
	
	//Retrieve different dates
	$query = "SELECT DISTINCT Date
				FROM $table_name1 ORDER BY Date";
	$result = mysql_query($query);
	
	echo "<center>";
	echo "<font size = '5'><b>Items List</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Item Name</th><th>Quantity</th><th>Buying Price</th><th>Selling Price</th><th>Drop</th></tr>";
		$no = 1; $c = 1;
	while($row = mysql_fetch_array($result))
			{	if($c % 2 == 0){$bgcolor = "#CCCCCC"; } else{$bgcolor = "#EEEEEE";}
			
	$query2 = "SELECT DATE_FORMAT(Date, '%d %M, %Y') AS Tarehe 
				FROM $table_name1 WHERE Date = '$row[0]'";
	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array($result2);
	$tarehe = $row2['Tarehe'];
			
		echo "<tr bgcolor = '$bgcolor'>";
			echo "<th colspan = '6'>";
			echo $tarehe;
			echo "</th>";
		echo "</tr>";
	// Query to retrieve Items' information
 	$query1 = "SELECT itemID, ItemName, Quantity, Unit, BuyingPrice, SellingPrice
 				FROM $table_name1 WHERE Date = '$row[0]' AND Quantity > 0 ORDER BY Date";
 	$result1 = mysql_query($query1);
		
	//Create a loop arround the results.
		
  	while($row1 = mysql_fetch_array($result1))
   		{	
		echo "<tr bgcolor = '$bgcolor'>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['ItemName'] . "</td>";
			echo "<td align = 'center'>" . $row1['Quantity'] . " " . $row1['Unit'] . "</td>";
			echo "<td align = 'right'>" . $row1['BuyingPrice'] . "&nbsp;</td>";
			echo "<td align = 'right'>" . $row1['SellingPrice'] . "&nbsp;</td>";
			echo "<td align = 'center'><a href = 'engine.php?eng=itmdeng&id=itmddsp&it=$row1[0]' title='Delete'><img src='Images/drop.png' /></a></td>";
		echo "</tr>";
		$no = $no + 1;
		}
		$c = $c + 1;
			}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=itmfrm' > Add Item </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=itmedsp' > Edit Item </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=itmddsp' > Delete Item </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Delete Items list display

// Function Transanction list display 
function trsdsp()
	{
	//Table to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Staffs";
	
	// Query to retrieve Transactions' information
 	$query1 = "SELECT transID, ItemName, T.Quantity, Unit, Price, StaffName, DateTime
 				FROM $table_name1 T, $table_name2 I, $table_name3 S
				WHERE T.itemID = I.itemID AND T.staffID = S.staffID
				ORDER BY DateTime DESC";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Transactions' Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Item Name</th><th>Quantity</th><th>Staff Name</th><th>Datetime</th><th>Price</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['ItemName'] . "</td>";
			echo "<td align = 'center'>" . $row1['Quantity'] . " " . $row1['Unit'] . "</td>";
			echo "<td>" . $row1['StaffName'] . "</td>";
			echo "<td align = 'center'>" . $row1['DateTime'] . "&nbsp;</td>";
			echo "<td align = 'right'>" . $row1['Price'] . "&nbsp;</td>";
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=trsfrm' > Record Transaction </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=trsedsp' > Edit Transaction </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=trsddsp' > Delete Transaction </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Transaction list display

// Function Transaction form display 
function trsfrm()
	{
		$ID = $_GET['id'];
	//Table to be used	
	$table_name1 = "Items";
	
	// Query to retrieve Items from Stock
 	$query1 = "SELECT * FROM $table_name1 ORDER BY Date DESC";
 	$result1 = mysql_query($query1);
		
	echo "<center>";
		echo "<br/>";
		echo "<fieldset style = 'width:520px'><legend style='font-size:22px'>Transaction Recording Form</legend>";
		echo "<table border = '0' cellpadding = '1' cellspacing = '0'>";
		echo "<form method = 'post' action = 'engine.php?eng=trseng&id=trsdsp' >";
		echo "<tr><td align = 'right'>";
		echo "<fieldset>";
		echo "<br /><br />";
		echo "Item Name &nbsp;";
			echo "<select name = 'item' required = 'required'>";
				echo "<option value = ''>Select Item</option>";
					while($row1 = mysql_fetch_array($result1))
						{
				echo "<option value = '" . $row1['itemID'] . "'>" . $row1['ItemName'] . " ( " . $row1['SellingPrice'] . " )</option>";	
						}
			echo "</select>";
		echo "<br /><br />";
		echo "Quantity &nbsp;&nbsp;<input type = 'text' name = 'quantity' size='5' required = 'required' /><br /><br />";
		echo "Unit Price &nbsp;&nbsp;<input type = 'text' name = 'price' title = 'Leaving this field blank will take the selling price' />";
		echo "<br /><br />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "<tr><td align = 'center'>";
		echo "<fieldset>";
		echo "<input type = 'reset' value = 'Reset Form' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type = 'submit' value = 'Save' />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</fieldset>";

 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=trsfrm' > Record Transaction </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=trsedsp' > Edit Transaction </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=trsddsp' > Delete Transaction </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Transaction form display

// Function Transanction Edit list display 
function trsedsp()
	{
	//Table to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Staffs";
	
	// Query to retrieve Transactions' information
 	$query1 = "SELECT transID, ItemName, T.Quantity, Unit, Price, StaffName, DateTime
 				FROM $table_name1 T, $table_name2 I, $table_name3 S
				WHERE T.itemID = I.itemID AND T.staffID = S.staffID
				ORDER BY DateTime DESC";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Transactions' Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Item Name</th><th>Quantity</th><th>Staff Name</th><th>Datetime</th><th>Price</th><th>Edit</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['ItemName'] . "</td>";
			echo "<td align = 'center'>" . $row1['Quantity'] . " " . $row1['Unit'] . "</td>";
			echo "<td>" . $row1['StaffName'] . "</td>";
			echo "<td align = 'center'>" . $row1['DateTime'] . "&nbsp;</td>";
			echo "<td align = 'right'>" . $row1['Price'] . "&nbsp;</td>";
			echo "<td align = 'center'><a href = 'default.php?id=trsefrm&tr=$row1[0]' title='Edit'><img src='Images/edit.png' /></a></td>";
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=trsfrm' > Record Transaction </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=trsedsp' > Edit Transaction </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=trsddsp' > Delete Transaction </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Transaction Edit list display

// Function Transaction Edit form display 
function trsefrm()
	{
		$ID = $_GET['id'];
		$transID = $_GET['tr'];
		
	//Tables to be used	
	$table_name1 = "Items";
	$table_name2 = "Transaction";
	
	// Query to retrieve Items from Stock
 	$query1 = "SELECT * FROM $table_name1 ORDER BY Date DESC";
 	$result1 = mysql_query($query1);
	
	// Query to retrieve transaction records
 	$query2 = "SELECT T.itemID, ItemName, SellingPrice, T.Quantity, Price, DATE(DateTime) AS Date 
				FROM $table_name1 I, $table_name2 T 
				WHERE T.itemID = I.itemID AND transID = '$transID'";
 	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array($result2);
	$itemID = $row2['itemID'];
	$itemName = $row2['ItemName'];
	$sPrice = $row2['SellingPrice'];
	$quantity = $row2['Quantity'];
	$amount = $row2['Price'];
	$date = $row2['Date'];
	$uPrice = $amount / $quantity;
		
	echo "<center>";
		echo "<br/>";
		echo "<fieldset style = 'width:520px'><legend style='font-size:22px'>Transaction Editing Form</legend>";
		echo "<table border = '0' cellpadding = '1' cellspacing = '0'>";
		echo "<form method = 'post' action = 'engine.php?eng=trseeng&id=trsedsp&tr=$transID' >";
		echo "<tr><td align = 'right'>";
		echo "<fieldset>";
		echo "<br /><br />";
		echo "Item Name &nbsp;";
			echo "<select name = 'item' required = 'required'>";
				echo "<option value = '$itemID'>" . $itemName . " ( " . $sPrice . " )</option>";
					while($row1 = mysql_fetch_array($result1))
						{
				echo "<option value = '" . $row1['itemID'] . "'>" . $row1['ItemName'] . " ( " . $row1['SellingPrice'] . " )</option>";	
						}
			echo "</select>";
		echo "<br /><br />";
		echo "Quantity &nbsp;&nbsp;<input type = 'text' name = 'quantity' value = '$quantity' size='5' required = 'required' /><br /><br />";
		echo "Unit Price &nbsp;&nbsp;<input type = 'text' name = 'price' value = '$uPrice' required = 'required' />";
		echo "<br /><br />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "<tr><td align = 'center'>";
		echo "<fieldset>";
		echo "<input type = 'reset' value = 'Reset Form' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type = 'submit' value = 'Save Changes' />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</fieldset>";

 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=trsfrm' > Record Transaction </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=trsedsp' > Edit Transaction </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=trsddsp' > Delete Transaction </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Transaction Edit form display

// Function Transanction delete list display 
function trsddsp()
	{
	//Tables to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Staffs";
	
	// Query to retrieve Transactions' information
 	$query1 = "SELECT transID, ItemName, T.Quantity, Unit, Price, S.staffID, StaffName, DateTime
 				FROM $table_name1 T, $table_name2 I, $table_name3 S
				WHERE T.itemID = I.itemID AND T.staffID = S.staffID
				ORDER BY DateTime DESC";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Transactions' Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Item Name</th><th>Quantity</th><th>Staff Name</th><th>Datetime</th><th>Price</th><th>Drop</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['ItemName'] . "</td>";
			echo "<td align = 'center'>" . $row1['Quantity'] . " " . $row1['Unit'] . "</td>";
			echo "<td>" . $row1['StaffName'] . "</td>";
			echo "<td align = 'center'>" . $row1['DateTime'] . "&nbsp;</td>";
			echo "<td align = 'right'>" . $row1['Price'] . "&nbsp;</td>";
				if($row1['staffID'] == $_SESSION['staffID'])
					{
		echo "<td align = 'center'><a href = 'engine.php?eng=trsdeng&id=trsddsp&tr=$row1[0]' title='Delete'><img src='Images/drop.png' /></a></td>";
					}
				else
					{
		echo "<td align = 'center'><a href = '#?eng=trsdeng&id=trsddsp&tr=$row1[0]' title='Delete'><img src='Images/drop.png' /></a></td>";				
					}
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=trsfrm' > Record Transaction </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=trsedsp' > Edit Transaction </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=trsddsp' > Delete Transaction </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Transaction delete list display

// Function Expenditure list display 
function expdsp()
	{
	//Table to be used
	$table_name1 = "Expenditure";
	$table_name2 = "Staffs";
	
	// Query to retrieve Expenditures' information
 	$query1 = "SELECT expID, Amount, Description, StaffName, DateTime
 				FROM $table_name1 E, $table_name2 S
				WHERE E.staffID = S.staffID
				ORDER BY DateTime DESC";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Expenditures' Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Datetime</th><th>Description</th><th>Staff Name</th><th>Amount</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>&nbsp;" . $row1['DateTime'] . "&nbsp;</td>";
			echo "<td>" . $row1['Description'] . "</td>";
			echo "<td>" . $row1['StaffName'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "&nbsp;</td>";
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=expfrm' > Record Expenditure </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=expedsp' > Edit Expenditure </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=expddsp' > Delete Expenditure </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Expenditure list display

// Function Expenditure form display 
function expfrm()
	{
		$ID = $_GET['id'];
	echo "<center>";

		echo "<fieldset style = 'width:550px'><legend style='font-size:22px'>Expenditure Recording Form</legend>";
		echo "<table border = '0' cellpadding = '1' cellspacing = '0'>";
		echo "<form method = 'post' action = 'engine.php?eng=expeng&id=expdsp' >";
		echo "<tr><td align = 'right'>";
		echo "<fieldset>";
		echo "<br /><br />";
		echo "Amount &nbsp;&nbsp;<input type = 'text' name = 'amount' size='20' required = 'required' /><br /><br />";
		echo "Description &nbsp;";
		echo "<textarea name = 'reason' cols = '35' rows = '8' required = 'required' placeholder = 'Describe the reason of spending this amount'></textarea>";
		echo "<br /><br />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "<tr><td align = 'center'>";
		echo "<fieldset>";
		echo "<input type = 'reset' value = 'Reset Form' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type = 'submit' value = 'Save' />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</fieldset>";

 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=expfrm' > Record Expenditure </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=expedsp' > Edit Expenditure </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=expddsp' > Delete Expenditure </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Expenditure form display

// Function Expenditure Edit list display 
function expedsp()
	{
	//Table to be used
	$table_name1 = "Expenditure";
	$table_name2 = "Staffs";
	
	// Query to retrieve Expenditures' information
 	$query1 = "SELECT expID, Amount, Description, StaffName, DateTime, S.staffID
 				FROM $table_name1 E, $table_name2 S
				WHERE E.staffID = S.staffID
				ORDER BY DateTime DESC";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Expenditures' Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Datetime</th><th>Description</th><th>Staff Name</th><th>Amount</th><th>Edit</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>&nbsp;" . $row1['DateTime'] . "&nbsp;</td>";
			echo "<td>" . $row1['Description'] . "</td>";
			echo "<td>" . $row1['StaffName'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "&nbsp;</td>";
				if($row1['staffID'] == $_SESSION['staffID'])
					{
			echo "<td align = 'center'><a href = 'default.php?id=expefrm&xp=$row1[0]' title='Edit'><img src='Images/edit.png' /></a></td>";
					}
				else
					{
			echo "<td align = 'center'><a href = '#?id=expefrm&xp=$row1[0]' title='Edit'><img src='Images/edit.png' /></a></td>";			
					}
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=expfrm' > Record Expenditure </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=expedsp' > Edit Expenditure </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=expddsp' > Delete Expenditure </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Expenditure Edit list display

// Function Expenditure Delete list display 
function expddsp()
	{
	//Table to be used
	$table_name1 = "Expenditure";
	$table_name2 = "Staffs";
	
	// Query to retrieve Expenditures' information
 	$query1 = "SELECT expID, Amount, Description, StaffName, DateTime, S.staffID
 				FROM $table_name1 E, $table_name2 S
				WHERE E.staffID = S.staffID
				ORDER BY DateTime DESC";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Expenditures' Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Datetime</th><th>Description</th><th>Staff Name</th><th>Amount</th><th>Drop</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>&nbsp;" . $row1['DateTime'] . "&nbsp;</td>";
			echo "<td>" . $row1['Description'] . "</td>";
			echo "<td>" . $row1['StaffName'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "&nbsp;</td>";
				if($row1['staffID'] == $_SESSION['staffID'])
					{
		echo "<td align = 'center'><a href = 'engine.php?eng=expdeng&id=expddsp&xp=$row1[0]' title='Delete'><img src='Images/drop.png' /></a></td>";
					}
				else
					{
		echo "<td align = 'center'><a href = '#?eng=expdeng&id=expddsp&xp=$row1[0]' title='Delete'><img src='Images/drop.png' /></a></td>";			
					}
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=expfrm' > Record Expenditure </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=expedsp' > Edit Expenditure </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=expddsp' > Delete Expenditure </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Expenditure Delete list display

// Function Expenditure Edit form display 
function expefrm()
	{
		$xp = $_GET['xp'];
		
	//table to be used
	$table_name1 = "Expenditure";
	
	// Query to retrieve Expenditures' information
 	$query1 = "SELECT expID, Amount, Description
 				FROM $table_name1
				WHERE expID = '$xp'";
 	$result1 = mysql_query($query1);
	$row1 = mysql_fetch_array($result1);
	$amount = $row1['Amount'];
	$desc = $row1['Description'];
		
	echo "<center>";

		echo "<fieldset style = 'width:550px'><legend style='font-size:22px'>Expenditure Recording Form</legend>";
		echo "<table border = '0' cellpadding = '1' cellspacing = '0'>";
		echo "<form method = 'post' action = 'engine.php?eng=expeeng&id=expedsp&xp=$xp' >";
		echo "<tr><td align = 'right'>";
		echo "<fieldset>";
		echo "<br /><br />";
		echo "Amount &nbsp;&nbsp;<input type = 'text' name = 'amount' size='20' value = '$amount' required = 'required' /><br /><br />";
		echo "Description &nbsp;";
		echo "<textarea name = 'reason' cols = '35' rows = '8' required = 'required' placeholder = 'Describe the reason of spending this amount'>";
				echo $desc;
		echo "</textarea>";
		echo "<br /><br />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "<tr><td align = 'center'>";
		echo "<fieldset>";
		echo "<input type = 'reset' value = 'Reset Form' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type = 'submit' value = 'Save Changes' />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</fieldset>";

 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=expfrm' > Record Expenditure </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=expedsp' > Edit Expenditure </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=expddsp' > Delete Expenditure </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Expenditure Edit form display

// Function Income flow list display 
function incflowdsp()
	{
	//Table to be used
	$table_name1 = "IncomeFlow";
	
	// Query to retrieve Income flow information
 	$query1 = "SELECT incFloID, Amount, Source, Description, Date
 				FROM $table_name1
				ORDER BY Date";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Income Flow Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Date</th><th>Income Source</th><th>Description</th><th>Amount</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['Date'] . "</td>";
			echo "<td>" . $row1['Source'] . "</td>";
			echo "<td>" . $row1['Description'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "&nbsp;</td>";
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = '#' > Record Income Flow </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = '#' > Edit Income Flow </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = '#' > Delete Income Flow </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Income Flow list display

// Function Outgo flow list display 
function outgoflowdsp()
	{
	//Table to be used
	$table_name1 = "OutgoFlow";
	
	// Query to retrieve Outgo flow information
 	$query1 = "SELECT outFloID, Amount, Description, Date
 				FROM $table_name1
				ORDER BY Date";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Money Outgo Flow Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Date</th><th>Description</th><th>Amount</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['Date'] . "</td>";
			echo "<td>" . $row1['Description'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "&nbsp;</td>";
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = '#' > Record Outgo Flow </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = '#' > Edit Outgo Flow </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = '#' > Delete Outgo Flow </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Outgo Flow list display

// Function Depts records list display 
function dprdsp()
	{
	//Tables to be used
	$table_name1 = "DeptsRecords";
	$table_name2 = "Items";
	
	// Query to retrieve Depts records' information
 	$query1 = "SELECT deptID, ItemName, Unit, Dr.Quantity, Amount, Debtor, DATE(DateTime) AS Date, AmountRemain
 				FROM $table_name1 Dr, $table_name2 I
				WHERE Dr.itemID = I.itemID AND AmountRemain > 0
				ORDER BY Debtor, Date";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Depts' Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Date</th><th>Debtor</th><th>Dept Amount</th><th>Description</th><th>Amount Remain</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['Date'] . "</td>";
			echo "<td>" . $row1['Debtor'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "</td>";
			echo "<td>" . $row1['Quantity'] . " " . $row1['Unit'] . " of " . $row1['ItemName'] . "</td>";
			echo "<td align = 'right'>" . $row1['AmountRemain'] . "</td>";
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=dprfrm' > Record Dept </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=dpredsp' > Edit Dept </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=dprddsp' > Delete Dept </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Depts Records list display

// Function Dept record form display 
function dprfrm()
	{
		$ID = $_GET['id'];
	//Table to be used	
	$table_name1 = "Items";
	
	// Query to retrieve Items from Stock
 	$query1 = "SELECT * FROM $table_name1 ORDER BY Date DESC";
 	$result1 = mysql_query($query1);
	echo "<center>";

		echo "<fieldset style = 'width:600px'><legend style='font-size:22px'>Dept Recording Form</legend>";
		echo "<table border = '0' cellpadding = '1' cellspacing = '0'>";
		echo "<form method = 'post' action = 'engine.php?eng=dpreng&id=dprdsp' >";
		echo "<tr><td align = 'right'>";
		echo "<fieldset>";
		echo "<br /><br />";
		echo "Debtor Name &nbsp;<input type = 'text' name = 'debtor' size='40' required = 'required' />";
		echo "<br /><br />";
		echo "Item Name &nbsp;";
			echo "<select name = 'item' required = 'required'>";
				echo "<option value = ''>Select Item</option>";
					while($row1 = mysql_fetch_array($result1))
						{
				echo "<option value = '" . $row1['itemID'] . "'>" . $row1['ItemName'] . " ( " . $row1['SellingPrice'] . " )</option>";	
						}
			echo "</select>";
		echo "<br /><br />";
		echo "Quantity &nbsp;&nbsp;<input type = 'text' name = 'quantity' size='5' required = 'required' /><br /><br />";
		echo "Unit Price &nbsp;&nbsp;<input type = 'text' name = 'price' title = 'Leaving this field blank will take the selling price' />";
		echo "<br /><br />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "<tr><td align = 'center'>";
		echo "<fieldset>";
		echo "<fieldset>";
		echo "<input type = 'reset' value = 'Reset Form' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type = 'submit' value = 'Save' />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</fieldset>";

 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=dprfrm' > Record Dept </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=dpredsp' > Edit Dept </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=dprddsp' > Delete Dept </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Dept Record form display

// Function Depts Editing list display 
function dpredsp()
	{
	//Tables to be used
	$table_name1 = "DeptsRecords";
	$table_name2 = "Items";
	
	// Query to retrieve Depts records' information
 	$query1 = "SELECT deptID, ItemName, Unit, Dr.Quantity, Amount, Debtor, DATE(DateTime) AS Date, AmountRemain
 				FROM $table_name1 Dr, $table_name2 I
				WHERE Dr.itemID = I.itemID AND AmountRemain > 0
				ORDER BY Debtor, Date";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Depts' Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Date</th><th>Debtor</th><th>Dept Amount</th><th>Description</th><th>Amount Remain</th><th>Edit</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['Date'] . "</td>";
			echo "<td>" . $row1['Debtor'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "</td>";
			echo "<td>" . $row1['Quantity'] . " " . $row1['Unit'] . " of " . $row1['ItemName'] . "</td>";
			echo "<td align = 'right'>" . $row1['AmountRemain'] . "</td>";
			echo "<td align = 'center'><a href = 'default.php?id=dprefrm&dp=$row1[0]' title='Edit'><img src='Images/edit.png' /></a></td>";
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=dprfrm' > Record Dept </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=dpredsp' > Edit Dept </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=dprddsp' > Delete Dept </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Depts Editing list display

// Function Dept Edit form display 
function dprefrm()
	{
		$ID = $_GET['id'];
		$deptID = $_GET['dp'];
		
	//Tables to be used
	$table_name1 = "DeptsRecords";
	$table_name2 = "Items";
	
	// Query to retrieve Items from Stock
 	$query1 = "SELECT * FROM $table_name2 ORDER BY Date DESC";
 	$result1 = mysql_query($query1);
	
	// Query to retrieve depts records
 	$query2 = "SELECT Dr.itemID, ItemName, SellingPrice, Dr.Quantity, Amount, Debtor 
				FROM $table_name1 Dr, $table_name2 I 
				WHERE Dr.itemID = I.itemID AND deptID = '$deptID'";
 	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array($result2);
	$itemID = $row2['itemID'];
	$itemName = $row2['ItemName'];
	$sPrice = $row2['SellingPrice'];
	$quantity = $row2['Quantity'];
	$amount = $row2['Amount'];
	$debtor = $row2['Debtor'];
	$uPrice = $amount / $quantity;
	
	echo "<center>";

		echo "<fieldset style = 'width:600px'><legend style='font-size:22px'>Dept Editing Form</legend>";
		echo "<table border = '0' cellpadding = '1' cellspacing = '0'>";
		echo "<form method = 'post' action = 'engine.php?eng=dpreeng&id=dpredsp&dp=$deptID' >";
		echo "<tr><td align = 'right'>";
		echo "<fieldset>";
		echo "<br /><br />";
		echo "Debtor Name &nbsp;<input type = 'text' name = 'debtor' size='40' value='$debtor' required = 'required' />";
		echo "<br /><br />";
		echo "Item Name &nbsp;";
			echo "<select name = 'item' required = 'required'>";
				echo "<option value = '$itemID'>" . $itemName . " ( " . $sPrice . " )</option>";
					while($row1 = mysql_fetch_array($result1))
						{
				echo "<option value = '" . $row1['itemID'] . "'>" . $row1['ItemName'] . " ( " . $row1['SellingPrice'] . " )</option>";	
						}
			echo "</select>";
		echo "<br /><br />";
		echo "Quantity &nbsp;&nbsp;<input type = 'text' name = 'quantity' size='5' value = '$quantity' required = 'required' /><br /><br />";
		echo "Unit Price &nbsp;&nbsp;<input type = 'text' name = 'price' value = '$uPrice' required = 'required' />";
		echo "<br /><br />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "<tr><td align = 'center'>";
		echo "<fieldset>";
		echo "<fieldset>";
		echo "<input type = 'reset' value = 'Reset Form' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type = 'submit' value = 'Save' />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</fieldset>";

 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=dprfrm' > Record Dept </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=dpredsp' > Edit Dept </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=dprddsp' > Delete Dept </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Dept Edit form display

// Function Depts Delete list display 
function dprddsp()
	{
	//Tables to be used
	$table_name1 = "DeptsRecords";
	$table_name2 = "Items";
	
	// Query to retrieve Depts records' information
 	$query1 = "SELECT deptID, ItemName, Unit, Dr.Quantity, Amount, Debtor, DATE(DateTime) AS Date, AmountRemain
 				FROM $table_name1 Dr, $table_name2 I
				WHERE Dr.itemID = I.itemID AND AmountRemain > 0
				ORDER BY Debtor, Date";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Depts' Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Date</th><th>Debtor</th><th>Dept Amount</th><th>Description</th><th>Amount Remain</th><th>Drop</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['Date'] . "</td>";
			echo "<td>" . $row1['Debtor'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "</td>";
			echo "<td>" . $row1['Quantity'] . " " . $row1['Unit'] . " of " . $row1['ItemName'] . "</td>";
			echo "<td align = 'right'>" . $row1['AmountRemain'] . "</td>";
				if($row1['Amount'] == $row1['AmountRemain'])
					{
			echo "<td align = 'center'><a href = 'engine.php?eng=dprdeng&dp=$row1[0]&id=dprddsp' title='Delete'><img src='Images/drop.png' /></a></td>";
					}
				else
					{
			echo "<td align = 'center'><a href = '#?eng=dprdeng&dp=$row1[0]&id=dprddsp' title='Delete'><img src='Images/drop.png' /></a></td>";			
					}
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=dprfrm' > Record Dept </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=dpredsp' > Edit Dept </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<a href = 'default.php?id=dprddsp' > Delete Dept </a>&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Depts Delete list display

// Function Dept Payment list display 
function dptpaydsp()
	{
	//Table to be used
	$table_name1 = "DeptsPayments";
	$table_name2 = "DeptsRecords";
	
	// Query to retrieve Depts payments' information
 	$query1 = "SELECT deptPayID, Debtor, AmountRemain, Dp.Amount, Dp.Date
 				FROM $table_name1 Dp, $table_name2 Dr
				WHERE Dp.deptID = Dr.deptID
				ORDER BY Date";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Depts Payment Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Payment Date</th><th>Debtor</th><th>Amount Paid</th><th>Amount Remain</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>&nbsp;" . $row1['Date'] . "&nbsp;</td>";
			echo "<td>" . $row1['Debtor'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "&nbsp;</td>";
			echo "<td align = 'right'>" . $row1['AmountRemain'] . "&nbsp;</td>";
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=dptpayldsp' > Record Dept Payment </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Depts Payment list display

// Function Depts Payment display 
function dptpayldsp()
	{
	//Tables to be used
	$table_name1 = "DeptsRecords";
	$table_name2 = "Items";
	
	// Query to retrieve Depts records' information
 	$query1 = "SELECT deptID, ItemName, Unit, Dr.Quantity, Amount, Debtor, DATE(DateTime) AS Date, AmountRemain
 				FROM $table_name1 Dr, $table_name2 I
				WHERE Dr.itemID = I.itemID AND AmountRemain > 0
				ORDER BY Debtor, Date";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Depts' Payment</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Date</th><th>Debtor</th><th>Dept Amount</th><th>Description</th><th>Amount Remain</th><th>Pick</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>" . $row1['Date'] . "</td>";
			echo "<td>" . $row1['Debtor'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "</td>";
			echo "<td>" . $row1['Quantity'] . " " . $row1['Unit'] . " of " . $row1['ItemName'] . "</td>";
			echo "<td align = 'right'>" . $row1['AmountRemain'] . "</td>";
			echo "<td align = 'center'><a href = 'default.php?id=dptpaylfrm&dp=$row1[0]' title='Record Payment'><img src='Images/pick.png' /></a></td>";
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=dptpayldsp' > Record Dept Payment </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Depts Payment display

// Function Dept Payment form display 
function dptpaylfrm()
	{
		$ID = $_GET['id'];
		$deptID = $_GET['dp'];
		
	//Tables to be used
	$table_name1 = "DeptsRecords";
	$table_name2 = "Items";
	
	// Query to retrieve Items from Stock
 	$query1 = "SELECT * FROM $table_name2 ORDER BY Date DESC";
 	$result1 = mysql_query($query1);
	
	// Query to retrieve depts records
 	$query2 = "SELECT Dr.itemID, ItemName, SellingPrice, Dr.Quantity, AmountRemain, Debtor 
				FROM $table_name1 Dr, $table_name2 I 
				WHERE Dr.itemID = I.itemID AND deptID = '$deptID'";
 	$result2 = mysql_query($query2);
	$row2 = mysql_fetch_array($result2);
	$itemID = $row2['itemID'];
	$itemName = $row2['ItemName'];
	$sPrice = $row2['SellingPrice'];
	$quantity = $row2['Quantity'];
	$amount = $row2['AmountRemain'];
	$debtor = $row2['Debtor'];
	$uPrice = $amount / $quantity;
	
	echo "<center>";

		echo "<fieldset style = 'width:600px'><legend style='font-size:22px'>Dept Payment Form</legend>";
		echo "<table border = '0' cellpadding = '1' cellspacing = '0'>";
		echo "<form method = 'post' action = 'engine.php?eng=dptpayleng&id=dptpaydsp&dp=$deptID' >";
		echo "<tr><td align = 'right'>";
		echo "<fieldset>";
		echo "<br /><br />";
		echo "Debtor Name &nbsp;<input type = 'text' name = 'debtor' size='40' value='$debtor' disabled = 'disabled' />";
		echo "<br /><br />";
		echo "Item Name &nbsp;";
			echo "<select name = 'item' disabled = 'disabled'>";
				echo "<option value = '$itemID'>" . $itemName . " ( " . $sPrice . " )</option>";
					while($row1 = mysql_fetch_array($result1))
						{
				echo "<option value = '" . $row1['itemID'] . "'>" . $row1['ItemName'] . " ( " . $row1['SellingPrice'] . " )</option>";	
						}
			echo "</select>";
		echo "<br /><br />";
		echo "Quantity &nbsp;&nbsp;<input type = 'text' name = 'quantity' size='5' value = '$quantity' disabled = 'disabled' /><br /><br />";
		echo "Amount Remain &nbsp;&nbsp;<input type = 'text' name = 'price' value = '$amount' disabled = 'disabled' />";
		echo "<br /><br />";
		echo "Amount Paid &nbsp;&nbsp;<input type = 'text' name = 'amount' required = 'required' />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "<tr><td align = 'center'>";
		echo "<fieldset>";
		echo "<fieldset>";
		echo "<input type = 'reset' value = 'Reset Form' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		echo "<input type = 'submit' value = 'Save Payment' />";
		echo "</fieldset>";
		echo "</td></tr>";
		echo "</form>";
		echo "</table>";
		echo "</fieldset>";

 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=dptpayldsp' > Record Dept Payment </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Dept Payment form display

// Function Dept Payment delete list display 
function dptpayddsp()
	{
	//Table to be used
	$table_name1 = "DeptsPayments";
	$table_name2 = "DeptsRecords";
	
	// Query to retrieve Depts payments' information
 	$query1 = "SELECT deptPayID, Debtor, AmountRemain, Dp.Amount, Dp.Date
 				FROM $table_name1 Dp, $table_name2 Dr
				WHERE Dp.deptID = Dr.deptID
				ORDER BY Date";
 	$result1 = mysql_query($query1);
	
	echo "<center>";
	echo "<font size = '5'><b>Depts Payment Records</b></font>";
	echo "<table id = 'data' width = '98%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr><th>No.</th><th>Payment Date</th><th>Debtor</th><th>Amount Paid</th><th>Amount Remain</th><th>Drop</th></tr>";
	//Create a loop arround the results.
		$no = 1;
  	while($row1 = mysql_fetch_array($result1))
   		{
		echo "<tr>";
			echo "<td align = 'center'>" . $no . ".</td>";
			echo "<td>&nbsp;" . $row1['Date'] . "&nbsp;</td>";
			echo "<td>" . $row1['Debtor'] . "</td>";
			echo "<td align = 'right'>" . $row1['Amount'] . "&nbsp;</td>";
			echo "<td align = 'right'>" . $row1['AmountRemain'] . "&nbsp;</td>";
	echo "<td align = 'center'><a href ='engine.php?eng=dptpaydeng&id=dptpayddsp&dp=$row1[0]' title='Delete'><img src='Images/drop.png' /></a></td>";
		echo "</tr>";
		$no = $no + 1;
		}
	echo "</table>";
 	echo "</center>";
		
	echo "<p align = 'right'>";
	echo "<a href = 'default.php?id=dptpayldsp' > Record Dept Payment </a>&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;&nbsp;";
	echo "</p>";
		
	}
// The End of Function Depts Payment delete list display

// Function Account
function accdsp()
	{
	//Table to be used
	$table_name1 = "Account";
	
	//Retrieve different dates
	$query = "SELECT BusinessAccount, DeptAccount
				FROM $table_name1";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$BusinessAccount = $row['BusinessAccount'];
	$DeptAccount = $row['DeptAccount'];
	
	echo "<center>";
	echo "<p>";
	echo "<font size = '6'><b>The Amount in an Account</b></font>";
	echo "<table style='font-size:28px' id = 'data' width = '80%' border = '1' cellpadding = '1' cellspacing = '0'>";
		echo "<tr height = '100px' bgcolor = '#CCCCCC'><th>Business Account</th><th>Depts Account</th></tr>";
		echo "<tr height = '150px' bgcolor = '#EEEEEE'><td align='right'>" . number_format($BusinessAccount, 2, '.', ',') . "&nbsp;</td>
				<td align='right'>" . number_format($DeptAccount, 2, '.', ',') . "&nbsp;</td></tr>";
	echo "</table>";
	echo "</p>";
 	echo "</center>";
		
	}
// The End of Function Account

//The end of functions definitions ///////////////////////////////////////////////////////////////////////////////

// Calling the Function
	echo $ID();
//The End of Codes ///////////////////////////////////////////////////////////////////////////////////////////////
mysql_close($con);

?>