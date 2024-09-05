    <?php 

	//Calling the connection page
	include('connection.php');

//The begining of functions definitions //////////////////////////////////////////////////////////////////////////

// Starting of Reports
// The Start of Function Daily Income and Expenditure, Profit and Loss Acount Report 
function iedrep()
	{
	//Table to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Expenditure";
	
	// Query to retrieve Transactions' information
 	$query1 = "SELECT ItemName, Unit, BuyingPrice, T.Quantity, Price, Price - (T.Quantity * BuyingPrice) AS Profit, TIME(DateTime) AS Time
 				FROM $table_name1 T, $table_name2 I
				WHERE T.itemID = I.itemID AND DATE(DateTime) = DATE(NOW())
				ORDER BY DateTime ASC";
 	$result1 = mysql_query($query1);
	
	$query2 = "SELECT Amount, Description, TIME(DateTime) AS Time
				FROM $table_name3 WHERE DATE(DateTime) = DATE(NOW())
				ORDER BY DateTime ASC";
	$result2 = mysql_query($query2);
	
	echo "<center>";
	echo "<br />";
		echo "<form method = 'post' action = 'Reports.php?id=iesdrep'>";
	echo "Filter the Daily Report By Date:<input type='date' name='date' value = '" . date("Y-m-d", mktime()) . "' required='required'  />
			<input type='submit' value='Search' />&nbsp;&nbsp;&nbsp;";		
	echo "<a class='inside' href='Includes/printable.php?id=iedrep' target='blank'><img src = 'Images/print.png'>&nbsp;Print Report</a>";
	echo "</form>";
	echo "<br />";
	echo "<font size = '5'><b>Income and Expenditure (Profit and Loss Account)<br />Daily Report ( " . date("d F, Y", mktime()) . " )</b></font>";
	echo "<table id = 'data1' width = '710px' border = '1' cellpadding = '0' cellspacing = '0'>";
		echo "<tr><th colspan='5' width='410px'>INCOME</th><th colspan='3' width = '300px'>EXPENDITURE</th></tr>";
		echo "<tr>";
		echo "<th rowspan='2' width='60px'>TIME</th><th rowspan='2' width='150px'>Item<br/>Sold</th><th rowspan='2'  width='80px'>Selling<br/>Price</th>";
		echo "<th colspan='2' width='120px'>Profit & Loss</th><th rowspan='2' width='60px'>TIME</th><th rowspan='2' width='160px'>Description</th>";
		echo "<th rowspan='2' width='80px'>Amount</th>";
		echo "</tr>";
		echo "<tr><th width='60px'>Profit</th><th width='60px'>Loss</th></tr>";
		echo "<tr><td colspan='5' valign='top'>";
			echo "<table id = 'data2' width = '100%' border = '1' cellpadding = '0' cellspacing = '0'>";
			$tPrice = 0; $tProfit = 0; $tLoss = 0;
				while($row1 = mysql_fetch_array($result1))
					{
				echo "<tr>";
					echo "<td align='center' width='60px'>" . $row1['Time'] . "</td>";
					echo "<td width='150px'>" . $row1['ItemName'] . ", " . $row1['Quantity'] . " " . $row1['Unit'] . "</td>";
					echo "<td align='right' width='80px'>" . number_format($row1['Price'], 2, '.', ',') . "</td>";
						if($row1['Profit'] > 0)
							{
					echo "<td align='right' width='60px'>" . number_format($row1['Profit'], 2, '.', ',') . "</td>";
							$tProfit = $tProfit + $row1['Profit'];
							}
						else
							{
					echo "<td align='right' width='60px'> - </td>";			
							}
						if($row1['Profit'] < 0)
							{
					echo "<td align='right' width='60px'>" . number_format(-$row1['Profit'], 2, '.', ',') . "</td>";
							$tLoss = $tLoss - $row1['Profit'];
							}
						else
							{
					echo "<td align='right' width='60px'> - </td>";			
							}
				echo "</tr>";
					$tPrice = $tPrice + $row1['Price'];	
					}
			echo "</table>";
		echo "</td>";
		echo "<td colspan='3' valign='top'>";
			echo "<table id = 'data2' width = '100%' border = '1' cellpadding = '0' cellspacing = '0'>";
				$tExpenditure = 0;
				while($row2 = mysql_fetch_array($result2))
					{
				echo "<tr>";
					echo "<td align='center' width='60px'>" . $row2['Time'] . "</td>";
					echo "<td width='160px'>" . $row2['Description'] . "</td>";
					echo "<td align='right' width = '80px'>" . number_format($row2['Amount'], 2, '.', ',') . "</td>";
				$tExpenditure = $tExpenditure + $row2['Amount'];			
					}
			echo "</table>";
		echo "</td>";
		echo "</tr>";
		echo "<tr><td colspan='8'><hr /></td></tr>";
		echo "<tr><th colspan='2'>TOTAL</th><td align='right'>" . number_format($tPrice, 2, '.', ',') . "</td>
					<td align='right'>" . number_format($tProfit, 2, '.', ',') . "</td>";
		echo "<td align='right'>" . number_format($tLoss, 2, '.', ',') . "</td><th colspan='2'>TOTAL</th>
					<td align='right'>" . number_format($tExpenditure, 2, '.', ',') . "</td>";
		echo "</tr>";
		echo "<tr><td colspan='8'><hr /></td></tr>";
		echo "<tr><td colspan='8' align='center'>";
		echo "Profit Remain = Total Profit - Total Loss - Total Expenditure <br />";
			$profit = $tProfit - $tLoss - $tExpenditure;
		echo "Which is = " . number_format($tProfit, 2, '.', ',') . " - " . number_format($tLoss, 2, '.', ',') . " - " .
		 number_format($tExpenditure, 2, '.', ',') . "<br />";
		echo " = " . number_format($profit, 2, '.', ',');
		echo "</td></tr>";
			if($profit > 0)
				{
		echo "<tr><td colspan='8' align='center'>The Business run Daily Transaction under the Profit of <u>" . number_format($profit, 2, '.', ',') . "</u></tr>";
				}
			else
				{
		echo "<tr><th colspan='8' align='center'><b>The Business run Daily Transaction under the Loss of <u>" . number_format(-$profit, 2, '.', ',') . "</u></b></th></tr>";		
				}
	echo "</table>";
 	echo "</center>";
	}
