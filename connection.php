<?php
/*
$servername = "localhost";
$username = "root";
$password = "";

//echo "Connected successfully";
$kill=mysql_connect($servername, $username,$password) or die(mysql_error()); //Connect to server
mysql_select_db("expense_manager",$kill) or die("Cannot connect to database"); //Connect to database
*/
define("HOST","localhost");
define("USER","root");
define("PASSWORD","");
define("DATABASE","expense_manager");
$con=mysqli_connect(HOST,USER,PASSWORD);
mysqli_select_db($con,DATABASE);
?>