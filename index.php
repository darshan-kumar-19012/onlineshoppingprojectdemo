<?php
session_start();
error_reporting(0);
include('config.php');
include('top-header.php');
include('main-header.html');
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
		
		}else{
			$message="Product ID is invalid";
		}
	}
		echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='cart.php'; </script>";
}
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Home Page</title>
    <link rel="stylesheet" href="css/indexcss.css">
    
    </head>
    <body>        
        <?php include('slideshow.html');?>
        <h1>Smart Phones</h1>
        <div class="display-items">
            <ul>
            <?php
                $ret=mysqli_query($con,"select * from products where category=4 and subCategory=4");
                while ($row=mysqli_fetch_array($ret)) 
                {
                ?>
                <li>
                <a style="text-decoration:none; color: black;"  onMouseOver="this.style.color='blue'"onMouseOut="this.style.color='black'" href="productdetails.php?pid=<?php echo htmlentities($row['id']);?>">
                    <div class="list-inside">
                    <img  src="productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="180" height="300" alt="">
                        <h3><?php echo htmlentities($row['productName']);?></h3>
                        <h4>Rs.<?php echo htmlentities($row['productPrice']);?></h4>
                        <button>Buy</button>
                    </div>
                </a>
                </li>
                <?php }?>
            </ul>
        </div>
        <h1>Laptops</h1>
        <div class="display-items-laptop">
            <ul>
            <?php
                $ret=mysqli_query($con,"select * from products where category=4 and subCategory=6");
                while ($row=mysqli_fetch_array($ret)) 
                {
                ?>
                <li>
                    <a style="text-decoration:none; color: black;" onMouseOver="this.style.color='blue'"onMouseOut="this.style.color='black'" href="productdetails.php?pid=<?php echo htmlentities($row['id']);?>">
                    <div class="list-inside-laptop">
                    <img  src="productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>" data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"  width="320" height="280" alt="">
                        <h3><?php echo htmlentities($row['productName']);?></h3>
                        <h4>Rs.<?php echo htmlentities($row['productPrice']);?></h4>
                        <button>Buy</button>
                    </div>
                    </a>
                </li>
                <?php }?>
            </ul>
        </div>
        <?php include('footer.html')?>
    </body>
</html>
