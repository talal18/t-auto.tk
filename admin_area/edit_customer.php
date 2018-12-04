<?php

include("includes/db.php");

if(!isset($_SESSION['user_email'])){

	echo "<script>window.open('login.php?not_admin=You are not Admin','_self')</script>";
}else{


	if(isset($_GET['edit_customer'])){

		$customer_id = $_GET['edit_customer'];

		$get_customer = "SELECT * FROM customers WHERE customer_id = '$customer_id'";

		$run_get_customer = mysqli_query($con, $get_customer);

		$row_customer = mysqli_fetch_array($run_get_customer);

			$customer_id = $row_customer['customer_id'];
			$customer_name = $row_customer['customer_name'];
			$customer_email = $row_customer['customer_email'];


	}

?>


<form action="" method="post" style="padding: 100px;">
	
	<b>Update Customer</b>
	<br><br>
	<h4>Customer name:<input type="text" name="customer_name" value="<?php echo $customer_name ?>"></h4>
	<br>
	<h4>Customer email:<input type="text" name="customer_email" value="<?php echo $customer_email ?>"></h4>
	<br>
	<input type="submit" name="update_customer" value="Update Customer">

</form>

<?php
	

	if(isset($_POST['update_customer'])){

		$update_id = $customer_id;

		$new_customer_name = $_POST['customer_name'];
		$new_customer_email = $_POST['customer_email'];


		$update_customer = "UPDATE customers SET customer_name = '$new_customer_name', customer_email = '$new_customer_email'  WHERE customer_id = '$update_id'";

		$run_update_customer = mysqli_query($con, $update_customer);	

		if($run_update_customer){

			echo "<script>alert('Customer has been updated')</script>";
			echo "<script>window.open('index.php?view_customers','_self')</script>";
		}

	}
}	
?>