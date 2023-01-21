<?php 
session_start();
include('config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
					echo "<script>alert('Product has been added to the cart')</script>";
		      echo "<script type='text/javascript'> document.location ='cart.php'; </script>";
		}else{
			$message="Product ID is invalid";
      echo "<script type='text/javascript'> document.location ='cart.php'; </script>";
		}
	}
}
$pid=intval($_GET['pid']);
include('main-header.html');

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/indexcss.css">
  <style>
    .product-description p {
      line-height: 2em;
    }
    .product-description h2 {
      border-bottom: 1px solid;
      padding: 1%;
    }

    .product-img {
      margin-left: 12%;
      display: inline-block;
      flex-basis: 25%;
    }
    .product {
      display: flex;
      margin-top:2%;
    }
    .nodots {
      list-style-type: none;
      line-height: 2em;
      margin-left: -16%;
    }
    button {
      background-color: #e7e7e7;
      color: black;
      border: none;
      padding: 12px 24px;
      text-align: center;
      text-decoration: none;
      font-size: 16px;
      margin-left:-5%;
    }
    .small-img {
      display: flex;
      margin-left: 9%;
    }
    .small-img img{
        margin-left:2.5%;
        margin-top:2%;
    }
    .product-description {
      margin-left: 3%;
      margin-right:1%;
      padding-bottom:2%;
    }
    .product-description h3 {
      margin-left: 3%;
    }
    .product-info h3{
      margin-left:-5%;
      display:block;
    }
    .incdec {
      width: 300px;
      text-align: center;
    }
    .value-button {
    display: inline-block;
    border: 1px solid #ddd;
    margin: 0px;
    width: 40px;
    height: 20px;
    text-align: center;
    vertical-align: middle;
    padding: 11px 0;
    background: #eee;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.value-button:hover {
  cursor: pointer;
}

 #decrease {
  margin-right: -4px;
  border-radius: 8px 0 0 8px;
}

.increase-button #increase {
  margin-left: -4px;
  border-radius: 0 8px 8px 0;
}

.increase-button #input-wrap {
  margin: 0px;
  padding: 0px;
}

input#number {
  text-align: center;
  border: none;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
  margin: 0px;
  width: 40px;
  height: 40px;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.cart{background: linear-gradient(to right, #1D2671, #C33764); 
  color:white;
  padding:4%;
  text-decoration:none;
}
.cart:hover{
  opacity: 0.8;
}
  </style>
</head>

<body>
<?php 
$ret=mysqli_query($con,"select * from products where id='$pid'");
$row=mysqli_fetch_array($ret)?>
  <div class="product">
    <div class="product-img">
      <img src="productimages\<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" id="productimage" width="270px" height="400px">
    </div>
    <div class="product-info">
      <h3><?php echo htmlentities($row['productName']);?></h3>
      <ul class="nodots">
        <li>AVAILABILITY : <?php echo htmlentities($row['productAvailability']);?></li>
        <li>PRODUCT BRAND : <?php echo htmlentities($row['productCompany']);?></li>
        <li>SHIPPING CHARGE : <?php if($row['shippingCharge']==0)
		{ echo "Free";}
		else{ echo htmlentities($row['shippingCharge']);}?></li>
      </ul>
      <h3>Rs. <?php echo htmlentities($row['productPrice']);?> </h3>
      <div style="margin-left:-26%; margin-bottom:12%;" ><form class="incdec">
          <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
          <input type="number" id="number" value="1" />
          <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
      </form></div>
      <?php if($row['productAvailability']=='In Stock'){?>
				<a href="addcart.php?page=product&action=add&id=<?php echo $row['id']; ?>" class="cart"> ADD TO CART</a>
			<?php } else {?>
							<div class="action" style="color:red">Out of Stock</div>
					<?php } ?>
    </div>
    <div class="product-description">
    <h2>Description</h2>
    <h3>Hardware Specifications</h3>
    <div style="display:block;"><p><?php echo $row['productDescription'];?><p></div> 
  </div>
  </div>
  <div class="small-img">
    <img src="productimages\<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" width="5%"
      onclick="document.getElementById('productimage').src='productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>'">
      <img src="productimages\<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage2']);?>" width="5%"
      onclick="document.getElementById('productimage').src='productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage2']);?>'">
      <img src="productimages\<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage3']);?>" width="5%"
      onclick="document.getElementById('productimage').src='productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage3']);?>'">
  </div>
  
  <div>
  <?php $cid=$row['category']; $subcid=$row['subCategory'];  ?>
  <h2 style="margin-left:5%; margin-top:4%;">Realted Products </h2>
  <div class="display-items">
            <ul>
            <?php
                $ret=mysqli_query($con,"select * from products where subCategory='$subcid' and category='$cid'");
                while ($row=mysqli_fetch_array($ret)) 
                {
                ?>
                <li>
                <a style="text-decoration:none; color: black;"  onMouseOver="this.style.color='blue'"onMouseOut="this.style.color='black'" href="productdetails.php?pid=<?php echo htmlentities($row['id']);?>">
                    <div class="list-inside">
                    <img  src="productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt="">
                        <h3><?php echo htmlentities($row['productName']);?></h3>
                        <h4>Rs.<?php echo htmlentities($row['productPrice']);?></h4>
                        <button>add to cart</button>
                    </div>
                    <a>
                </li>
                <?php }?>
            </ul>
        </div>
        </div>
        <?php include('footer.html')?>
        <script>
          function increaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('number').value = value;
}

function decreaseValue() {
  var value = parseInt(document.getElementById('number').value, 10);
  value = isNaN(value) ? 0 : value;
  value < 2 ? value = 1 : '';
  value--;
  document.getElementById('number').value = value;
}
  </script>
</body>

</html>