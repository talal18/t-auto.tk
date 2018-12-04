<?php

include("includes/db.php");


if(!isset($_SESSION['user_email'])){

	echo "<script>window.open('login.php?not_admin=You are not Admin','_self')</script>";
}else{


if(isset($_GET['edit_product'])){

	$get_id = $_GET['edit_product'];

	$get_pro = "select * from products where product_id = $get_id";

	$run_pro = mysqli_query($con, $get_pro);

	$i = 0;

	$row_pro=mysqli_fetch_array($run_pro);

		$pro_id = $row_pro['product_id'];
		$product_title = $row_pro['product_title'];
		$product_cat = $row_pro['product_cat'];
		$product_brand = $row_pro['product_brand'];
		$product_image = $row_pro['product_image'];
		$product_price = $row_pro['product_price'];
		$product_desc = $row_pro['product_desc'];
		$product_keywords = $row_pro['product_keywords'];


		$get_cat_name = "select * from categories where cat_id = '$product_cat'";

		$run_cat_name = mysqli_query($con, $get_cat_name);

		$row_cat_name = mysqli_fetch_array($run_cat_name);

		$category_name = $row_cat_name['cat_title'];




		$get_brand_name = "select * from brands where brand_id = '$product_brand'";

		$run_brand_name = mysqli_query($con, $get_brand_name);

		$row_brand_name = mysqli_fetch_array($run_brand_name);

		$brand_name = $row_brand_name['brand_title'];

	
}

?>
<!DOCTYPE html>
<html>
	<head>
		
		<title>Update Product</title>
		
		<!-- text editor for thextarea -->
		<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  		<script>tinymce.init({ selector:'textarea' });</script>
	
	</head>
<body bgcolor="ECF0F1">

	<form action="" method="post" enctype="multipart/form-data">
		
		<table align="center" width="795" border="2" bgcolor="	#C0C0C0">
			
			<tr align="center">
				<td colspan="7"><h2>Update product</h2></td>
			</tr>

			<tr>
				<td align="right"><b>Product Title</b></td>
				<td><input type="text" name="product_title" value="<?php echo $product_title ?>" /></td>
			</tr>

			<tr>
				<td align="right"><b>Product category</b></td>
				<td>
					<select name="product_cat">
						<option><?php echo $category_name; ?></option>
						
						<!-- load categories form the database using php -->
						<?php
							$get_cats = "select * from categories";

							$run_cats = mysqli_query($con, $get_cats);

							while ($row_cats = mysqli_fetch_array($run_cats) ){

							$cat_id = $row_cats['cat_id'];
							$cat_title = $row_cats['cat_title'];

							echo "<option value= '$cat_id'>$cat_title</option>";
							
							}
						?>	

					</select>
				</td>
			</tr>


			<tr>
				<td align="right"><b>Product brand</b></td>
				<td>
					<select name="product_brand">
						<option><?php echo $brand_name; ?></option>

						<!-- load brands form the database using php -->
						<?php
							$get_brands = "select * from brands";

							$run_brands = mysqli_query($con, $get_brands);

							while ($row_brands = mysqli_fetch_array($run_brands) ){

								$brand_id = $row_brands['brand_id'];
								$brand_title = $row_brands['brand_title'];

								echo "<option value='$brand_id'>$brand_title</option>";

								}
						?>
				</td>
			</tr>

			<tr>
				<td align="right"><b>Product image</b></td>
				<td><input type="file" name="product_image" /><img src="product_images/<?php echo $product_image ?>" width="220" height="150" align="left"></td>
			</tr>

			<tr>
				<td align="right"><b>Product price</b></td>
				<td><input type="text" name="product_price" value="<?php echo $product_price ?>" /></td>
			</tr>

			<tr>
				<td align="right"><b>Product description</b></td>
				<td><textarea name="product_desc" cols="20" rows="10"><?php echo $product_desc ?></textarea></td>
			</tr>

			<tr>
				<td align="right"><b>Product keywords</b></td>
				<td><input type="text" name="product_keywords" value="<?php echo $product_keywords ?>" size="50" /></td>
			</tr>

				

			<tr align="center">
				<td colspan="8"><input type="submit" name="update_product" value="Update Product" /></td>
			</tr>

		</table>


	</form>


</body>
</html>

<?php

	if(isset($_POST['update_product'])) {

		// Getting the text data from the fields
        
        $update_id = $pro_id;
		
		$product_title = $_POST['product_title'];
		$product_cat = $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];

		// Getting the image from thr field
		$product_image = $_FILES['product_image']['name'];
		$product_image_tmp = $_FILES['product_image']['tmp_name'];

		move_uploaded_file($product_image_tmp, "product_images/$product_image");

		$update_product = "UPDATE products SET product_cat='$product_cat', product_brand='$product_brand', product_title='$product_title', product_price='$product_price', product_desc='$product_desc', product_image='$product_image', 
			product_keywords='$product_keywords' WHERE product_id='$update_id'"; 
			

		$run_update_pro = mysqli_query($con, $update_product);

		if ($run_update_pro){

			echo "<script>alert('product has been updated')</script>";
			echo "<script>window.open('index.php?view_products','_self')</script>";

		}

	}	

}
?>
