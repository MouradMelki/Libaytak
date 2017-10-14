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
				<table border="0" cellpadding="6" cellspacing="1" width="100%">
                <?php
					$username = $_GET["user"];
					if(isset($_POST["page"]))
						$page = $_POST["page"];								
								
					else {
					$sql="SELECT h.* FROM habitat h INNER JOIN users u on h.id_user =u.id WHERE u.username = '$username'";
					$exec = $mysqli->query($sql) or die("Error");
					
					if($exec->num_rows == 0)
					{
						echo "<h2 align=center>No Houses found!</h2>
						<h2 align=center>Please add some first</h2>";
					}
					else{
					while($row= $exec->fetch_array())
					{
					?>
						<tr>
                        	<?php
							
							$sql = "SELECT hp.directoryPIC FROM habitatpics hp INNER JOIN habitat h on $row[id] = hp.id_habitat LIMIT 1";
                            $result = $mysqli->query($sql) or die('error pics');;
							while ($pic = $result->fetch_array())
							{
							?>
        					<td width=40%><img src=<?=$pic['directoryPIC']?> width=291 height=219 alt=N/A></td>
                            <?php
							}
							?>
                    		<td width=60%>
                        	<table width="442" height="219" style="background-image:url(../images/letters-background.png); background-repeat:no-repeat;">
                            	<tr height="12.5%">
									<td width="30%" style="padding-left:30px;"><p>Type</p></td>
									<td class="descriptionstyle">
					<?php
							if($row['RentBuy'] == 1)
								echo "Buy<br>";
							else
								echo "Rent<br>";
					?>
                    </td>
								</tr>
                                <tr height="12.5%">
                                <?php
								$sql = "SELECT habType FROM habitattypes where id = $row[id_type]";
								$result = $mysqli->query($sql);
								while ($row1 = $result->fetch_array())
								{
									echo "<td width=40%></td>
									<td class=descriptionstyle>$row1[habType]</td>";
								}
                                $insert = "SELECT city FROM loccity l INNER JOIN lochabitat lh on l.id = lh.id_locCity where lh.id_habitat = $row[id]";
                                $result = $mysqli->query($insert) or die();;
								echo "<tr>";
								while ($row2 = $result->fetch_array())
								{
										echo "
										<td style=padding-left:30px;><p>Location</p></td>
										<td class=descriptionstyle>$row2[city]</td>
									</tr>";
								}
								?>
                            	<tr height="12.5%">
									<td style="padding-left:30px;"><p>Price</p></td>
									<td class="descriptionstyle"><?=$row['price']?></td>
								</tr>
                            
                            	<tr height="12.5%">
									<td style="padding-left:30px;"><p>Area</p></td>
									<td class="descriptionstyle"><?=$row['surface']?></td>
								</tr>
                            
                            	<tr height="12.5%">
									<td style="padding-left:30px;"><p>Rooms</p></td>
									<td class="descriptionstyle"><?=$row['NbrOfRooms']?></td>
								</tr>
                            
                            	<tr height="25%">
                                	<td></td>
                                    <td>

                                    <form action="listhouses.php?user=<?=$username?>" method="post">
                                    <input type="submit" class="searchbutton"  onclick="return confirm('Are you sure?')" style="float:right;" value="Delete">
                                    <input type="hidden" name="page" value=<?=$row['id']?>>
                                   	</form>
                                	<a href='addhouse.php?id=<?=$row['id']?>'><input type="button" class="searchbutton" value="Edit" style="float:right;margin-right: 20px;"></a>

                                    </td>
                                </tr>				
                        	</table>


                     		</td>
   				 		</tr>
						
					<?php
                    }
					}
					?>

				</table>
                <?php
							}
							if(isset($page))
							{
								$id = $_POST["page"];
								$query = "DELETE FROM `habitat` where `habitat`.`id` = '$id'";
								$exec = $mysqli->query($query) or die("Error");
								header("Location: listhouses.php?user=$username");
							}
                	include "disconnect.php"
				?> 
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
