<?php


if(!isset($_SESSION['user_email'])){

	echo "<script>window.open('login.php?not_admin=You are not Admin','_self')</script>";
}else{


?>

<table width="795" align="center" bgcolor="#C0C0C0">

	<br>
	<tr>
		<h2 align="center">All Brands</h2>
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

	$get_brands = "select * from brands";

	$run_brands = mysqli_query($con, $get_brands);

	$i = 0;

	while($row_brands = mysqli_fetch_array($run_brands)){

		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];
		$i++;


	?>
	
	<tr align="center">
		<td><?php echo $i ?></td>
		<td><?php echo $brand_title ?></td>
		<td><a href="index.php?edit_brand=<?php echo $brand_id; ?>">Edit</td>
		<td><a href="delete_brand.php?delete_brand=<?php echo $brand_id ?>">Delete</td>

	</tr>

<?php 
	}	
}
?>

</table>