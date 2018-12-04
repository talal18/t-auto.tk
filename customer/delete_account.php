
<br>
<h2 style="text-align: center;">Do you really want to delete your account?</h2>

<form action="" method="post">
	
		<br><br>

		<input type="submit" name="yes" value="YES, I DO" style="color: green; font-weight: bold;">
		&nbsp&nbsp&nbsp&nbsp&nbsp
		<input type="submit" name="no" value="NO, I DON'T" style="color: red; font-weight: bold;">

</form>


<?php

include("includes/db.php");

	$user = $_SESSION['customer_email'];

	if(isset($_POST['yes'])){

		$delete_customer = "delete from customers where customer_email = '$user'";

		$run_customer = mysqli_query($con, $delete_customer);

		echo "<script>alert('Your account have been deleted')</script>";
		echo "<script>window.open('../index.php','_self')</script>";

		session_destroy();
	}

	if(isset($_POST['no'])){

		echo "<script>window.open('my_account.php','_self')</script>";

	}

?>