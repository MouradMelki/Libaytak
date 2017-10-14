// JavaScript Document
var modal = document.getElementById('myModal1');
var btn = document.getElementById("myBtnLogin");
var span = document.getElementById("closeLog");

btn.onclick = function() {
	modal.style.display = "block";
}

span.onclick = function() {
	modal.style.display = "none";
}
var modal1 = document.getElementById('myModal2');
var btn1 = document.getElementById("myBtnRegister");
var span1 = document.getElementById("closeReg");

btn1.onclick = function() {
	modal1.style.display = "block";
}

span1.onclick = function() {
	modal1.style.display = "none";
}
window.onclick = function(event) {
	if (event.target == modal1) {
		modal1.style.display = "none";
	}
	if (event.target == modal) {
		modal.style.display = "none";
	}
}