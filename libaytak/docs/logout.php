<?php
include "checkLogin.php";

session_destroy();
header("Location: Home.php");
?>