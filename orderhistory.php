<?php 
session_start();
error_reporting(0);
include('config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <style>
            .path  {
                list-style: none;
                float:right;
                font-size: x-large;
                margin-right: 6%;
                color:green;
            }
            .path li{
                display: inline;
            }
            table{
                width:100%;
                border:solid;
            }
            th{
                padding:1%;
                color:white;
                background:black;
            }
            td{
                padding:2%;
            }
            footer{
                margin-top:5%;
            }
        </style>
    </head>
    <body>
    <header>
    <?php include('main-header.html');?>
    </header>
    <ul class="path">
        <li>Home</li>/
        <li>Shopping Cart</li>
    </ul>
    <form name="cart" method="post">	
		<table>
			<thead>
				<tr>
					<th>Image</th>
					<th>Product Name</th>
					<th>Quantity</th>
					<th>Price Per unit</th>
					<th>Shipping Charge</th>
					<th>Grandtotal</th>
					<th>Payment Method</th>
					<th>Order Date</th>
					<th>Action</th>
				</tr>
			</thead>
            <?php $query=mysqli_query($con,"select products.productImage1 as pimg1,products.productName as pname,products.id as proid,orders.productId as opid,orders.quantity as qty,products.productPrice as pprice,products.shippingCharge as shippingcharge,orders.paymentMethod as paym,orders.orderDate as odate,orders.id as orderid from orders join products on orders.productId=products.id where orders.userId='".$_SESSION['id']."' and orders.paymentMethod is not null");
            $cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
				<tr>
					<td><img src="productimages/<?php echo $row['proid'];?>/<?php echo $row['pimg1'];?>" alt="" width="84" height="146"></td>
					<td><h4><?php echo $row['pname'];?></h4></td>
					<td><?php echo $qty=$row['qty']; ?></td>
					<td><?php echo $price=$row['pprice']; ?>  </td>
					<td><?php echo $shippcharge=$row['shippingcharge']; ?>  </td>
					<td><?php echo (($qty*$price)+$shippcharge);?></td>
					<td><?php echo $row['paym']; ?>  </td>
					<td><?php echo $row['odate']; ?>  </td>
					<td><a href="javascript:void(0);" onClick="popUpWindow('track-order.php?oid=<?php echo htmlentities($row['orderid']);?>');" title="Track order">
					Track</td>
				</tr>
            <?php $cnt=$cnt+1;} ?>
				
			</tbody><!-- /tbody -->
		</table>
        </form>
        <footer><?php include('footer.html');?></footer>
        <script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>
</body>
<?php } ?>