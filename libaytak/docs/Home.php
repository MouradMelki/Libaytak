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
              						<option value="1" >Buy</option>
              						<option value="0" >Rent</option>
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
                    
               					<input type="text" id="location_text" name="location" autocomplete="off" list="cityname" placeholder="Location" />
                    
                    			<select class="select" name="NbrOfPers">
                                <option value="" disabled selected>Persons</option>
                                    <option value="1">1 Person</option>
                                    <option value="2">2 Persons</option>
                                    <option value="3">3 Persons</option>
                                    <option value="4">4 Persons</option>
                                    <option value="5">5 Persons</option>
                                    <option value="6">6 Persons</option>
                                    <option value="7">7 Persons</option>
                                    <option value="8">8+ Persons</option>
                    			</select>
                    
								<?php 
                                $insert = "SELECT * FROM habitattypes order by habType";
                                $result = $mysqli->query($insert);
                                echo '<select class="select" name="habType">
								<option value="" disabled selected>Type</option>';
                                while ($row = $result->fetch_array()) 
                                {
                                    echo "<option value='" . $row['id'] . "'>" . $row['habType'] . "</option>";
                                }
                                echo "</select>";
                                
                                ?>
                    
                                <input type="submit" class="searchbutton" name="search" value="Search">
                            
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
				
					$insert = "SELECT * FROM loccity WHERE imagepath IS NOT NULL order by city";
					$result = $mysqli->query($insert);
					$n = $result->num_rows;
					if(!$result)
						die("Error");
					
					$i=0;
					while($i<$n)
					{
						$row = $result->fetch_array();
						echo "
						<div class=container_div style='margin-top:8px;'>
        					<div class=left_div style='background-image: url($row[imagepath]);'>
            					<a href=search.php?location=$row[city] class=three_thumnail_text>$row[city]</a>
        					</div>";
						$i++;
						$row = $result ->fetch_array();
							echo "
        					<div class=middle_div style='background-image: url($row[imagepath]);'>
            					<a href=search.php?location=$row[city] class=three_thumnail_text>$row[city]</a>
        					</div>
							";
						$i++;
						$row = $result ->fetch_array();
						
							echo "
        					<div class=right_div style='background-image: url($row[imagepath]);'>
            					<a href=search.php?location=$row[city] class=three_thumnail_text>$row[city]</a>
        					</div>
    					</div>
						 ";
						 $i++;
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
