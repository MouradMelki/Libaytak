<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Libaytak</title>
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
								include "checkLogin.php";
								include "searchFunc.php";
								include "searchVariables.php";	
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
					<!-- InstanceBeginEditable name="searchbar" -->

                    <form action="search.php" method="get">
                    	<tr height="50px">
                        	<td class="searchbar">
                    			<select class="select" name ="BuyRent" placeholder="Buy/Rent" >
              						<option value="1" <?php if(isset($_GET["BuyRent"]) && $_GET["BuyRent"]==1)
															{echo "selected";}?>>Buy</option>
              						<option value="0" <?php if(isset($_GET["BuyRent"])&& $_GET["BuyRent"]==0)
															{echo "selected";}?>>Rent</option>
              					</select>
                    			<?php
								$sql= "SELECT city FROM loccity order by city";
								$result = $mysqli->query($sql);
								echo '<datalist id="cityname">';
								while ($row = $result->fetch_array())
								{
									echo "<option value='" . $row['city'] . "'>" . $row['city'] . "</option>";
								}
								echo "</datalist>";
								?>
                    
               					<input type="text" id="location_text" name="location" autocomplete="off" list="cityname" placeholder="Location" value="<?php
								if(isset($_GET["location"]))
								{
									echo $_GET["location"];
								}
								?>"/>
                    
                    			<select class="select" name="NbrOfPers">
                                	<option value="" disabled selected>Persons</option>
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
                    
								<?php 
                                $insert = "SELECT * FROM habitattypes order by habType";
                                $result = $mysqli->query($insert);
                                echo '<select class="select" name="habType">
								<option value="" disabled selected>Type</option>';
                                while ($row = $result->fetch_array()) 
                                {
									if(isset($_GET["habType"]) && $_GET["habType"] == $row['id'])
										echo "<option value='" . $row['id'] . "' selected>" . $row['habType'] . "</option>";
									else
										echo "<option value='" . $row['id'] . "'>" . $row['habType'] . "</option>";
                                }
                                echo "</select>";
                                
                                ?>
                    
                    			<input type="submit" class="searchbutton" name="search" value="Search">
                    		</td>
                    	</tr>
                        <tr height="50px">
        					<td class="searchbar">

    							<span class="textf">Area:</span>
       							<input type="number" class="textfield"  name="surf_min" id="filter-from-to"  placeholder="min"  min="0"
                                <?php
								if(isset($_GET["surf_min"]) != null)
									echo "value=$_GET[surf_min]";
								?>>
             
                                <span class="textf">-</span> 
	   							<input type="number" class="textfield"  name="surf_max" id="filter-from-to" placeholder="max"  min="0"
                                <?php
								if(isset($_GET["surf_max"]) != null)
									echo "value=$_GET[surf_max]";
								?>>
                    			<span class="textf" style="font-size:12px;">sqm</span>
                                <span class="textf">&nbsp </span>
                    
                    
                    			<span class="textf">Rooms:</span>
                    			<select class="filter" name="rooms">
                    				<?php
									if(isset($_GET["rooms"]) && $_GET["rooms"] == 0)
                                    	echo "<option value=0 selected></option>";
									else
										echo "<option value=0></option>";
									for($i=1;$i<5;$i++)
									{
										if(isset($_GET["rooms"]) && $_GET["rooms"]== $i)
											echo "<option value=$i selected>$i</option>";
										else
											echo "<option value=$i>$i</option>";
									}
                                    
                  					if(isset($_GET["rooms"]) && $_GET["rooms"] == 5)
                                    	echo "<option value=5 selected>5+</option>";
									else
										echo "<option value=5>5+</option>";
									?>
                    			</select>
                    
                    
    							<span class="textf">&nbsp Price:</span>
       							<input type="number" class="textfield"  name="price_min" id="filter-from-to" placeholder="min" min="0"
                                <?php
								if(isset($_GET["price_min"]) != null)
									echo "value=$_GET[price_min]";
								?>>
                                <span class="textf">-</span>
	   							<input type="number" class="textfield"  name="price_max" id="filter-from-to" placeholder="max" min="0"
                                <?php
								if(isset($_GET["price_max"]) != null)
									echo "value=$_GET[price_max]";
								?>>
                                <span class="textf" style="font-size:12px;">$</span>
                                
                    		</td>
      					</tr>
                    </form>
                    <!-- InstanceEndEditable -->
                    </table>
                </td>
      		</tr>
            
            <!-- content -->
      		<tr style="background-color:rgba(0,0,0,0.1);">
        		<td height="100%"><!-- InstanceBeginEditable name="content" -->
                <?php
				if ($exec){
					$n = $exec->num_rows;
				?>
                <table border="0" cellpadding="6" cellspacing="1" width="100%" <?php 
				if($n>3){echo 'id="scroll"';}?>>
                <?php

					if($n > 0){ 
					while($row= $exec->fetch_array())
					{
					?>
						<tr height="231">
                        	<?php
							$sql = "SELECT hp.directoryPIC FROM habitatpics hp INNER JOIN habitat h on $row[id] = hp.id_habitat LIMIT 1";
                            $result = $mysqli->query($sql) or die('error pics');;
							while ($pic = $result->fetch_array())
							{
							?>
        					<td width="40%"><img src=<?=$pic['directoryPIC']?> width=291 height=219 alt=N/A></td>
                            <?php
							}
							?>
                    		<td width="60%">
                        	<table width="442" height="219" style="background-image:url(../images/letters-background.png); background-repeat:no-repeat;">
                            	<tr  height="12.5%">
									<td width="30%" style="padding-left:30px;"><p>Type:</p></td>
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
									<td width="40%"></td>
									<td class="descriptionstyle"><?=$row['habType']?></td>
								</tr>
                            	<?php 
                                $insert = "SELECT city FROM loccity where id = $row[id_locCity]";
                                $result = $mysqli->query($insert);
								echo "<tr height=24>";
								while ($row1 = $result->fetch_array())
								{
										echo "
										<td style=padding-left:30px;><p>Location:</p></td>
										<td class=descriptionstyle>$row1[city]</td>
									</tr>";
								}
								?>
                            	<tr height="12.5%">
									<td style="padding-left:30px;"><p>Price:</p></td>
									<td class="descriptionstyle"><?=$row['price']?> $</td>
								</tr>
                            
                            	<tr height="12.5%">
									<td style="padding-left:30px;"><p>Area:</p></td>
									<td class="descriptionstyle"><?=$row['surface']?> sqm</td>
								</tr>
                            
                            	<tr height="12.5%">
									<td style="padding-left:30px;"><p>Rooms:</p></td>
									<td class="descriptionstyle"><?=$row['NbrOfRooms']?></td>
								</tr>
                            
                            	<tr height="25%">
                                <td></td>
                                	<td><a target="_blank" href='description.php?id=<?=$row['id']?>' class="searchbutton" style="float:right; margin-right:10px;">Description</a></td>
                                </tr>				
                        	</table> 
                     		</td>
   				 		</tr>
						
					<?php
                    }
				}else{
					echo "<h2 align=center>No Result Found!</h2>
					<img style='display: block;margin: 0 auto;' width=200px height=200px src=../images/10474930_1438181936449466_1492814196_n.jpg>";
				}
			}else{
				echo "<h2 align=center>Please insert the search parameters correctly!</h2>
						<img style='display: block;margin: 0 auto;' width=200px height=200px src=../images/9gags-challenge-accepted.jpg>";
			}
					
					?>

				</table>
                <?php
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
