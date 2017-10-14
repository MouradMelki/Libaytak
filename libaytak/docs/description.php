<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Libaytak</title>
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
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
					&nbsp;

					<!-- InstanceEndEditable -->
                    </table>
                </td>
      		</tr>
            
            <!-- content -->
      		<tr style="background-color:rgba(0,0,0,0.1);">
        		<td height="100%"><!-- InstanceBeginEditable name="content" -->
									<?php 
						if(isset($_GET["id"])){
							$id = $_GET["id"];
							$description = "
									SELECT h.id_type,h.id_user,h.NbrOfPers,h.RentBuy,h.description,h.NbrOfRooms,h.NbrOfToilets,h.NbrOfBeds,
										h.NbrOfBathrooms,h.surface,h.price,ht.habType,lh.id_locCity,lh.coorX,lh.coorY,lc.city,u.username,u.email,u.phone
										FROM habitat h 
										INNER JOIN habitattypes ht on h.id_type = ht.id 
										INNER JOIN lochabitat lh on h.id = lh.id_habitat 
										INNER JOIN users u on h.id_user = u.id 
										INNER JOIN loccity lc on lh.id_locCity = lc.id WHERE h.id = $id";
							$execDes = $mysqli->query($description) or die("Error");
							$Des = $execDes->fetch_array();
							
							$pictures = "SELECT * FROM habitatpics WHERE id_habitat = $id";
					?>
					
					<table width="100%" border="0">
						<tr>
							<td>
						<?php
							$execPics = $mysqli->query($pictures) or die("Error");
							$imagesTotal = $execPics->num_rows;// SET TOTAL IMAGES IN GALLERY
						?>
						
						<div class="galleryContainer">
							<div class="galleryThumbnailsContainer">
								<div class="galleryThumbnails">
									<?php
										$execPics = $mysqli->query($pictures) or die("Error");
										$t = $execPics->num_rows + 1;
										for($i = 1; $i < $t; $i++){
											$Pics = $execPics->fetch_array();
											echo '<a href="javascript: changeimage(' . $i . ')" class="thumbnailsimage' . $i . '"><img src="'.$Pics['directoryPIC'].'" width="auto" height="100" alt="" /></a>';
										}
									?>
								</div>
							</div>

							<div class="galleryPreviewContainer">
								<div class="galleryPreviewImage">
									<?php
										$execPics = $mysqli->query($pictures) or die("Error");
										$j = $execPics->num_rows + 1;
										for($x = 1; $x < $j; $x++){
													$Pics = $execPics->fetch_array();
													echo '<img class="previewImage' . $x . '" src="'.$Pics['directoryPIC'].'" width="100%" height="auto" alt="" />';
										}
									?>
								</div>

								<div class="galleryPreviewArrows">
									<a href="#" class="previousSlideArrow">&lt;</a>
									<a href="#" class="nextSlideArrow">&gt;</a>
								</div>
							</div>

							<div class="galleryNavigationBullets">
								<?php
									$execPics = $mysqli->query($pictures) or die("Error");
									$b = $execPics->num_rows + 1;;
									for($i = 1; $i < $j; $i++){
										echo '<a href="javascript: changeimage(' . $i . ')" class="galleryBullet' . $i . '"><span>Bullet</span></a> ';
									}
								?>
							</div>
						</div>
<script type="text/javascript">
// init variables
var imagesTotal = <?php echo $imagesTotal; ?>;
var currentImage = 1;
var thumbsTotalWidth = 0;

$('a.galleryBullet' + currentImage).addClass("active");
$('a.thumbnailsimage' + currentImage).addClass("active");


// SET WIDTH for THUMBNAILS CONTAINER
$(window).load(function() {
	$('.galleryThumbnails a img').each(function() {
		thumbsTotalWidth += $(this).width() + 10 + 8;
	});
	$('.galleryThumbnails').width(thumbsTotalWidth);
});


// PREVIOUS ARROW CODE
$('a.previousSlideArrow').click(function() {
	$('img.previewImage' + currentImage).hide();
	$('a.galleryBullet' + currentImage).removeClass("active");
	$('a.thumbnailsimage' + currentImage).removeClass("active");

	currentImage--;

	if (currentImage == 0) {
		currentImage = imagesTotal;
	}

	$('a.galleryBullet' + currentImage).addClass("active");
	$('a.thumbnailsimage' + currentImage).addClass("active");
	$('img.previewImage' + currentImage).show();

	return false;
});
// ===================


// NEXT ARROW CODE
$('a.nextSlideArrow').click(function() {
	$('img.previewImage' + currentImage).hide();
	$('a.galleryBullet' + currentImage).removeClass("active");
	$('a.thumbnailsimage' + currentImage).removeClass("active");

	currentImage++;

	if (currentImage == imagesTotal + 1) {
		currentImage = 1;
	}

	$('a.galleryBullet' + currentImage).addClass("active");
	$('a.thumbnailsimage' + currentImage).addClass("active");
	$('img.previewImage' + currentImage).show();

	return false;
});
// ===================

// BULLETS CODE
function changeimage(imageNumber) {
	$('img.previewImage' + currentImage).hide();
	currentImage = imageNumber;
	$('img.previewImage' + imageNumber).show();
	$('.galleryNavigationBullets a').removeClass("active");
	$('.galleryThumbnails a').removeClass("active");
	$('a.galleryBullet' + imageNumber).addClass("active");
	$('a.thumbnailsimage' + currentImage).addClass("active");
}
// ===================

// AUTOMATIC CHANGE SLIDES
function autoChangeSlides() {
	$('img.previewImage' + currentImage).hide();
	$('a.galleryBullet' + currentImage).removeClass("active");
	$('a.thumbnailsimage' + currentImage).removeClass("active");

	currentImage++;

	if (currentImage == imagesTotal + 1) {
		currentImage = 1;
	}

	$('a.galleryBullet' + currentImage).addClass("active");
	$('a.thumbnailsimage' + currentImage).addClass("active");
	$('img.previewImage' + currentImage).show();
}

//var slideTimer = setInterval(function() {autoChangeSlides(); }, 7000);
</script>
					
							</td>
						</tr>
                        <tr>
                        	<td>
                        <table width="100%" border="0"  class="tabledescstyle">
						<tr >
							<td>
                            	
					<?php
							if($Des['RentBuy'] == 1)
								echo "Buy<br>";
							else
								echo "Rent<br>";
					?>
										Type : <?= $Des['habType']?><br>
										Location : <?= $Des['city']?>
								</td>
								</tr>
						
                        		<tr><!-- Nbrs -->
								<td>
								<table width="100%" border="0">
									<tr>
										<td>Number Of People : <?= $Des['NbrOfPers']?></td>
										<td>Number Of Rooms : <?= $Des['NbrOfRooms']?></td>
									</tr>
									<tr>
										<td>Number Of Toilets : <?= $Des['NbrOfToilets']?></td>
										<td>Number Of Beds : <?= $Des['NbrOfBeds']?></td>
									</tr>
									<tr>
										<td>Number Of Bathrooms : <?= $Des['NbrOfBathrooms']?></td>
										<td></td>
									</tr>
								</table>
								</td>
								</tr>
                                
								<tr><!-- price descrip -->
                                <td>
                                Surface : <?= $Des['surface']?> sqm<br>
                                Price : <?= $Des['price']?> $<br>
                                Description : <?= $Des['description']?><br>
                                Owner : <?= $Des['username']?><br>
                                Phone : <?= $Des['phone']?><br>
                                Email : <?= $Des['email']?><br>
                                </td>
                            	</tr>
                                
                       
							</table>
                            </td>
                       	</tr>
                    </table>
                            
        		
					<?php
						}else{
					
							echo "<h1>No Results Found</h1>";
					
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
