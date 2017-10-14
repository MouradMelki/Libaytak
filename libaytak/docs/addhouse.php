<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Libaytak</title>
<?php
include "connect.php";
session_start();
ob_start();
if(!$_SESSION["Login"])
	header("Location: Home.php");
if(isset($_GET['id']))
{
	$query= "SELECT * from habitat where id = $_GET[id]";
	$execute = $mysqli->query($query) or die("Error");
	$row = $execute->fetch_array();
	$query2= "SELECT * from users where id = $row[id_user]";
	$executor = $mysqli->query($query2);
	if(!$executor)
	{
		header("Location: Home.php");
	}
	
}
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
				$id 			= null;
				$BR 			= null;
				$location 		= null;
				$type 			= null;
				$NbrOfPers 		= null;
				$NbrOfToilets 	= null;
				$NbrOfBeds 		= null;
				$NbrOfBathrooms = null;
				$NbrOfRooms 	= null;
				$surface 		= null;
				$price			= null;
				$description	= null;
				$action			= "Add";
				
				if(isset($_GET["id"])){
					$id = $_GET["id"];
					$action = "Update";
				}
				
				if($id != null){
					$habitat = "SELECT h.*,lc.city,ht.habType,ht.id as habId FROM habitat h
						INNER JOIN lochabitat lh on h.id = lh.id_habitat
						INNER JOIN habitattypes ht on h.id_type = ht.id 
						INNER JOIN loccity lc on lc.id = lh.id_locCity WHERE h.id = $id";
					$exech = $mysqli->query($habitat) or die("Error");
					$rowh = $exech->fetch_array();
					
					$BR 			= $rowh["RentBuy"];
					$location 		= $rowh["city"];
					$type 			= $rowh["habType"];
					$NbrOfPers 		= $rowh["NbrOfPers"];
					$NbrOfToilets 	= $rowh["NbrOfToilets"];
					$NbrOfBeds 		= $rowh["NbrOfBeds"];
					$NbrOfBathrooms = $rowh["NbrOfBathrooms"];
					$NbrOfRooms 	= $rowh["NbrOfRooms"];
					$surface 		= $rowh["surface"];
					$price			= $rowh["price"];
					$description	= $rowh["description"];
				}
				?>
                	<div style="margin:10px; padding:10px; background-image:url(../images/letters-background.png)">
					<form action="addhouse.php?user=<?=$username?>" method="post" enctype="multipart/form-data">
						<table width="100%" height="100%" style="padding:10px;">
                        <h2 style="text-align:center; font-weight:bold; margin-bottom:10px;">Add House Information:</h2>
							<tr class="addhouse-block">
                            	<td width="30%">Buy/Rent:</td>
								<td width="70%">
                                <select class="select" name ="BuyRent" placeholder="Buy/Rent" >
									<option value="1" <?php
														if($BR == 1)
															echo "selected";
													  ?>>Buy</option>
									<option value="0" <?php
														if($BR == 0)
															echo "selected";
													  ?>>Rent</option>
								</select>
								</td>
                            </tr>
							
                            <tr class="addhouse-block">
                            	<td>Location:</td>
                                <td>
								<?php
								$sql= "SELECT city FROM loccity order by city";
								$result = $mysqli->query($sql);
								echo '<datalist id="cityname">';
								while ($row = $result->fetch_array())
								{
									echo "<option value='" . $row['city'] . "'>" . $row['city'] . "</option>";
								}
								echo "</datalist>";
								
								if($location != null)
									echo '<input type="text" value="'.$location.'" id="location_text" required="" name="location" autocomplete="off" list="cityname" placeholder="Location" style="width: 220px;"/>';
								else
									echo '<input type="text" id="location_text" required="" name="location" autocomplete="off" list="cityname" placeholder="Location" style="width: 220px;"/>';
								?>
								
							</td></tr>
							
                            <tr class="addhouse-block">
                            	<td>Number Of Persons:</td>
                                <td>
								<select class="select" name="NbrOfPers">
                                    <?php 
									if(isset($_GET["NbrOfPers"]) && $_GET["NbrOfPers"] == 1)
                                    	echo "<option value=1 selected>1 Person</option>";
									else
										echo "<option value=1>1 Person</option>";;
									for($i=2;$i<8;$i++)
									{
										if(isset($_GET["NbrOfPers"]) && $_GET["NbrOfPers"]== $i)
											echo "<option value=$i selected>$i Persons</option>";
										else
											echo "<option value=$i>$i Persons</option>";
									}
									if(isset($_GET["NbrOfPers"]) && $_GET["NbrOfPers"] == 8)
                                    	echo "<option value=8 selected>8+ Persons</option>";
									else
										echo "<option value=8>8+ Persons</option>";;
									?>
								</select>
							</td></tr>
							<tr class="addhouse-block">
                            	<td>Type Of Habitat:</td>
                                <td>
								<?php 
									$insert = "SELECT * FROM habitattypes order by habType";
									$result = $mysqli->query($insert);
									echo '<select class="select" name="habType">';
									while ($row = $result->fetch_array()) 
									{
										$selected = null;
										if($type != null && $type == $row['habType'])
											$selected = "selected";
										echo "<option value='" . $row['id'] . "' $selected>" . $row['habType'] . "</option>";
									}
									echo "</select>";
								?>
							</td></tr>
							<tr class="addhouse-block">
                            	<td>
								<span class="textf">Area (sqm) :</span>
                                </td>
                                <td>
								<input type="number" class="textfield" required="" name="surf" min="0" <?php
																						if($surface != null)
																							echo "value='$surface'";
																					?>>
							</td></tr>
							<tr class="addhouse-block">
                            	<td>
								<span class="textf">Rooms:</span>
                                </td>
                                <td>
								<select class="filter" name="rooms">
                    				<?php
									if($NbrOfRooms == 0)
                                    	echo "<option value=0 selected></option>";
									else
										echo "<option value=0></option>";
									for($i=1;$i<5;$i++)
									{
										if($NbrOfRooms== $i)
											echo "<option value=$i selected>$i</option>";
										else
											echo "<option value=$i>$i</option>";
									}
                                    
                  					if($NbrOfRooms == 5)
                                    	echo "<option value=5 selected>5+</option>";
									else
										echo "<option value=5>5+</option>";
									?>
								</select>
							</td></tr>
							<tr class="addhouse-block">
                            	<td>
								<span class="textf">Price (USD) :</span>
								</td>
                                <td>
                                <input type="number" class="textfield" required="" name="price" min="0" <?php
																						if($price != null)
																							echo "value='$price'";
																					 ?>>
							</td></tr>
							<tr class="addhouse-block"><td>
								<span class="textf">Bathrooms :</span>
                                </td>
                                <td>
								<input type="number" class="textfield" required="" name="bathrooms" min="0" style="width: 100px;" <?php
																							if($NbrOfBathrooms != null)
																								echo "value='$NbrOfBathrooms'";
																						 ?>>
							</td></tr>
							<tr class="addhouse-block">
                            	<td>
								<span class="textf">Beds :</span>
								</td>
                                <td>
                                <input type="number" class="textfield" required="" name="beds" min="0" style="width: 100px;" <?php
																						if($NbrOfBeds != null)
																							echo "value='$NbrOfBeds'";
																					?>>
							</td></tr>
							<tr class="addhouse-block">
                            	<td>
								<span class="textf">Toilets :</span>
								</td>
                                <td>
                                <input type="number" class="textfield" required="" name="toilets" min="0" style="width: 100px;" <?php
																							if($NbrOfToilets != null)
																								echo "value='$NbrOfToilets'";
																					   ?>>
							</td></tr>
							<tr class="addhouse-block">
                            	<td>
								<span class="textf">Description :</span>
								</td>
                                <td>
                                <input type="text" class="textfield" name="description" maxlength="250" style="width:100%;"<?php
																											if($description != null)
																												echo "value='$description'";
																										?>>
							</td></tr>
                            
                             <?php
								if(isset($_GET['id']))
								{?>
							<tr class="descriptionstyle">
                            	<td>Delete old Images:</td>
                            </tr>
                            <tr>
                            	<td></td>
                            	<td>
							<?php
									$insert = "SELECT * FROM habitatpics WHERE id_habitat = $_GET[id]";
									$result = $mysqli->query($insert);
									$n = $result->num_rows;
									if(!$result)
										die("Error");
					
									$i=0;
									while($i<$n)
									{
										$row = $result->fetch_array();
										echo "
										<div class=container_div2 style='margin-top:8px;'>
        									<div class=left_div2 style='background-image: url($row[directoryPIC]);'>
											<input type=checkbox style='cursor:pointer;' name=$row[id] value =$row[id]>
        									</div>";
										$i++;
										if($i<$n)
										{
										$row = $result ->fetch_array();
										
										echo "
        									<div class=middle_div2 style='background-image: url($row[directoryPIC]);'>
											<input type=checkbox style='cursor:pointer;' name=$row[id] value=$row[id]>
        									</div>";
										}
										$i++;
										if($i<$n)
										{
										$row = $result ->fetch_array();
						
										echo "
        									<div class=right_div2 style='background-image: url($row[directoryPIC]);'>
											<input type=checkbox style='cursor:pointer;' name=$row[id] value=$row[id]>
        									</div>
    									</div>";
										}
						 				$i++;
									}
								?>
                            	</td>
                            </tr>
							<?php
								}
							?>
							<tr class="descriptionstyle">
                            	<td>Insert Image:</td>
                            	<td style="margin-top:8px;">
					            <input type="file" name="img[]" accept="image/*" multiple <?php 
								if(!isset($_GET['id']))
									echo 'required=""'
								?>>
							</td></tr>
                            <tr>
                            	<td></td>
                                <td>
                        
                        <input type="submit" class="searchbutton" style="float:right;" value="<?php echo $action; ?>" name="<?php echo $action; ?>">
						<input type="hidden" value="<?php echo $id; ?>" name="id">
                        		</td>
                        	</tr>
                        </table>
                        
                        
					</form>
                    </div>
                    
					<?php
						if(isset($_POST["Add"]) ){
							$user = "SELECT * FROM users WHERE username = '".$_SESSION['Username']."'";
							$resultU = $mysqli->query($user);
							$rowu = $resultU->fetch_array();
							
							$insert = "INSERT INTO `habitat` (`id`, `id_type`, `id_user`, `NbrOfPers`, `RentBuy`,
															  `description`, `NbrOfRooms`, `NbrOfToilets`, `NbrOfBeds`, `NbrOfBathrooms`, `surface`, `price`) 
									   VALUES (NULL, ".$_POST['habType'].", ".$rowu['id'].", '".$_POST['NbrOfPers']."', '".$_POST['BuyRent']."', 
															  '".$_POST['description']."', '".$_POST['rooms']."', '".$_POST['toilets']."', '".$_POST['beds']."', '".$_POST['bathrooms']."', '".$_POST['surf']."', '".$_POST['price']."')";
							$mysqli->query($insert) or die("Error");
							
							$allHab = "SELECT * FROM habitat";
							$resultAl = $mysqli->query($allHab) or die("Error");
							$n = $resultAl->num_rows;
							if($n > 0)
							{
								for($i=0;$i<$n;$i++)
								{
									$row = $resultAl->fetch_array();
									$id = $row[0];
									// to get the last house id which is the one you just added, for the pics directory
								}
							}
							
							$loc = "SELECT * FROM loccity WHERE city = '".$_POST['location']."'";
							$resultL = $mysqli->query($loc) or die("Error");
							$rowl = $resultL->fetch_array();
							$loch = "INSERT INTO `lochabitat` (`id`, `id_locCity`, `coorX`, `coorY`, `id_habitat`) VALUES (NULL, ".$rowl['id'].", NULL, NULL, $id)";
							$resultLh = $mysqli->query($loch) or die("Error");	
							
							$myFile = $_FILES['img'];
							$fileCount = count($myFile["name"]);
							for ($i = 0; $i < $fileCount; $i++) {
								if(is_uploaded_file($myFile["tmp_name"][$i])){
									move_uploaded_file($myFile["tmp_name"][$i],"../images/habitat/$id-$i-".$myFile["name"][$i]);
									$saveImg = "INSERT INTO `habitatpics` (`id`, `id_habitat`, `directoryPIC`) VALUES (NULL, '$id', '../images/habitat/$id-$i-".$myFile["name"][$i]."') ";
									$resultSi = $mysqli->query($saveImg) or die("Error");	
								}
							}
							header("Location: listhouses.php?user=$username");
							
						}
						if(isset($_POST["Update"])){
							$loc = "SELECT * FROM loccity WHERE city = '".$_POST['location']."'";
							$resultL = $mysqli->query($loc) or die("Error");
							$rowl = $resultL->fetch_array();
							// id of the house you want to update
							$id = $_POST['id'];
							
							$insertL = "UPDATE `lochabitat` SET `id_locCity` = '".$rowl['id']."' WHERE `id_habitat` = $id ";
							$mysqli->query($insertL) or die("Error");
							
							$insertH = "UPDATE `habitat` SET `id_type` = '".$_POST['habType']."', `NbrOfPers` = '".$_POST['NbrOfPers']."', `RentBuy` = '".$_POST['BuyRent']."', 
									`description` = '".$_POST['description']."', `NbrOfRooms` = '".$_POST['rooms']."', `NbrOfToilets` = '".$_POST['toilets']."', `NbrOfBeds` = '".$_POST['beds']."',
									`NbrOfBathrooms` = '".$_POST['bathrooms']."', `surface` = '".$_POST['surf']."', `price` = '".$_POST['price']."' WHERE `habitat`.`id` = $id";
							$mysqli->query($insertH) or die("Error");
							
							$myFile = $_FILES['img'];
							$fileCount = count($myFile["name"]);
							for ($i = 0; $i < $fileCount; $i++) {
								if(is_uploaded_file($myFile["tmp_name"][$i])){
									move_uploaded_file($myFile["tmp_name"][$i],"../images/habitat/$id-$i-".$myFile["name"][$i]);
									$saveImg = "INSERT INTO `habitatpics` (`id`, `id_habitat`, `directoryPIC`) VALUES (NULL, '$id', '../images/habitat/$id-$i-".$myFile["name"][$i]."') ";
									$resultSi = $mysqli->query($saveImg) or die("Error");	
								}
							}
							// deleting the pics checked
							$selectimg = "SELECT id FROM habitatpics where id_habitat = $id ";
							$executimg = $mysqli->query($selectimg) or die("Error");
							$n = $executimg->num_rows;
							for($i=0;$i<$n;$i++)
							{
								$rowimg = $executimg->fetch_array();
								if(isset($_POST["$rowimg[0]"]))
								{
									if(($i<$n-1) || (!isset($_FILES['img'])))
									{
										$imgid = $_POST["$rowimg[0]"];
										$delete = "DELETE FROM `habitatpics` WHERE `habitatpics`.`id` = $imgid";
										$executdel = $mysqli->query($delete) or die("Error");
									}else
									{
									echo "<script type='text/javascript'>alert('You cant remove all the pictures');
											window.location.href = 'addhouse.php?user=$username&id=$id';</script>";
									exit;
									}
								}
							}
							header("Location: listhouses.php?user=$username");
						}
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
