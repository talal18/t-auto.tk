<?php


if(!isset($_SESSION['user_email'])){

	echo "<script>window.open('login.php?not_admin=You are not Admin','_self')</script>";
}else{


?>

<table width="795" align="center" bgcolor="#C0C0C0">

	<br>
	<tr>
		<h2 align="center">All Categories</h2>
	</tr>

	<br>
	<tr align="center" bgcolor="#6083bc">
		<th>Serial number</th>
		<th>Title</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

	<?php

	include("../includes/db.php");

	$get_cats = "select * from categories";

	$run_cats = mysqli_query($con, $get_cats);

	$i = 0;

	while($row_cats = mysqli_fetch_array($run_cats)){

		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];
		$i++;


	?>
	
	<tr align="center">
		<td><?php echo $i ?></td>
		<td><?php echo $cat_title ?></td>
		<td><a href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</td>
		<td><a href="delete_cat.php?delete_cat=<?php echo $cat_id ?>">Delete</td>

	</tr>

<?php 
	}	
}
?>

</table>