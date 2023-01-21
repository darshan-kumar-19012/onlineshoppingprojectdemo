<?php
session_start();
include('config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	$sql_p="SELECT * FROM products WHERE id={$id}";
	$query_p=mysqli_query($con,$sql_p);
	if(mysqli_num_rows($query_p)!=0){
		$row_p=mysqli_fetch_array($query_p);
		$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
			echo "<script>alert('Product has been added to the cart')</script>";
			echo "<script type='text/javascript'> document.location ='cart.php'; </script>";
	}else{
		$message="Product ID is invalid";
	}
	
}