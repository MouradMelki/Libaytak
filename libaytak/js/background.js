// JavaScript Document
var imageArray = new Array();

var switchMilliseconds = 5000;
var trID = 'header';

// To add more images, continue the pattern below.

imageArray[0] = '../images/1.jpg';
imageArray[1] = '../images/2.JPG';
imageArray[2] = '../images/3.jpg';

 // No further customization needed in this JavaScript

function publishPicture(i) {
	
	document.getElementById(trID).style.background = 'url("' + imageArray[i] + '")';
	document.getElementById(trID).style.height = "100%";
	document.getElementById(trID).style.weight = "100%";
	document.getElementById(trID).style.backgroundSize = "100% 100%";
	document.getElementById(trID).style.backgroundRepeat = "no repeat";
	
    i++;
    if (i > (imageArray.length - 1)) 
	{
    	i = 0;
    }
    setTimeout('publishPicture(' + i + ')', switchMilliseconds);
 }

publishPicture(0);