// The End of Function Daily Income and Expenditure, Profit and Loss Acount Report

// The Start of Function Searched Daily Income and Expenditure, Profit and Loss Acount Report 
function iesdrep()
	{
		//Receive the Date
		$date = $_POST['date'];
	//Table to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Expenditure";
	
	// Query to retrieve Transactions' information
 	$query1 = "SELECT ItemName, Unit, BuyingPrice, T.Quantity, Price, Price - (T.Quantity * BuyingPrice) AS Profit, TIME(DateTime) AS Time
 				FROM $table_name1 T, $table_name2 I
				WHERE T.itemID = I.itemID AND DATE(DateTime) = '$date'
				ORDER BY DateTime ASC";
 	$result1 = mysql_query($query1);
	
	$query2 = "SELECT Amount, Description, TIME(DateTime) AS Time
				FROM $table_name3 WHERE DATE(DateTime) = '$date'
				ORDER BY DateTime ASC";
	$result2 = mysql_query($query2);
	
	echo "<center>";
	echo "<br />";
		echo "<form method = 'post' action = 'Reports.php?id=iesdrep'>";
	echo "Filter the Daily Report By Date:<input type='date' name='date' value = '" . date("Y-m-d", mktime()) . "' required='required' />
			<input type='submit' value='Search' />&nbsp;&nbsp;&nbsp;";		
	echo "<a class='inside' href='Includes/printable.php?id=iesdrep&d=$date' target='blank'><img src = 'Images/print.png'>&nbsp;Print Report</a>";
	echo "</form>";
	echo "<br />";
	echo "<font size = '5'><b>Income and Expenditure (Profit and Loss Account)<br />Daily Report ( " . $date . " )</b></font>";
	echo "<table id = 'data1' width = '710px' border = '1' cellpadding = '0' cellspacing = '0'>";
		echo "<tr><th colspan='5' width='410px'>INCOME</th><th colspan='3' width = '300px'>EXPENDITURE</th></tr>";
		echo "<tr>";
		echo "<th rowspan='2' width='60px'>TIME</th><th rowspan='2' width='150px'>Item<br/>Sold</th><th rowspan='2'  width='80px'>Selling<br/>Price</th>";
		echo "<th colspan='2' width='120px'>Profit & Loss</th><th rowspan='2' width='60px'>TIME</th><th rowspan='2' width='160px'>Description</th>";
		echo "<th rowspan='2' width='80px'>Amount</th>";
		echo "</tr>";
		echo "<tr><th width='60px'>Profit</th><th width='60px'>Loss</th></tr>";
		echo "<tr><td colspan='5' valign='top'>";
			echo "<table id = 'data2' width = '100%' border = '1' cellpadding = '0' cellspacing = '0'>";
			$tPrice = 0; $tProfit = 0; $tLoss = 0;
				while($row1 = mysql_fetch_array($result1))
					{
				echo "<tr>";
					echo "<td align='center' width='60px'>" . $row1['Time'] . "</td>";
					echo "<td width='150px'>" . $row1['ItemName'] . ", " . $row1['Quantity'] . " " . $row1['Unit'] . "</td>";
					echo "<td align='right' width='80px'>" . number_format($row1['Price'], 2, '.', ',') . "</td>";
						if($row1['Profit'] > 0)
							{
					echo "<td align='right' width='60px'>" . number_format($row1['Profit'], 2, '.', ',') . "</td>";
							$tProfit = $tProfit + $row1['Profit'];
							}
						else
							{
					echo "<td align='right' width='60px'> - </td>";			
							}
						if($row1['Profit'] < 0)
							{
					echo "<td align='right' width='60px'>" . number_format(-$row1['Profit'], 2, '.', ',') . "</td>";
							$tLoss = $tLoss - $row1['Profit'];
							}
						else
							{
					echo "<td align='right' width='60px'> - </td>";			
							}
				echo "</tr>";
					$tPrice = $tPrice + $row1['Price'];	
					}
			echo "</table>";
		echo "</td>";
		echo "<td colspan='3' valign='top'>";
			echo "<table id = 'data2' width = '100%' border = '1' cellpadding = '0' cellspacing = '0'>";
				$tExpenditure = 0;
				while($row2 = mysql_fetch_array($result2))
					{
				echo "<tr>";
					echo "<td align='center' width='60px'>" . $row2['Time'] . "</td>";
					echo "<td width='160px'>" . $row2['Description'] . "</td>";
					echo "<td align='right' width='80px'>" . number_format($row2['Amount'], 2, '.', ',') . "</td>";
				$tExpenditure = $tExpenditure + $row2['Amount'];			
					}
			echo "</table>";
		echo "</td>";
		echo "</tr>";
		echo "<tr><td colspan='8'><hr /></td></tr>";
		echo "<tr><th colspan='2'>TOTAL</th><td align='right'>" . number_format($tPrice, 2, '.', ',') . "</td>
					<td align='right'>" . number_format($tProfit, 2, '.', ',') . "</td>";
		echo "<td align='right'>" . number_format($tLoss, 2, '.', ',') . "</td><th colspan='2'>TOTAL</th>
					<td align='right'>" . number_format($tExpenditure, 2, '.', ',') . "</td>";
		echo "</tr>";
		echo "<tr><td colspan='8'><hr /></td></tr>";
		echo "<tr><td colspan='8' align='center'>";
		echo "Profit Remain = Total Profit - Total Loss - Total Expenditure <br />";
			$profit = $tProfit - $tLoss - $tExpenditure;
		echo "Which is = " . number_format($tProfit, 2, '.', ',') . " - " . number_format($tLoss, 2, '.', ',') . " - " .
		 number_format($tExpenditure, 2, '.', ',') . "<br />";
		echo " = " . number_format($profit, 2, '.', ',');
		echo "</td></tr>";
			if($profit > 0)
				{
		echo "<tr><td colspan='8' align='center'>The Business run Daily Transaction under the Profit of <u>" . number_format($profit, 2, '.', ',') . "</u></tr>";
				}
			else
				{
		echo "<tr><th colspan='8' align='center'><b>The Business run Daily Transaction under the Loss of <u>" . number_format(-$profit, 2, '.', ',') . "</u></b></th></tr>";		
				}
	echo "</table>";
 	echo "</center>";
	}
