<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Msisira Business Managing System</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<SCRIPT type="text/javascript">
    window.history.forward();
    function noBack() { window.history.forward(); }
</SCRIPT>
</head>

<body class="outer" onLoad="noBack();"
    onpageshow="if (event.persisted) noBack();" onUnload="">

<table id="main" border = "0" align="center" cellspacing="0" cellpadding="0">
<tr height="100px" valign="middle"><td>
	<table id="top" border = "0" align="center" cellspacing="0" cellpadding="0">
    	<tr><td>
        <?php include('Includes/head.php'); ?>
        </td></tr>
	</table>
</td></tr>
<tr height="20"><td class="top" align="right">
	<font color="#B0D8FF">Designed by JAHZERAH JOSIAH MWALUKASA</font>&nbsp;&nbsp;	
</td></tr>
<tr height="20"><td align="center">&nbsp;
		
</td></tr>
<tr><td align="center" valign="middle">

	<h1>Enter Username and Password to Login</h1>  
     <form method="post" action="login.php" >
    	<p style="font-size:26px;">Username&nbsp;<input style="font-size:18px;" type="text" name="user" size="25" required="required" /></p>
        <p style="font-size:26px;">Password&nbsp;&nbsp;<input style="font-size:18px;" type="password" name="pass" size="25" required="required" /></p>
        <p style="font-size:26px;"><input style="font-size:24px; font-weight:600; box-shadow:0px 0px 2px 1px #000000;" type="submit" value="Login" /></p>
        
     </form>
	
</td></tr>
<tr height="8px"><td>
	<table id="bottom" border = "0" align="center" cellspacing="0" cellpadding="0">
    	<tr><td align="center">
        <?php include('Includes/footer.php'); ?>
        </td></tr>
	</table>
</td></tr>
</table>

</body>
</html>
