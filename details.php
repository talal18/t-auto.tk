<!DOCTYPE html>
<?php

include("functions/functions.php");

?>
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

			<a href="index.php"><img id="logo" src ="images/logo.png"> </a>
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
				<li><a href="cart,php">Shopping cart</a></li>
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
					<span style="float: right; font-size: 18px; padding: 5px; line-height: 40px;">
						Welcome Guest! <b style="color: yellow">Shopping Cart -</b>
						Total Items: <?php total_items(); ?> Total Price
						<a href="cart.php" style="color: yellow;">Go to cart</a>						

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

					<?php

						if(isset ($_GET['pro_id'])) {

							$product_id = $_GET['pro_id'];

							$get_pro = "select * from products where product_id ='$product_id'";

							$run_pro = mysqli_query($con, $get_pro);

							while($row_pro = mysqli_fetch_array($run_pro)){

								$pro_id = $row_pro['product_id'];					
								$pro_title = $row_pro['product_title'];
								$pro_price = $row_pro['product_price'];
								$pro_image = $row_pro['product_image'];
								$pro_desc = $row_pro['product_desc'];

								echo "
									<div id='single_product'>

										<h3>$pro_title</h3> 

										<img src='admin_area/product_images/$pro_image' width='400' height='300' />

										<p><b> Price: $ $pro_price </b></p>

										<br></br>

										<p>$pro_desc</p>

										<br></br>

										<a href='index.php?pro_id=$pro_id' style='float:left;'>Go Back</a>

										<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a> 


									</div>

								";

							}	
							}
									
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