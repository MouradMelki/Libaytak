<a href="logout.php" class="link">Log Out</a>
<?php
if(isset($_SESSION['Username']))
{
$username = $_SESSION['Username'];
echo "
	<div class=dropdown>
		<button class=dropbtn>Welcome $username &nbsp;<div class=arrow-down></div></button>
		<div class=dropdown-content>
			<a href='addhouse.php?user=$username'>Add House</a>
			<a href='listhouses.php?user=$username'>List Houses</a>
			<a href='editprofile.php?user=$username'>Edit Profile</a>
		</div>
	</div>";
}
?>
<a href="Help.php" class="link">Help</a>