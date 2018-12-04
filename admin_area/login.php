<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>

<link rel="stylesheet" type="text/css" href="styles/login_style.css" media="all">	
</head>
<body>

	<div>
		<br>
		<h2 style="text-align: center; color: #07918a; font-family: corbel;"><?php echo @$_GET['not_admin']; ?></h2>
		<h2 style="text-align: center; color: #07918a; font-family: corbel;"><?php echo @$_GET['logged_out']; ?></h2>

		<br>
		<h1 style="text-align: center; color: #07918a; font-family: corbel;">Admin Login</h1>
		
		<form method="post" action="login.php">


			<div class="login">
    			<input type="text" name="u_name" placeholder="email" id="username" required>  
  				<input type="password" name="pass" placeholder="password" id="password" required>  
  				<input type="submit" name="login" value="Login">
			</div>
			<div class="shadow"></div>
			
		</form>
	</div>

</body>
</html>

<?php


include("includes/db.php");

	if(isset($_POST['login'])){

		//mysql_real_escape_string($_POST['u_name']);
		$email = mysqli_real_escape_string($con, $_POST['u_name']);
		$pass = mysqli_real_escape_string($con, $_POST['pass']);

		$sel_user = "SELECT * FROM admins WHERE user_email = '$email' AND user_password = '$pass'";

		$run_user = mysqli_query($con, $sel_user);

		$check_user = mysqli_num_rows($run_user);

		if($check_user==0){

			echo "<script>alert('email or password is wrong, please try again')</script>";
			
		}else{

			$_SESSION['user_email']=$email;

			echo "<script>window.open('index.php?logged_in=You have successfully logged in','_self')</script>";
			
			

		}


	}


?>