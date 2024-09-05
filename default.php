<?php session_start(); ?>
<?php
if($_SESSION['user']=="")
	{
	header("Location: out.php");
	}
	?>
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
<tr height="100px" valign="middle"><td colspan="2">
	<table id="top" border = "0" align="center" cellspacing="0" cellpadding="0">
    	<tr><td>
        <?php include('Includes/head.php'); ?>
        </td></tr>
	</table>
</td></tr>
<tr height="20"><td colspan="2" class="top" align="right">
	<font color="#B0D8FF">Designed by JAHZERAH JOSIAH MWALUKASA</font>&nbsp;&nbsp;	
</td></tr>
<tr height="20"><td colspan="2" align="left">
	<table border = "0" align="center" cellspacing="0" cellpadding="0" width="100%" height="100%">
    	<tr>
        <td>&nbsp;<?php /* Receive id */ $ID = $_GET['id']; echo $_SESSION['position'] . ": " . $_SESSION['name'] ?></td>
        <td>&nbsp;</td>
        </tr>
    </table>		
</td></tr>
<tr><td align="center" valign="top" width="20%">
	<?php include('Includes/menu.php'); ?>
    <hr />
</td><td align="center" valign="top" width="80%">
	<div class="right-div">
    	<?php include('Includes/defa.php'); ?>
    </div>
</td></tr>
<tr height="8px"><td colspan="2">
	<table id="bottom" border = "0" align="center" cellspacing="0" cellpadding="0">
    	<tr><td align="center">
        <?php include('Includes/footer.php'); ?>
        </td></tr>
	</table>
</td></tr>
</table>

</body>
</html>
