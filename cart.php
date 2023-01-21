<?php
session_start();
$totalprice=0;
include('config.php');
	if(isset($_POST['submit'])){
			if(!empty($_SESSION['cart'])){
			foreach($_POST['quantity'] as $key => $val){
				if($val==0){
					unset($_SESSION['cart'][$key]);
				}else{
					$_SESSION['cart'][$key]['quantity']=$val;
	
				}
			}
			echo "<script>alert('Your Cart has been Updated');</script>";
			}
		}
	if(isset($_POST['remove_code']))
		{
		if(!empty($_SESSION['cart'])){
			foreach($_POST['remove_code'] as $key){
				unset($_SESSION['cart'][$key]);
			}
			echo "<script>alert('Your Cart has been Updated');</script>";
		}
	}
	if(isset($_POST['ordersubmit'])) 
	{
		if(strlen($_SESSION['login'])==0)
		{   
			header('location:login.php');
		}
		else{
			$quantity=['quantity'];
			$pdd=$_SESSION['pid'];
			$value=array_combine($pdd,$quantity);
			foreach($value as $qty=> $val34){
			mysqli_query($con,"insert into orders(userId,productId,quantity) values('".$_SESSION['id']."','$qty','$val34')");
			header('location:payment-method.php');
		}
		}
	}
		if(isset($_POST['shipupdate']))
		{
			$saddress=$_POST['shippingaddress'];
			$sstate=$_POST['shippingstate'];
			$scity=$_POST['shippingcity'];
			$spincode=$_POST['shippingpincode'];
			$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
			$query=mysqli_query($con,"update users set billingAddress='$saddress',billingState='$sstate',billingCity='$scity',billingPincode='b$spincode' where id='".$_SESSION['id']."'");
			if($query)
			{
				echo "<script>alert('Shipping Address has been updated');</script>";
			}
		}
		include('main-header.html')
?>
<!DOCTYPE html>
<html lang="en">
	<head><style>
    .shipping {
      margin-top: 5%;
      margin-left: 4%;
      width: 40%;
    }
	.shipping  textarea{
	  width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
	}
    .shipping input[type=text] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .shipping button {
      background-color: black;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    .shipping button:hover {
      opacity: 0.8;
    }
	.grand-total{
		margin-top:6%;
		margin-left:15%;
	}
	.grand-total button {
      background-color: black;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }
	table{
		width:100%;
		margin-top:2%;
		border:solid 3px;
	}
	th{
		background:black;
		color:white;
		padding:1%;
	}
	td{
		padding:2%;
	}
	tfoot input{
		float:right;
		background-color: black;
      	color: white;
      	padding: 14px 20px;
     	margin: 8px 0;
		border: none;
	}
	tfoot a{
		text-decoration:none;
		background-color: black;
      	color: white;
      	padding: 14px 20px;
     	margin: 8px 0;
		border: none;
	}
  </style></head>
    <body>
		<h1>Cart details</h1>
		<form  name="cart" method="post">
		<table>
		<?php
		if(!empty($_SESSION['cart'])){
			$id=$_SESSION['id'];
		?>
			<thead>
				<tr>
					<th class="cart-romove item">Remove</th>
					<th class="cart-description item">Image</th>
					<th class="cart-product-name item">Product Name</th>
					<th class="cart-qty item">Quantity</th>
					<th class="cart-sub-total item">Price Per unit</th>
					<th class="cart-sub-total item">Shipping Charge</th>
					<th class="cart-total last-item">Grandtotal</th>
				</tr>
			</thead>
			<tbody>
 			<?php
 			$pdtid=array();
   			$sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
				$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;
				array_push($pdtid,$row['id']);
			?>
				<tr>
					<td><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>" /></td>
					<td >
						<img src="productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="" width="114" height="146">
					</td>
					<td >
						<h4 class='cart-product-description'><?php echo $row['productName'];$_SESSION['sid']=$pd;?></h4>
					<td >
				        <input type="number" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]">
		            </td>
					<td ><span ><?php echo "Rs"." ".$row['productPrice']; ?>.00</span></td>
					<td><span ><?php echo "Rs"." ".$row['shippingCharge']; ?>.00</span></td>
					<td ><span ><?php echo ($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>.00</span></td>
				</tr>
				<?php } }
				$_SESSION['pid']=$pdtid;
				?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="7">
						<div>
							<span class="">
								<a href="index.php" class="">Continue Shopping</a>
								<input type="submit" name="submit" value="Update shopping cart" >
							</span>
						</div>
					</td>
				</tr>
				<?php }
			else {	echo "Your shopping Cart is empty";}?>
			</tfoot>
			</form>
		</table>
		<div style="display:flex;">
		<div class="shipping">
		<h1>Shipping Address</h1>
		<?php
		$id=$_SESSION['id'];
	$query=mysqli_query($con,"select * from users where id='$id'");
	while($row=mysqli_fetch_array($query)){
		?>
				<form  method="post">
				<?php echo $row['shippingState'];?>
				<label for="Shipping Address">Shipping Address<span>*</span></label>
				<textarea name="shippingaddress" required="required"><?php echo $row['shippingAddress'];?></textarea>
				<label for="Billing State ">Shipping State  <span>*</span></label>
				<input type="text" id="shippingstate" name="shippingstate" value="<?php echo $row['shippingState'];?>" required>
				<label for="Billing City">Shipping City <span>*</span></label>
				<input type="text" id="shippingcity" name="shippingcity" required="required" value="<?php echo $row['shippingCity'];?>" >
				<label class="info-title" for="Billing Pincode">Shipping Pincode <span>*</span></label>
				<input type="text" id="shippingpincode" name="shippingpincode" required="required" value="<?php echo $row['shippingPincode'];?>" >
				<button type="submit" name="shipupdate">Update</button>
				</div><?php } ?>
				<div class="grand-total"><h1>Grand Total<span>&nbsp;<?php echo $_SESSION['tp']=" ₹"."$totalprice"; ?></span></h1>
				<button type="submit" name="ordersubmit">PROCCED TO CHEKOUT</button></div>
				</form>
				</div>	
				</div>
	</body>
</html>