<?php

session_start();
include("includes/db.php");
include("functions/functions.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Payment Successful!</title>
</head>
<body>
 	
 	<?php

	//Getting product details.
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
				$product_id = $pp_price['product_id'];
				//this variable id using array_sum which sum all the values in the array
				$values = array_sum($product_price);

				$total += $values;

			}

	}

	//getting quantity of the product.

	$get_qty = "SELECT * FROM cart WHERE p_id = '$pro_id'";

	$run_get_qty = mysqli_query($con, $get_qty);

	$row_qty = mysqli_fetch_array($run_get_qty);

	$qty = $row_qty['qty'];

	if($qty==0){

		$qty=1;
	
	}else{

		$qty = $qty;
		$total = $total*$qty; 
	}


	// customer details.
	$user = $_SESSION['customer_email'];

	$get_c = "select * from customers where customer_email = '$user'";

	$run_c = mysqli_query($con, $get_c);

	$row_c = mysqli_fetch_array($run_c);

	$c_id = $row_c['customer_id'];


	//payment details from paypal.

	$amount = $_GET['amt'];
	$currency = $_GET['cc'];
	$trx_id = $_GET['tx'];
	$invoice = mt_rand();

	//insert payments to table
	$insert_payments = "INSERT INTO payments (amount, customer_id, product_id, trx_id, currency, payment_date) VALUES ('$amount', '$c_id', '$pro_id','$trx_id','$currency', NOW())";
	
	$run_insert_payment = mysqli_query($con, $insert_payments) or die(mysqli_error($con));

	//insert orders to table
	$insert_orders = "INSERT INTO orders (p_id, c_id, qty, invoice_no, order_date, status) VALUES ('$pro_id','$c_id','$qty','$invoice', NOW()), 'in Progress'";

	$run_insert_orders = mysqli_query($con, $insert_orders);

	//removing the products from cart
	$empty_cart = "DELETE FROM cart";

	$run_empty_cart = mysqli_query($con, $empty_cart);

	if($amount==$total){

		echo "<H2>Welcome: " . $_SESSION['customer_email'] . "<br>" . " Your payment was successful</H2>";

		echo "<a href='http://t-auto.tk/customer/my_account.php'>Go back to your accoount</a>";

	}else{

		echo '<script type="text/javascript">alert("'.$amount.'");</script>';
		echo '<script type="text/javascript">alert("'.$trx_id.'");</script>';
		echo '<script type="text/javascript">alert("'.$currency.'");</script>';

		echo "<h2>Welcome Guest, payment failed</H2><br>";

		echo "<a href='http://t-auto.tk/'>Go back to to shop</a>"; 
	}

	?>


</body>
</html>