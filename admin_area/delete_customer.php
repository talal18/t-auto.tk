<?php

include("includes/db.php");


if(!isset($_SESSION['user_email'])){

	echo "<script>window.open('login.php?not_admin=You are not Admin','_self')</script>";
}else{


	if(isset($_GET['delete_customer'])){

		$delete_id = $_GET['delete_customer'];

		$delete_cust = "delete from customers where customer_id = '$delete_id'";

		$run_delete_cust = mysqli_query($con, $delete_cust);


		if($run_delete_cust){

			echo "<script>alert('Caustomer has been deleted')</script>";
			echo "<script>window.open('index.php?view_customers','_self')</script>";
		}

	}

}
?>