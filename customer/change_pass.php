
<h2 style="text-align: center;">Change Password</h2><br><br><br>
<form action="" method="post">
	
	<table align="center" width="600">
		
		<tr>
			<td align="right"><b>Enter current Password:</b></td>
			<td><input type="password" name="current_pass" required></td>
		</tr>

		<tr>
			<td align="right"><b>Enter new Password:</b></td>
			<td><input type="password" name="new_pass" required></td>
		</tr>

		<tr>
			<td align="right"><b>Re-type new Password:</b></td>
			<td><input type="password" name="new_pass_again" required></td>
		</tr>

		<tr align="center">
			<td></td>
			<td><input type="submit" name="change_pass" value="change Password"/></td>
		</tr>

	</table>
	
	
</form>

<?php

include("includes/db.php");


	if(isset($_POST['change_pass'])){

		$user = $_SESSION['customer_email'];

		$current_pass = $_POST['current_pass'];
		$new_pass = $_POST['new_pass'];
		$new_again = $_POST['new_pass_again'];

		$sel_pass = "select * from customers where customer_pass = '$current_pass' AND customer_email = '$user'";

		$run_pass = mysqli_query($con, $sel_pass);

		$check_pass = mysqli_num_rows($run_pass);

			if($check_pass==0){

				echo "<script>alert('current password is wrong')</script>";
				exit();

			}

			elseif($new_pass!=$new_again){

				echo "<script>alert('password does not match')</script>";
				exit();			
			
			}else{

				$update_pass = "update customers set customer_pass = '$new_pass' where customer_email = '$user'";

				$run_update_pass = mysqli_query($con, $update_pass);

				echo "<script>alert('Your password updated successfully')</script>";
				echo "<script>window.open('my_account.php','_self')</script>";


			}

	}


?>