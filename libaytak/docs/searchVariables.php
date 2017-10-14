<?php	
if(isset($_GET["BuyRent"]) != null)
	$BuyRentG=$_GET["BuyRent"];
else
	$BuyRentG=null;

if(isset($_GET["location"]) != null)
	$locationG=$_GET["location"];
else
	$locationG=null;

if(isset($_GET["NbrOfPers"]) != null)
	$NbrOfPersG=$_GET["NbrOfPers"];
else
	$NbrOfPersG=null;

if(isset($_GET["habType"]) != null)
	$habTypeG=$_GET["habType"];
else
	$habTypeG=null;

if(isset($_GET["surf_min"]) != null)
	$surf_minG=$_GET["surf_min"];
else
	$surf_minG=null;

if(isset($_GET["surf_max"]) != null)
	$surf_maxG=$_GET["surf_max"];
else
	$surf_maxG=null;

if(isset($_GET["rooms"]) != null)
	$roomsG=$_GET["rooms"];
else
	$roomsG=null;

if(isset($_GET["price_min"]) != null)
	$price_minG=$_GET["price_min"];
else
	$price_minG=null;

if(isset($_GET["price_max"]) != null)
	$price_maxG=$_GET["price_max"];
else
	$price_maxG=null;
	

$exec = searchQuery($locationG,$BuyRentG,$NbrOfPersG,$habTypeG,$surf_minG,$surf_maxG,$roomsG,$price_minG,$price_maxG); 
?>