// The End of Function Searched Daily Income and Expenditure, Profit and Loss Acount Report

// The Start of Function Monthly Income and Expenditure, Profit and Loss Acount Report 
function iemrep()
	{
	//Table to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Expenditure";
	$table_name4 = "MonthlyTransaction";
	$table_name5 = "MonthlyExpenditure";
	
	//Retrieve Years within Transaction
	$query = "SELECT DISTINCT(YEAR(DateTime)) AS Years FROM $table_name1";
	$result = mysql_query($query);
	
	//Retrieve the Monthly Transaction
	$query1 = "SELECT Amount, Date FROM $table_name4 WHERE MONTH(Date) = MONTH(NOW()) AND YEAR(Date) = YEAR(NOW()) ORDER BY Date"; 
	$result1 = mysql_query($query1);
	
	//Retrieve the Monthly Expenditure
	$query2 = "SELECT Amount, Date
				FROM $table_name5 WHERE MONTH(Date) = MONTH(NOW()) AND YEAR(Date) = YEAR(NOW())
				ORDER BY Date";
	$result2 = mysql_query($query2);
	
	echo "<center>";
	echo "<br />";
		echo "<form method = 'post' action = 'Reports.php?id=iesmrep'>";
	echo "Filter the Monthly Report By Month:";
		echo "<select name = 'month' required='required'>";
			echo "<option value='" . date("m", mktime()) . "'>" . date("F", mktime()) . "</option>";
			echo "<option value='01'>January</option>";
			echo "<option value='02'>February</option>";
			echo "<option value='03'>March</option>";
			echo "<option value='04'>April</option>";
			echo "<option value='05'>May</option>";
			echo "<option value='06'>June</option>";
			echo "<option value='07'>July</option>";
			echo "<option value='08'>August</option>";
			echo "<option value='09'>September</option>";
			echo "<option value='10'>October</option>";
			echo "<option value='11'>November</option>";
			echo "<option value='12'>December</option>";
		echo "</select>";
	echo "&nbsp;&nbsp; and Year:";
		echo "<select name = 'year' required='required'>";
			echo "<option value='" . date("Y", mktime()) . "'>" . date("Y", mktime()) . "</option>";
				while($row = mysql_fetch_array($result))
					{
			echo "<option value='" . $row['Years'] . "'>" . $row['Years'] . "</option>";	
					}
		echo "</select>";
	echo "<input type='submit' value='Search' />&nbsp;&nbsp;&nbsp;";		
	echo "<a class='inside' href='Includes/printable.php?id=iemrep' target='blank'><img src = 'Images/print.png'>&nbsp;Print Report</a>";
	echo "</form>";
	echo "<br />";
	echo "<font size = '5'><b>Income and Expenditure (Profit and Loss Account)<br />Monthly Report ( " . date("F, Y", mktime()) . " )</b></font>";
	
	echo "<table id = 'data1' width = '710px' border = '1' cellpadding = '0' cellspacing = '0'>";
		echo "<tr><th colspan='4' width='470px'>INCOME</th><th colspan='2' width = '240px'>EXPENDITURE</th></tr>";
		echo "<tr>";
		echo "<th rowspan='2' width='110px'>DATE</th><th rowspan='2'  width='130px'>Amount</th>";
		echo "<th colspan='2' width='230px'>Profit & Loss</th><th rowspan='2' width='110px'>DATE</th>";
		echo "<th rowspan='2' width='130px'>Amount</th>";
		echo "</tr>";
		echo "<tr><th width='115px'>Profit</th><th width='115px'>Loss</th></tr>";
		echo "<tr><td colspan='4' valign='top'>";
			echo "<table id = 'data2' width = '100%' border = '1' cellpadding = '0' cellspacing = '0'>";
			$tAmount = 0; $tProfit = 0; $tLoss = 0;
				while($row1 = mysql_fetch_array($result1))
					{
			//Retrieve Total daily Profit or Loss
			$query3 = "SELECT SUM(Price - (T.Quantity * BuyingPrice)) AS sProfit
						FROM $table_name1 T, $table_name2 I
						WHERE T.itemID = I.itemID AND DATE(DateTime) = '$row1[1]' AND YEAR(DateTime) = YEAR(NOW())";
			$result3 = mysql_query($query3);
			$row3 = mysql_fetch_array($result3);
			$sProfit = $row3['sProfit'];
						
				echo "<tr>";
					echo "<td align='center' width='110px'>" . $row1['Date'] . "</td>";
					echo "<td align='right' width='130px'>" . number_format($row1['Amount'], 2, '.', ',') . "</td>";
						if($sProfit > 0)
							{
					echo "<td align='right' width='115px'>" . number_format($sProfit, 2, '.', ',') . "</td>";
							$tProfit = $tProfit + $sProfit;
							}
						else
							{
					echo "<td align='right' width='115px'> - </td>";			
							}
						if($sProfit < 0)
							{
					echo "<td align='right' width='115px'>" . number_format(-$sProfit, 2, '.', ',') . "</td>";
							$tLoss = $tLoss - $sProfit;
							}
						else
							{
					echo "<td align='right' width='115px'> - </td>";			
							}
				echo "</tr>";
					$tAmount = $tAmount + $row1['Amount'];	
					}
			echo "</table>";
		echo "</td>";
		echo "<td colspan='2' valign='top'>";
			echo "<table id = 'data2' width = '100%' border = '1' cellpadding = '0' cellspacing = '0'>";
				$tExpenditure = 0;
				while($row2 = mysql_fetch_array($result2))
					{
				echo "<tr>";
					echo "<td align='center' width='110px'>" . $row2['Date'] . "</td>";
					echo "<td align='right' width = '130px'>" . number_format($row2['Amount'], 2, '.', ',') . "</td>";
				$tExpenditure = $tExpenditure + $row2['Amount'];			
					}
			echo "</table>";
		echo "</td>";
		echo "</tr>";
		echo "<tr><td colspan='6'><hr /></td></tr>";
		echo "<tr><th>TOTAL</th><td align='right'>" . number_format($tAmount, 2, '.', ',') . "</td>
					<td align='right'>" . number_format($tProfit, 2, '.', ',') . "</td>";
		echo "<td align='right'>" . number_format($tLoss, 2, '.', ',') . "</td><th>TOTAL</th>
					<td align='right'>" . number_format($tExpenditure, 2, '.', ',') . "</td>";
		echo "</tr>";
		echo "<tr><td colspan='6'><hr /></td></tr>";
		echo "<tr><td colspan='6' align='center'>";
		echo "Profit Remain = Total Profit - Total Loss - Total Expenditure <br />";
			$profit = $tProfit - $tLoss - $tExpenditure;
		echo "Which is = " . number_format($tProfit, 2, '.', ',') . " - " . number_format($tLoss, 2, '.', ',') . " - " .
		 number_format($tExpenditure, 2, '.', ',') . "<br />";
		echo " = " . number_format($profit, 2, '.', ',');
		echo "</td></tr>";
			if($profit > 0)
				{
		echo "<tr><td colspan='6' align='center'>The Business run Monthly Transaction under the Profit of <u>" . number_format($profit, 2, '.', ',') . "</u></tr>";
				}
			else
				{
		echo "<tr><th colspan='6' align='center'><b>The Business run Monthly Transaction under the Loss of <u>" . number_format(-$profit, 2, '.', ',') . "</u></b></th></tr>";		
				}
	echo "</table>";
 	echo "</center>";
	}
