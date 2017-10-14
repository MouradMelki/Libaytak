<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Libaytak</title>
<?php
session_start();
ob_start();
if(!$_SESSION["Login"])
	header("Location: Home.php");
if($_SESSION["Username"] != $_GET["user"])
	header("Location: Home.php");
?>
<!-- InstanceEndEditable -->
<link href="../css/webpage.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" type="image/ico" href="../images/logo.png"/>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body>

<table width="760" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    	<table width="100%" cellspacing="0" cellpadding="0">
            <tr id="header">
            <script src="../js/background.js"></script>
        		<td height="60" >
                	<table width="100%" cellpadding="0" cellspacing="0" >
            			<tr style="background-color:rgba(255,255,255,0.6);">
            				<td width="40%">
            				<a href="Home.php"><img src="../images/logo.png" id="logo_image" alt="no image"></a></td>
            				<td width="60%"><!-- InstanceBeginEditable name="headerlinks" -->
                            <?php
                            include "connect.php";
                            include "loggedin.php";
							                                    							
                            ?>
							<!-- InstanceEndEditable --></td>
           			 	</tr>
            			<tr>
            				<td height="170" colspan="2">
                            	<p id="slogan">Find your Home</p>
                            </td>
            			</tr>
         			</table></td>
      		</tr>
      		<!-- seach bar -->
      		<tr style="background-color:#AA3311;">
        		<td>
                	<table width="100%" cellspacing="0" cellpadding="0">
					<!-- InstanceBeginEditable name="searchbar" -->&nbsp;<!-- InstanceEndEditable -->
                    </table>
                </td>
      		</tr>
            
            <!-- content -->
      		<tr style="background-color:rgba(0,0,0,0.1);">
        		<td height="100%"><!-- InstanceBeginEditable name="content" -->
                <?php
				$user = $_GET['user'];
				?>
                <div style="margin:10px; padding:10px; background-image:url(../images/letters-background.png)">
                
                <form action="editprofile.php?user=<?=$user?>" method="post">
				<table style="margin:0 auto;" width="450" height="50">
						<p style="text-align:center; font-weight:bold; margin-bottom:10px;">Change Phone Number:</p>
					<tr class="editprofile-block">
						<td width="35%">Phone number : </td>
						<td width="65%"><input type="text" required="" name="phone" /></td>
					</tr>
				</table>
				<input type="submit" value="Change" class="searchbutton" name="change number" style="margin-left:72%;">
				<input type="hidden" name="page1" value="1">

				</form>
                
                <?php 
				if(!empty($_POST["page1"])) {
					
	
					$phone = $_POST["phone"];
	
					$sql = "select * from users where username = '$user'";
					$exec = $mysqli->query($sql) or die("erroroo");
					if($exec->num_rows == 1)
					{	
						$query = "update users set phone = '$phone' where username = '$user'";
						$exec = $mysqli->query($query) or die("Error");
	
						echo "<h2 align=center>Phone Number Modified !</h2>";
					}
		
				}?>
                
                <form action="editprofile.php?user=<?=$user?>" method="post">
				<table style="margin:0 auto; margin-top:20px;" width="450" height="50">
                		<p style="text-align:center; font-weight:bold; margin-bottom:10px;">Change E-mail Address:</p>
					<tr class="editprofile-block">
						<td width="35%">E-mail : </td>
						<td width="65%"><input type="email" required="" name="e-mail" /></td>
					</tr>
				</table>
				<input type="submit" value="Change" class="searchbutton" name="change-email" style="margin-left:72%;">
				<input type="hidden" name="page2" value="2">

				</form>
                
                <?php
				if(!empty($_POST["page2"])) {
					
	
					$email = $_POST["e-mail"];

					$sql = "select * from users where username = '$user'";
					$exec = $mysqli->query($sql) or die("error");
					if($exec->num_rows == 1)
					{	
						$query = "update users set email = '$email' where username = '$user'";
						$exec = $mysqli->query($query) or die("Error");
	
						echo "<h2 align=center>Email Modified !</h2>";
					}
		
				}?>  
                
				<form action="editprofile.php?user=<?=$user?>" method="post">
				<table style="margin:0 auto; margin-top:20px;" width="450" height="150">
                		<p style="text-align:center; font-weight:bold; margin-bottom:10px;">Change Password:</p>
					<tr class="editprofile-block">
						<td width="35%">Old password : </td>
						<td width="65%"><input type="password" required="" name="oldpass" /></td>
					</tr>
					<tr class="editprofile-block">
						<td>New Password : </td>
						<td><input type="password" required="" name="newpass" /></td>
					</tr>
   		     		<tr class="editprofile-block">
						<td>Confirm Password : </td>
					<td><input type="password" required="" name="confpass" /></td>
					</tr>
				</table>
				<input type="submit" value="Change" class="searchbutton" name="change-password" style="margin-left:72%;">
				<input type="hidden" name="page3" value="3">

				</form>
                
                <?php
				if(!empty($_POST["page3"])) {
					
	
					$oldpass = hash('sha256',$_POST["oldpass"]);
					$newpass = hash('sha256',$_POST["newpass"]);
					$confpass = hash('sha256',$_POST["confpass"]);
	
					$sql = "select * from users where username = '$user' and passwd = '$oldpass'";
					$exec = $mysqli->query($sql) or die("erroroo");
					if($exec->num_rows == 1 && $newpass==$confpass)
					{	
						$query = "update users set passwd = '$newpass' where username = '$user'";
						$exec = $mysqli->query($query) or die("Error");
	
						echo "<h2 align=center>Password Modified !</h2>";
					}else{
						echo "<h2 align=center>Error in password</h2>";
					}
		
				} 

				include "disconnect.php";
				?>
                
                </div>
                
				
				<!-- InstanceEndEditable --></td>
      		</tr>
            
            <!-- footer -->
			<tr height="100" style="background-color:#aa3311">
       		  	<td>
              	<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td>
                        	<div class="footer_heading"> 
                            	<p>Libaytak Information:</p>
                            </div>
                        	<div class="link_div">
                            	<a href="aboutus.php" class="footer_links">About Us&nbsp;</a>
            					<a href="contactus.php" class="footer_links">Contact Us</a>
                            </div>
                        </td>
                    	<td>
                        	<div class="footer_heading"> 
                        		<p>Follow Us On:</p>
                            </div>
                            <div class="link_div">
          <a href="https://www.facebook.com/emile.hoyek" target="_blank"><img src="../images/fblogo.png" class="link_logo" alt="no image" style="margin-left:25px;"/></a> 
          <a href="https://www.instagram.com/emilehoyek5/" target="_blank"><img src="../images/instalogo.png" class="link_logo" alt="no image" /></a>
          <a href="https://twitter.com/emilehoyek5" target="_blank"><img src="../images/twitterlogo.png" class="link_logo" alt="no image" /></a>
                            </div>
                        
                        </td>
                    </tr>
                </table>
      			</td>
      		</tr> 
    </table>
    </td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
