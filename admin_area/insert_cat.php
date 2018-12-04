<?php


if(!isset($_SESSION['user_email'])){

	echo "<script>window.open('login.php?not_admin=You are not Admin','_self')</script>";
}else{


?>

<form action="" method="post" style="padding: 100px;">
	
	<b>Insert new Category</b>
	<input type="text" name="new_cat" required>
	<input type="submit" name="add_cat" value="add category">

</form>

<?php
	
include("includes/db.php");


	if(isset($_POST['add_cat'])){

		$new_cat = $_POST['new_cat'];

		$insert_cat = "insert into categories (cat_title) values ('$new_cat')";

		$run_insert_cat = mysqli_query($con, $insert_cat);	

		if($run_insert_cat){

			echo "<script>alert('New category has been inserted')</script>";
			echo "<script>window.open('index.php?view_cats','_self')</script>";
		}

	}
}	
?>