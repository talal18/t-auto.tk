<?php

include("includes/db.php");


if(!isset($_SESSION['user_email'])){

	echo "<script>window.open('login.php?not_admin=You are not Admin','_self')</script>";
}else{


	if(isset($_GET['edit_cat'])){

		$cat_id = $_GET['edit_cat'];

		$get_cat = "SELECT * FROM categories WHERE cat_id = '$cat_id'";

		$run_get_cat = mysqli_query($con, $get_cat);

		$row_cat = mysqli_fetch_array($run_get_cat);

			$cat_id = $row_cat['cat_id'];
			$cat_title = $row_cat['cat_title'];

	}

?>

<form action="" method="post" style="padding: 100px;">
	
	<b>Update Category</b>
	<input type="text" name="cat" value="<?php echo $cat_title ?>">
	<input type="submit" name="update_cat" value="update category">

</form>

<?php
	



	if(isset($_POST['update_cat'])){

		$update_id = $cat_id;

		$new_cat = $_POST['cat'];

		$update_cat = "UPDATE categories SET cat_title = '$new_cat' WHERE cat_id = '$update_id'";

		$run_update_cat = mysqli_query($con, $update_cat);	

		if($run_update_cat){

			echo "<script>alert('Category has been updated')</script>";
			echo "<script>window.open('index.php?view_cats','_self')</script>";
		}

	}
}	
?>