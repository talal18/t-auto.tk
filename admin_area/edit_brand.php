<?php

include("includes/db.php");


if(!isset($_SESSION['user_email'])){

	echo "<script>window.open('login.php?not_admin=You are not Admin','_self')</script>";
}else{


	if(isset($_GET['edit_brand'])){

		$brand_id = $_GET['edit_brand'];

		$get_brand = "SELECT * FROM brands WHERE brand_id = '$brand_id'";

		$run_get_brand = mysqli_query($con, $get_brand);

		$row_brand = mysqli_fetch_array($run_get_brand);

			$brand_id = $row_brand['brand_id'];
			$brand_title = $row_brand['brand_title'];


	}

?>


<form action="" method="post" style="padding: 100px;">
	
	<b>Update Brand</b>
	<input type="text" name="brand" value="<?php echo $brand_title ?>">
	<input type="submit" name="update_brand" value="Update Brand">

</form>

<?php
	

	if(isset($_POST['update_brand'])){

		$update_id = $brand_id;

		$new_brand = $_POST['brand'];

		$update_brand = "UPDATE brands SET brand_title = '$new_brand' WHERE brand_id = '$update_id' ";

		$run_update_brand = mysqli_query($con, $update_brand);	

		if($run_update_brand){

			echo "<script>alert('Brand has been updated')</script>";
			echo "<script>window.open('index.php?view_brands','_self')</script>";
		}

	}
}	
?>