// The End of Function Monthly Income and Expenditure, Profit and Loss Acount Report

// The Start of Function Searched Monthly Income and Expenditure, Profit and Loss Acount Report 
function iesmrep()
	{
	//Receive month and year
	$month = $_POST['month'];
	$year = $_POST['year'];
	
	if($month == '01'){$mon = 'January';} elseif($month == '02'){$mon = 'February';} elseif($month == '03'){$mon = 'March';}
	elseif($month == '04'){$mon = 'April';} elseif($month == '05'){$mon = 'May';} elseif($month == '06'){$mon = 'June';}
	elseif($month == '07'){$mon = 'July';} elseif($month == '08'){$mon = 'August';} elseif($month == '09'){$mon = 'September';}
	elseif($month == '10'){$mon = 'October';} elseif($month == '11'){$mon = 'November';} elseif($month == '12'){$mon = 'December';}
	
	//Table to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Expenditure";
	$table_name4 = "MonthlyTransaction";
	$table_name5 = "MonthlyExpenditure";
	
	//Retrieve Years within Transaction
	$query = "SELECT DISTINCT(YEAR(DateTime)) AS Years FROM $table_name1";
	$result = mysql_query($query);
	
	//Retrieve the Monthly Transaction
	$query1 = "SELECT Amount, Date FROM $table_name4 WHERE MONTH(Date) = '$month' AND YEAR(Date) = '$year' ORDER BY Date"; 
	$result1 = mysql_query($query1);
	
	//Retrieve the Monthly Expenditure
	$query2 = "SELECT Amount, Date
				FROM $table_name5 WHERE MONTH(Date) = '$month' AND YEAR(Date) = '$year'
				ORDER BY Date";
	$result2 = mysql_query($query2);
	
	echo "<center>";
	echo "<br />";
		echo "<form method = 'post' action = 'Reports.php?id=iesmrep'>";
	echo "Filter the Monthly Report By Month:";
		echo "<select name = 'month' required='required'>";
			echo "<option value='" . date("m", mktime()) . "'>" . date("F", mktime()) . "</option>";
			echo "<option value='01'>January</option>";
			echo "<option value='02'>February</option>";
			echo "<option value='03'>March</option>";
			echo "<option value='04'>April</option>";
			echo "<option value='05'>May</option>";
			echo "<option value='06'>June</option>";
			echo "<option value='07'>July</option>";
			echo "<option value='08'>August</option>";
			echo "<option value='09'>September</option>";
			echo "<option value='10'>October</option>";
			echo "<option value='11'>November</option>";
			echo "<option value='12'>December</option>";
		echo "</select>";
	echo "&nbsp;&nbsp; and Year:";
		echo "<select name = 'year' required='required'>";
			echo "<option value='" . date("Y", mktime()) . "'>" . date("Y", mktime()) . "</option>";
				while($row = mysql_fetch_array($result))
					{
			echo "<option value='" . $row['Years'] . "'>" . $row['Years'] . "</option>";	
					}
		echo "</select>";
	echo "<input type='submit' value='Search' />&nbsp;&nbsp;&nbsp;";		
	echo "<a class='inside' href='Includes/printable.php?id=iesmrep&mo=$month&ye=$year' target='blank'><img src = 'Images/print.png'>&nbsp;Print Report</a>";
	echo "</form>";
	echo "<br />";
	echo "<font size = '5'><b>Income and Expenditure (Profit and Loss Account)<br />Daily Report ( " . $mon . ", " . $year . " )</b></font>";
	
	echo "<table id = 'data1' width = '710px' border = '1' cellpadding = '0' cellspacing = '0'>";
		echo "<tr><th colspan='4' width='470px'>INCOME</th><th colspan='2' width = '240px'>EXPENDITURE</th></tr>";
		echo "<tr>";
		echo "<th rowspan='2' width='110px'>DATE</th><th rowspan='2'  width='130px'>Amount</th>";
		echo "<th colspan='2' width='230px'>Profit & Loss</th><th rowspan='2' width='110px'>DATE</th>";
		echo "<th rowspan='2' width='130px'>Amount</th>";
		echo "</tr>";
		echo "<tr><th width='115px'>Profit</th><th width='115px'>Loss</th></tr>";
		echo "<tr><td colspan='4' valign='top'>";
			echo "<table id = 'data2' width = '100%' border = '1' cellpadding = '0' cellspacing = '0'>";
			$tAmount = 0; $tProfit = 0; $tLoss = 0;
				while($row1 = mysql_fetch_array($result1))
					{
			//Retrieve Total daily Profit or Loss
			$query3 = "SELECT SUM(Price - (T.Quantity * BuyingPrice)) AS sProfit
						FROM $table_name1 T, $table_name2 I
						WHERE T.itemID = I.itemID AND DATE(DateTime) = '$row1[1]' AND YEAR(DateTime) = '$year'";
			$result3 = mysql_query($query3);
			$row3 = mysql_fetch_array($result3);
			$sProfit = $row3['sProfit'];
						
				echo "<tr>";
					echo "<td align='center' width='110px'>" . $row1['Date'] . "</td>";
					echo "<td align='right' width='130px'>" . number_format($row1['Amount'], 2, '.', ',') . "</td>";
						if($sProfit > 0)
							{
					echo "<td align='right' width='115px'>" . number_format($sProfit, 2, '.', ',') . "</td>";
							$tProfit = $tProfit + $sProfit;
							}
						else
							{
					echo "<td align='right' width='115px'> - </td>";			
							}
						if($sProfit < 0)
							{
					echo "<td align='right' width='115px'>" . number_format(-$sProfit, 2, '.', ',') . "</td>";
							$tLoss = $tLoss - $sProfit;
							}
						else
							{
					echo "<td align='right' width='115px'> - </td>";			
							}
				echo "</tr>";
					$tAmount = $tAmount + $row1['Amount'];	
					}
			echo "</table>";
		echo "</td>";
		echo "<td colspan='2' valign='top'>";
			echo "<table id = 'data2' width = '100%' border = '1' cellpadding = '0' cellspacing = '0'>";
				$tExpenditure = 0;
				while($row2 = mysql_fetch_array($result2))
					{
				echo "<tr>";
					echo "<td align='center' width='110px'>" . $row2['Date'] . "</td>";
					echo "<td align='right' width = '130px'>" . number_format($row2['Amount'], 2, '.', ',') . "</td>";
				$tExpenditure = $tExpenditure + $row2['Amount'];			
					}
			echo "</table>";
		echo "</td>";
		echo "</tr>";
		echo "<tr><td colspan='6'><hr /></td></tr>";
		echo "<tr><th>TOTAL</th><td align='right'>" . number_format($tAmount, 2, '.', ',') . "</td>
					<td align='right'>" . number_format($tProfit, 2, '.', ',') . "</td>";
		echo "<td align='right'>" . number_format($tLoss, 2, '.', ',') . "</td><th>TOTAL</th>
					<td align='right'>" . number_format($tExpenditure, 2, '.', ',') . "</td>";
		echo "</tr>";
		echo "<tr><td colspan='6'><hr /></td></tr>";
		echo "<tr><td colspan='6' align='center'>";
		echo "Profit Remain = Total Profit - Total Loss - Total Expenditure <br />";
			$profit = $tProfit - $tLoss - $tExpenditure;
		echo "Which is = " . number_format($tProfit, 2, '.', ',') . " - " . number_format($tLoss, 2, '.', ',') . " - " .
		 number_format($tExpenditure, 2, '.', ',') . "<br />";
		echo " = " . number_format($profit, 2, '.', ',');
		echo "</td></tr>";
			if($profit > 0)
				{
		echo "<tr><td colspan='6' align='center'>The Business run Monthly Transaction under the Profit of <u>" . number_format($profit, 2, '.', ',') . "</u></tr>";
				}
			else
				{
		echo "<tr><th colspan='6' align='center'><b>The Business run Monthly Transaction under the Loss of <u>" . number_format(-$profit, 2, '.', ',') . "</u></b></th></tr>";		
				}
	echo "</table>";
 	echo "</center>";
	}
