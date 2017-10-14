
<?php
	if(isset($_POST["page"]))
		$page = $_POST["page"];								
								
	else {
?>
<a id="myBtnLogin" class="link">Log In</a>
<a id="myBtnRegister" class="link">Sign Up</a>

<div id="myModal1" class="modal">
	<div class="modal-content">
		<span class="buttonlogin" id="closeLog">&nbsp;x&nbsp;</span>
        <form action="Home.php" method="post">
        <h1 class="h1block">Login</h1>
			<table  class="login-block">
				<tr>
					<td><input type="text" required="" name="username" placeholder="Username" id="username"/></td>
				</tr>
				<tr>
					<td><input type="password" required="" name="password" placeholder="Password" id="password" /></td>
				</tr>
			</table>

			<input type="submit" value="Login" name="login" class="buttonlogin">
			<input type="hidden" name="page" value="1">

		</form>
	</div>
</div>
<div id="myModal2" class="modal">
	<div class="modal-content">
		<span class="buttonlogin" id="closeReg">&nbsp;x&nbsp;</span>
        <form action="Home.php" method="post">
        	<h1 class="h1block">Register</h1>
			<table>
            <div class="login-block-reg">
            </div>
				<tr class="login-block-reg">
					<td>Username : </td>
					<td><input type="text" required="" name="username2" /></td>
				</tr>
				<tr class="login-block-reg">
					<td>Password : </td>
					<td><input type="password" required="" name="password2" /></td>
				</tr>
				<tr class="login-block-reg">
					<td>Email : </td>
					<td><input type="email" required="" name="email" /></td>
				</tr>
				<tr class="login-block-reg">
					<td>Phone number : </td>
					<td><input type="text" required="" name="phone" /></td>
				</tr>
				<tr class="login-block-reg">
					<td>Age : </td>
                    <td><input type="date" required="" name="age"/></td>
               </tr>
               <tr>
               		<td>Gender :</td>
               </tr>
               <tr>
               		<td dir="rtl"> : Male</td>
               		<td><input type="radio" required="" name="gender" value="1" style="margin:0;"></td>
               </tr>
               <tr>
               		<td dir="rtl"> : Female</td>
               		<td><input type="radio" required="" name="gender" value="0" style="margin:0;"></td>
               </tr>
 
			</table>
			<input type="submit" value="Register" name="register" class="buttonlogin" style="margin-top: 10px;">
			<input type="hidden" name="page" value="1">

		</form>
  	</div>
</div>
<?php 
}
	if(isset($page) ==1) {
		if(isset($_POST['login'])){
			$username = $_POST["username"];
			$password = hash('sha256',$_POST["password"]);
		
			$query = "select * from users where username = '$username' and passwd = '$password'";
			$exec = $mysqli->query($query) or die("Error");
			if($exec->num_rows == 1)
			{
				session_start();
				ob_start();	
				$_SESSION["Login"] = true;
				$_SESSION["Username"] = $username;
				header("Location: Home.php");
			}
			else
			{
				$message = "Username and/or Password incorrect.\\nTry again.";
				echo "<script type='text/javascript'>alert('$message');
				window.location.href = 'Home.php';</script>";
			}
		}elseif(isset($_POST['register'])){
			$username = $_POST["username2"];
			$password = hash('sha256',$_POST["password2"]);
			$email    = $_POST["email"];
			$phone    = $_POST["phone"];
			$age      = $_POST["age"];
			$gender   = $_POST["gender"];
			
			$query = "insert into users (username, passwd, email, phone, age, gender) values ('$username', '$password', '$email', $phone, '$age', $gender)";
			$exec = $mysqli->query($query);
			
			if(!$exec)
			{
				$message = "Username and/or email and/or Phone number exist.\\nTry again.";
				echo "<script type='text/javascript'>alert('$message');
				window.location.href = 'Home.php';</script>";
			}
			else
			{
				session_start();
				ob_start();	
				$_SESSION["Login"] = true;
				$_SESSION["Username"] = $username;
				header("Location: Home.php");
			}
		}
	} 
?>
<script src="../js/popup.js"></script>
<a href="Help.php" class="link">Help</a>