<?php


if(!isset($_SESSION['user_email'])){

	echo "<script>window.open('login.php?not_admin=You are not Admin','_self')</script>";
}else{


?>

<table width="795" align="center" bgcolor="#C0C0C0">

	<br>
	<tr>
		<h2 align="center">Customers</h2>
	</tr>

	<br>
	<tr align="center" bgcolor="#6083bc">
		<th>Serial number</th>
		<th>Name</th>
		<th>Email</th>
		<th>Image</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>

	<?php

	include("../includes/db.php");

	$get_customers = "select * from customers";

	$run_customers = mysqli_query($con, $get_customers);

	$i = 0;

	while($row_customers = mysqli_fetch_array($run_customers)){

		$customer_id = $row_customers['customer_id'];
		$customer_name = $row_customers['customer_name'];
		$customer_email = $row_customers['customer_email'];
		$customer_image = $row_customers['customer_image'];
		$i++;


	?>
	
	<tr align="center">
		<td><?php echo $i ?></td>
		<td><?php echo $customer_name ?></td>
		<td><?php echo $customer_email ?></td>
		<td><img src="../customer/customer_images/<?php echo $customer_image ?>" width="50" height="50"></td>
		<td><a href="index.php?edit_customer=<?php echo $customer_id; ?>">Edit</td>
		<td><a href="delete_customer.php?delete_customer=<?php echo $customer_id ?>">Delete</td>

	</tr>

<?php 
	}	
}
?>

</table>