// The End of Function Searched Monthly Income and Expenditure, Profit and Loss Acount Report

// The Start of Function Annual Income and Expenditure, Profit and Loss Acount Report 
function iearep()
	{
	//Table to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Expenditure";
	$table_name4 = "MonthlyTransaction";
	$table_name5 = "MonthlyExpenditure";
	
	//Retrieve Years within Transaction
	$query = "SELECT DISTINCT(YEAR(DateTime)) AS Years FROM $table_name1";
	$result = mysql_query($query);
	
	//Retrieve Monthes within the year
	$query4 = "SELECT DISTINCT(MONTH(Date)) AS Monthes, DATE_FORMAT(Date, '%M') AS Mwezi FROM $table_name4 WHERE YEAR(Date) = YEAR(NOW())";
	$result4 = mysql_query($query4);
	
	echo "<center>";
	echo "<br />";
		echo "<form method = 'post' action = 'Reports.php?id=iesarep'>";
	echo "Filter the Annual Report By Year:";
		echo "<select name = 'year' required='required'>";
			echo "<option value='" . date("Y", mktime()) . "'>" . date("Y", mktime()) . "</option>";
				while($row = mysql_fetch_array($result))
					{
			echo "<option value='" . $row['Years'] . "'>" . $row['Years'] . "</option>";	
					}
		echo "</select>";
	echo "<input type='submit' value='Search' />&nbsp;&nbsp;&nbsp;";		
	echo "<a class='inside' href='Includes/printable.php?id=iearep' target='blank'><img src = 'Images/print.png'>&nbsp;Print Report</a>";
	echo "</form>";
	echo "<br />";
	echo "<font size = '5'><b>Income and Expenditure (Profit and Loss Account)<br />Annual Report ( " . date("Y", mktime()) . " )</b></font>";
	
	echo "<table id = 'data1' width = '710px' border = '1' cellpadding = '0' cellspacing = '0'>";
		echo "<tr><th colspan='4' width='470px'>INCOME</th><th colspan='2' width = '240px'>EXPENDITURE</th></tr>";
		echo "<tr>";
		echo "<th rowspan='2' width='110px'>MONTH</th><th rowspan='2'  width='130px'>Amount</th>";
		echo "<th colspan='2' width='230px'>Profit & Loss</th><th rowspan='2' width='110px'>MONTH</th>";
		echo "<th rowspan='2' width='130px'>Amount</th>";
		echo "</tr>";
		echo "<tr><th width='115px'>Profit</th><th width='115px'>Loss</th></tr>";
		echo "<tr>";
			$tAmount = 0; $tProfit = 0; $tLoss = 0; $tExpenditure = 0;
			while($row4 = mysql_fetch_array($result4))
				{			
				//Retrieve the sum of Monthly Transaction
				$query1 = "SELECT SUM(Amount) AS sAmount FROM $table_name4 WHERE MONTH(Date) = '$row4[0]' AND YEAR(Date) = YEAR(NOW())"; 
				$result1 = mysql_query($query1);
				$row1 = mysql_fetch_array($result1);
				$sAmount = $row1['sAmount'];
				
				//Retrieve the sum of Monthly Expenditure
				$query2 = "SELECT SUM(Amount) AS sExpenditure FROM $table_name5 WHERE MONTH(Date) = '$row4[0]' AND YEAR(Date) = YEAR(NOW())"; 
				$result2 = mysql_query($query2);
				$row2 = mysql_fetch_array($result2);
				$sExpenditure = $row2['sExpenditure'];

				//Retrieve Total Monthly Profit or Loss
				$query3 = "SELECT SUM(Price - (T.Quantity * BuyingPrice)) AS sProfit
							FROM $table_name1 T, $table_name2 I
							WHERE T.itemID = I.itemID AND MONTH(DateTime) = '$row4[0]' AND YEAR(DateTime) = YEAR(NOW())";
				$result3 = mysql_query($query3);
				$row3 = mysql_fetch_array($result3);
				$sProfit = $row3['sProfit'];
						
					echo "<td align='center' width='110px'>" . $row4['Mwezi'] . "</td>";
					echo "<td align='right' width='130px'>" . number_format($sAmount, 2, '.', ',') . "</td>";
						if($sProfit > 0)
							{
					echo "<td align='right' width='115px'>" . number_format($sProfit, 2, '.', ',') . "</td>";
							$tProfit = $tProfit + $sProfit;
							}
						else
							{
					echo "<td align='right' width='115px'> - </td>";			
							}
						if($sProfit < 0)
							{
					echo "<td align='right' width='115px'>" . number_format(-$sProfit, 2, '.', ',') . "</td>";
							$tLoss = $tLoss - $sProfit;
							}
						else
							{
					echo "<td align='right' width='115px'> - </td>";			
							}

					echo "<td align='center' width='110px'>" . $row4['Mwezi'] . "</td>";
					echo "<td align='right' width = '130px'>" . number_format($sExpenditure, 2, '.', ',') . "</td>";
	
		echo "</tr>";
				$tAmount = $tAmount + $sAmount;
				$tExpenditure = $tExpenditure + $sExpenditure;			
		
				}
		
		echo "<tr><td colspan='6'><hr /></td></tr>";
		echo "<tr><th>TOTAL</th><td align='right'>" . number_format($tAmount, 2, '.', ',') . "</td>
					<td align='right'>" . number_format($tProfit, 2, '.', ',') . "</td>";
		echo "<td align='right'>" . number_format($tLoss, 2, '.', ',') . "</td><th>TOTAL</th>
					<td align='right'>" . number_format($tExpenditure, 2, '.', ',') . "</td>";
		echo "</tr>";
		echo "<tr><td colspan='6'><hr /></td></tr>";
		echo "<tr><td colspan='6' align='center'>";
		echo "Profit Remain = Total Profit - Total Loss - Total Expenditure <br />";
			$profit = $tProfit - $tLoss - $tExpenditure;
		echo "Which is = " . number_format($tProfit, 2, '.', ',') . " - " . number_format($tLoss, 2, '.', ',') . " - " .
		 number_format($tExpenditure, 2, '.', ',') . "<br />";
		echo " = " . number_format($profit, 2, '.', ',');
		echo "</td></tr>";
			if($profit > 0)
				{
		echo "<tr><td colspan='6' align='center'>The Business run Annual Transaction under the Profit of <u>" . number_format($profit, 2, '.', ',') . "</u></tr>";
				}
			else
				{
		echo "<tr><th colspan='6' align='center'><b>The Business run Annual Transaction under the Loss of <u>" . number_format(-$profit, 2, '.', ',') . "</u></b></th></tr>";		
				}
	echo "</table>";
 	echo "</center>";
	}
