<?php

$con = mysqli_connect("fdb19.awardspace.net","2649960_store","leonardo18","2649960_store");	

if (mysqli_connect_errno()) {

	echo "Connection problem " . mysqli_connect_error();
}



//this function gets the user IP Address (copied from the internet)
function getIp() {

    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}



// Creating the shopping cart
function cart(){

	if (isset($_GET['add_cart'])){

		global $con;

		$ip = getIp();

		$pro_id = $_GET['add_cart'];

		//to check if the user add the product to cart to avoid duplication of the same product.
		$check_pro = "select * from cart where ip_add = '$ip' and p_id = 'pro_id'";

		$run_check = mysqli_query($con, $check_pro);


		if(mysqli_num_rows($run_check)>0){

			echo "";

		}else{

			$insert_pro = "insert into cart(p_id, ip_add) values('$pro_id','$ip')";

			$run_pro = mysqli_query($con, $insert_pro);

			echo "<script>window.open('index.php','_self')</script>";



		}

	}

}


//getting the total added items
function total_items(){

	if(isset($_GET['add_cart'])){

		global $con;

		$ip = getIp();

		$get_items = "select * from cart where ip_add = '$ip'";

		$run_items = mysqli_query($con, $get_items);

		$count_items = mysqli_num_rows($run_items);

	}else{

		global $con;

		$ip = getIp();

		$get_items = "select * from cart where ip_add = '$ip'";

		$run_items = mysqli_query($con, $get_items);

		$count_items = mysqli_num_rows($run_items);		
	}

	echo $count_items;
}




//getting total price of items in the cart
function total_price(){

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

			//this variable id using array_sum which sum all the values in the array
			$values = array_sum($product_price);

			$total += $values;

		}

	}

	echo "$" .$total;

}



// getting the categories

function getCats(){

	global $con;

	$get_cats = "select * from categories";

	$run_cats = mysqli_query($con, $get_cats);

	while ($row_cats = mysqli_fetch_array($run_cats) ){

		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];

	echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";

	}

}



// getting the brands

function getBrands(){

	global $con;

	$get_brands = "select * from brands";

	$run_brands = mysqli_query($con, $get_brands);

	while ($row_brands = mysqli_fetch_array($run_brands)){

		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];

	echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";

	}

}

// this function will get the products from the database and show it in the content area.
function getPro(){

	if(!isset($_GET['cat'])) {  

		if(!isset($_GET['brand'])) {

			global $con;

			$get_pro = "select * from products order by RAND() LIMIT 0,6";

			$run_pro = mysqli_query($con, $get_pro);

			while($row_pro = mysqli_fetch_array($run_pro)){

				$pro_id = $row_pro['product_id'];
				$pro_cat = $row_pro['product_cat'];
				$pro_brand = $row_pro['product_brand'];
				$pro_title = $row_pro['product_title'];
				$pro_price = $row_pro['product_price'];
				$pro_image = $row_pro['product_image'];

				// showing the title in the content area
				// showing the image in the content area
				// showing the price in the content area
				// adding a details link for each product in th content area (any thing comes after the ? "in details.php?" usually it's a URL variable or get variable. In this case we created a URL vairable "pro_id" that equals pro_id in line 83).
				// adding a "Add to Cart" button(we also added a URL vaiable)
		


				echo "
						<div id='single_product'>

							<h3>$pro_title</h3> 

							<img src='admin_area/product_images/$pro_image' width='180' height='120' />

							<p><b> Price: $ $pro_price </b></p>


							<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>

							<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a> 


						</div>

				";

			}	
		}	
	}

}



function getCatPro(){

	if(isset($_GET['cat'])) {  

			$cat_id = $_GET['cat'];

			global $con;

			$get_cat_pro = "select * from products where product_cat ='$cat_id' order by product_title";

			$run_cat_pro = mysqli_query($con, $get_cat_pro);

			$count_cat =mysqli_num_rows($run_cat_pro);

			if($count_cat == 0){

				echo "<h3 style='padding:20px;'>No cars in this category</h3>";
			}

						
			while($row_cat_pro = mysqli_fetch_array($run_cat_pro)){

				$pro_id = $row_cat_pro['product_id'];
				$pro_cat = $row_cat_pro['product_cat'];
				$pro_brand = $row_cat_pro['product_brand'];
				$pro_title = $row_cat_pro['product_title'];
				$pro_price = $row_cat_pro['product_price'];
				$pro_image = $row_cat_pro['product_image'];

				// showing the title in the content area
				// showing the image in the content area
				// showing the price in the content area
				// adding a details link for each product in th content area (any thing comes after the ? "in details.php?" usually it's a URL variable or get variable. In this case we created a URL vairable "pro_id" that equals pro_id in line 83).
				// adding a "Add to Cart" button(we also added a URL vaiable)
		
			

				echo "
						<div id='single_product'>

							<h3>$pro_title</h3> 

							<img src='admin_area/product_images/$pro_image' width='180' height='120' />

							<p><b> $ $pro_price </b></p>


							<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>

							<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a> 


						</div>

					";

				
			}	
			
	}

}



function getBrandPro(){

	if(isset($_GET['brand'])) {  

			$brand_id = $_GET['brand'];

			global $con;

			$get_brand_pro = "select * from products where product_brand ='$brand_id' order by product_title asc";

			$run_brand_pro = mysqli_query($con, $get_brand_pro);

			$count_brand =mysqli_num_rows($run_brand_pro);

			if($count_brand == 0){

				echo "<h3 style='padding:20px;'>No cars avialable</h3>";
			}

						
			while($row_brand_pro = mysqli_fetch_array($run_brand_pro)){

				$pro_id = $row_brand_pro['product_id'];
				$pro_cat = $row_brand_pro['product_cat'];
				$pro_brand = $row_brand_pro['product_brand'];
				$pro_title = $row_brand_pro['product_title'];
				$pro_price = $row_brand_pro['product_price'];
				$pro_image = $row_brand_pro['product_image'];

				// showing the title in the content area
				// showing the image in the content area
				// showing the price in the content area
				// adding a details link for each product in th content area (any thing comes after the ? "in details.php?" usually it's a URL variable or get variable. In this case we created a URL vairable "pro_id" that equals pro_id in line 83).
				// adding a "Add to Cart" button(we also added a URL vaiable)
		
			

				echo "
						<div id='single_product'>

							<h3>$pro_title</h3> 

							<img src='admin_area/product_images/$pro_image' width='180' height='120' />

							<p><b> $ $pro_price </b></p>


							<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>

							<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>


						</div>

					";

				
			}	
			
	}

}


?>