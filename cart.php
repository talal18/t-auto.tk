<?php
session_start();
include("functions/functions.php");



?>
<!DOCTYPE html>
<html>
<head>
	<title>My Online Shop</title>

	<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>

	<!-- Main container starts here -->
	<div class="main_wrapper">


		<!-- Header starts here -->
		<div class="header_wrapper">

			<a href="index.php"> <img id="logo" src ="images/logo.png"> </a>
			<img id="banner" src="images/ad-banner.jpg">
		
		</div>
		<!-- Header ends here -->


		<!-- Navigation bar starts here -->
		<div class="menubar">

			<ul id="menu">
				<li><a href="index.php">Home</a></li>
				<li><a href="all_products.php">All Products</a></li>
				<li><a href="customer/my_account.php">My Account</a></li>
				<li><a href="customer_register.php">Sign up</a></li>
				<li><a href="cart.php">Shopping cart</a></li>
				<li><a href="#">Contact us</a></li>
			</ul>

			<div id="form">

				<form method="get" action="results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a product">
					<input type="submit" name="search" value="search">
					
				</form>
			</div>

		</div>	
		<!-- Navigation bar ends here -->


		<!-- Content wrapper starts here -->
		<div class="content_wrapper">

			
			<div id="sidebar">

				<div id="sidebar_title">Categories</div>
				
				<ul id="cats">
				
					<?php getCats(); ?>	
					
				</ul>


				<div id="sidebar_title">Models</div>
				
				<ul id="cats">
					
					<?php getBrands(); ?>

				</ul>
				

			</div>

			<div id="content_area">

				<?php cart(); ?>

				<div id="shopping_cart">
					<span style="float: right; font-size: 17px; padding: 5px; line-height: 40px;">

						<?php

						if(isset($_SESSION['customer_email'])){

							echo "<b>Welcome</b>" . " " . $_SESSION['customer_email'] . "<b style='color:yellow'>Your</b>";

						}else{

							echo "<b>Welcome Guest</b>";
						}

						?>

						<b style="color: yellow">Shopping Cart -</b>
						Total Items: <?php total_items(); ?> Total Price: <?php total_price(); ?>
						<a href="index.php" style="color: yellow;">Back to shop</a>	

						<?php

						if(!isset($_SESSION['customer_email'])){

							echo "<a href='checkout.php' style='color:orange'>Login</a>";
						
						}else{

							echo "<a href='logout.php' style='color:orange'>Logout</a>"; 

						}

						?>									

					</span>
					
				</div>

				
				
				<div id="products_box">


					<form action="" method="post" enctype="multipart/form-data">	
						<table align="center" width="700" bgcolor="#7FB3D5">
							
							<tr align="center">
								<th>Remove</th>
								<th>Product(s)</th>
								<th>Quantity</th>
								<th>Totla price</th>
							</tr>

							<?php

								$total = 0;

								global $con;

								$ip = getIp();

								$sel_price = "select * from cart where ip_add = '$ip'";

								$run_price = mysqli_query($con, $sel_price);

								while ($p_price = mysqli_fetch_array($run_price)){

									//Getting the product ID from the cart table
									$pro_id = $p_price['p_id'];

									//Getting the product ID from the product table and compare it with the ID from the cart table
									$pro_price = "select * from products where product_id = '$pro_id'";

									$run_pro_price = mysqli_query($con, $pro_price) or die(mysqli_error($con));

										//after getting the product ID we need to get the price of the product
										while ($pp_price = mysqli_fetch_array($run_pro_price)){

										// we are using an array have all the values in one array to add them togther to have the total price.
										$product_price = array($pp_price['product_price']);
										$product_title = $pp_price['product_title'];
										$product_image = $pp_price['product_image'];
										$single_price = $pp_price['product_price'];


										//this variable id using array_sum which sum all the values in the array
										$values = array_sum($product_price);

										$total += $values;

											

							?>


									<tr align="center">
										<td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>" /></td>
										<td><?php echo $product_title; ?>
											<br>
											<img src="admin_area/product_images/<?php echo $product_image; ?>" width="60" height="60" />
										</td>
										<td><input type="text" size="4" id="qty" name="qty" value="<?php echo $_SESSION['qty'];?>"/></td>


										<?php

											if(isset($_POST['update_cart'])){

												$qty = $_POST['qty'];

												$update_qty = "update cart set qty = '$qty'";

												$run_qty = mysqli_query($con, $update_qty) or die(mysqli_error($con));

												$_SESSION['qty'] = $qty;

												$total = $total * $qty;
											}


										?>

										<td><?php echo "$" . $single_price; ?> </td>
									</tr>

									
									<?php
									
									}
								
								} 
								
								?>	

									<tr align="right">
										<td colspan="4"><b>Sub Total:</b></td>
										<td><?php echo "$" . $total; ?></td>	
									</tr>	

									<tr align="center">
										<td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
										<td><input type="submit" name="continue" value="Continue Shopping"/></td>
										<td><button><a href="checkout.php" name="checkout" style="text-decoration: none; color: black;">Checkout</a></button></td>
									</tr>


						</table>

					</form>


					<?php


						function updatecart(){
							
							global $con;

							$ip = getIp();

							if(isset($_POST['update_cart'])){
								foreach ($_POST['remove'] as $remove_id) {

									$delete_product = "delete from cart where p_id ='$remove_id' AND ip_add='$ip'";
									$run_delete = mysqli_query($con, $delete_product);

									if($run_delete){

										echo "<script>window.open('cart.php','_self')</script>";
									}

								}
							}
														
							if(isset($_POST['continue'])){

								echo "<script>window.open('index.php','_self')</script>";
							}

													
						}

						//this line will not generate error if this function is not working or active
						echo @$up_cart = updatecart();	


					?>

				</div>	

			</div>

		</div>
		<!-- Content wrapper ends here -->

			
		<div id="footer">
			
			<h2 style="text-align: center; padding-top: 30px;">&copy; 2018 by www.t-auto.tk</h2>

		</div>



	</div>

	<!-- Main container ends here -->
</body>
</html>