// The End of Function Annual Income and Expenditure, Profit and Loss Acount Report

// The Start of Function Searched Annual Income and Expenditure, Profit and Loss Acount Report 
function iesarep()
	{
	//Receive the year
	$year = $_POST['year'];
		
	//Table to be used
	$table_name1 = "Transaction";
	$table_name2 = "Items";
	$table_name3 = "Expenditure";
	$table_name4 = "MonthlyTransaction";
	$table_name5 = "MonthlyExpenditure";
	
	//Retrieve Years within Transaction
	$query = "SELECT DISTINCT(YEAR(DateTime)) AS Years FROM $table_name1";
	$result = mysql_query($query);
	
	//Retrieve Monthes within the year
	$query4 = "SELECT DISTINCT(MONTH(Date)) AS Monthes, DATE_FORMAT(Date, '%M') AS Mwezi FROM $table_name4 WHERE YEAR(Date) = '$year'";
	$result4 = mysql_query($query4);
	
	echo "<center>";
	echo "<br />";
		echo "<form method = 'post' action = 'Reports.php?id=iesarep'>";
	echo "Filter the Annual Report By Year:";
		echo "<select name = 'year' required='required'>";
			echo "<option value='" . date("Y", mktime()) . "'>" . date("Y", mktime()) . "</option>";
				while($row = mysql_fetch_array($result))
					{
			echo "<option value='" . $row['Years'] . "'>" . $row['Years'] . "</option>";	
					}
		echo "</select>";
	echo "<input type='submit' value='Search' />&nbsp;&nbsp;&nbsp;";		
	echo "<a class='inside' href='Includes/printable.php?id=iesarep&ye=$year' target='blank'><img src = 'Images/print.png'>&nbsp;Print Report</a>";
	echo "</form>";
	echo "<br />";
	echo "<font size = '5'><b>Income and Expenditure (Profit and Loss Account)<br />Annual Report ( " . $year . " )</b></font>";
	
	echo "<table id = 'data1' width = '710px' border = '1' cellpadding = '0' cellspacing = '0'>";
		echo "<tr><th colspan='4' width='470px'>INCOME</th><th colspan='2' width = '240px'>EXPENDITURE</th></tr>";
		echo "<tr>";
		echo "<th rowspan='2' width='110px'>MONTH</th><th rowspan='2'  width='130px'>Amount</th>";
		echo "<th colspan='2' width='230px'>Profit & Loss</th><th rowspan='2' width='110px'>MONTH</th>";
		echo "<th rowspan='2' width='130px'>Amount</th>";
		echo "</tr>";
		echo "<tr><th width='115px'>Profit</th><th width='115px'>Loss</th></tr>";
		echo "<tr>";
			$tAmount = 0; $tProfit = 0; $tLoss = 0; $tExpenditure = 0;
			while($row4 = mysql_fetch_array($result4))
				{			
				//Retrieve the sum of Monthly Transaction
				$query1 = "SELECT SUM(Amount) AS sAmount FROM $table_name4 WHERE MONTH(Date) = '$row4[0]' AND YEAR(Date) = '$year'"; 
				$result1 = mysql_query($query1);
				$row1 = mysql_fetch_array($result1);
				$sAmount = $row1['sAmount'];
				
				//Retrieve the sum of Monthly Expenditure
				$query2 = "SELECT SUM(Amount) AS sExpenditure FROM $table_name5 WHERE MONTH(Date) = '$row4[0]' AND YEAR(Date) = '$year'"; 
				$result2 = mysql_query($query2);
				$row2 = mysql_fetch_array($result2);
				$sExpenditure = $row2['sExpenditure'];

				//Retrieve Total Monthly Profit or Loss
				$query3 = "SELECT SUM(Price - (T.Quantity * BuyingPrice)) AS sProfit
							FROM $table_name1 T, $table_name2 I
							WHERE T.itemID = I.itemID AND MONTH(DateTime) = '$row4[0]' AND YEAR(DateTime) = '$year'";
				$result3 = mysql_query($query3);
				$row3 = mysql_fetch_array($result3);
				$sProfit = $row3['sProfit'];
						
					echo "<td align='center' width='110px'>" . $row4['Mwezi'] . "</td>";
					echo "<td align='right' width='130px'>" . number_format($sAmount, 2, '.', ',') . "</td>";
						if($sProfit > 0)
							{
					echo "<td align='right' width='115px'>" . number_format($sProfit, 2, '.', ',') . "</td>";
							$tProfit = $tProfit + $sProfit;
							}
						else
							{
					echo "<td align='right' width='115px'> - </td>";			
							}
						if($sProfit < 0)
							{
					echo "<td align='right' width='115px'>" . number_format(-$sProfit, 2, '.', ',') . "</td>";
							$tLoss = $tLoss - $sProfit;
							}
						else
							{
					echo "<td align='right' width='115px'> - </td>";			
							}

					echo "<td align='center' width='110px'>" . $row4['Mwezi'] . "</td>";
					echo "<td align='right' width = '130px'>" . number_format($sExpenditure, 2, '.', ',') . "</td>";
	
		echo "</tr>";
				$tAmount = $tAmount + $sAmount;
				$tExpenditure = $tExpenditure + $sExpenditure;			
		
				}
		
		echo "<tr><td colspan='6'><hr /></td></tr>";
		echo "<tr><th>TOTAL</th><td align='right'>" . number_format($tAmount, 2, '.', ',') . "</td>
					<td align='right'>" . number_format($tProfit, 2, '.', ',') . "</td>";
		echo "<td align='right'>" . number_format($tLoss, 2, '.', ',') . "</td><th>TOTAL</th>
					<td align='right'>" . number_format($tExpenditure, 2, '.', ',') . "</td>";
		echo "</tr>";
		echo "<tr><td colspan='6'><hr /></td></tr>";
		echo "<tr><td colspan='6' align='center'>";
		echo "Profit Remain = Total Profit - Total Loss - Total Expenditure <br />";
			$profit = $tProfit - $tLoss - $tExpenditure;
		echo "Which is = " . number_format($tProfit, 2, '.', ',') . " - " . number_format($tLoss, 2, '.', ',') . " - " .
		 number_format($tExpenditure, 2, '.', ',') . "<br />";
		echo " = " . number_format($profit, 2, '.', ',');
		echo "</td></tr>";
			if($profit > 0)
				{
		echo "<tr><td colspan='6' align='center'>The Business run Annual Transaction under the Profit of <u>" . number_format($profit, 2, '.', ',') . "</u></tr>";
				}
			else
				{
		echo "<tr><th colspan='6' align='center'><b>The Business run Annual Transaction under the Loss of <u>" . number_format(-$profit, 2, '.', ',') . "</u></b></th></tr>";		
				}
	echo "</table>";
 	echo "</center>";
	}
// The End of Function Searched Annual Income and Expenditure, Profit and Loss Acount Report

//The end of functions definitions ///////////////////////////////////////////////////////////////////////////////

// Calling the Function
	echo $ID();
//The End of Codes ///////////////////////////////////////////////////////////////////////////////////////////////
mysql_close($con);

?>