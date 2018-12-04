<?php

include("includes/db.php");	
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

			// Getting the product title from the products table.
			$product_name = $pp_price['product_title'];
			
			//this variable id using array_sum which sum all the values in the array
			$values = array_sum($product_price);

			$total += $values;

		}

	}

		$get_qty = "SELECT * FROM cart WHERE p_id = '$pro_id'";

		$run_get_qty = mysqli_query($con, $get_qty);

		$row_qty = mysqli_fetch_array($run_get_qty);

		$qty = $row_qty['qty'];

		if($qty==0){

			$qty=1;
	
		}else{

			$qty=$qty;
			 
		}

?>



<div>
	
	<br>
	<h2 align="center" style="font-family: corbel;">Pay now with Paypal</h2>
	<br>
	<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  		<!-- Identify your business so that you can collect the payments. -->
  		<input type="hidden" name="business" value="talal_kasem-facilitator@hotmail.com">

  		<!-- Specify a Buy Now button. -->
  		<input type="hidden" name="cmd" value="_xclick">

  		<!-- Specify details about the item that buyers will purchase. -->
  		<input type="hidden" name="item_name" value="<?php echo $product_name ?>">
  		<input type="hidden" name="item_number" value="<?php echo $pro_id ?>">
  		<input type="hidden" name="amount" value="<?php echo $total ?>">
  		<input type="hidden" name="quantity" value="<?php echo $qty ?>">
  		<input type="hidden" name="currency_code" value="CAD">

  		<input type="hidden" name="return" value="http://t-auto.tk/paypal_success.php">
  		<input type="hidden" name="cancel_return" value="http://t-auto.tk/paypal_cancel.php">

  		<!-- Display the payment button. -->
  		<input type="image" name="submit" border="0"
  		src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
  		alt="Buy Now">
  		<img alt="" border="0" width="1" height="1"
  		src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

	</form>

</div>