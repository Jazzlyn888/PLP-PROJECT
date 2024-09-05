<?php 
// re-create session
session_start();




// reset session array
$_SESSION = array();

// destroy session
session_destroy();

require('index.php');

?>