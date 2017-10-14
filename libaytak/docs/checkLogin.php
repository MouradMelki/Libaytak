<?php
session_start();
ob_start();
if(isset($_SESSION["Login"]))
	include "loggedin.php";
else
	include "login.php";
?>