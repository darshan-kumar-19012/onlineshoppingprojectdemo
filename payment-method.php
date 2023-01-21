<?php 
session_start();
error_reporting(0);
include('config.php');
include('main-header.html');
if(strlen($_SESSION['login'])==0)
    {   
    header('location:login.php');
}
else{
	if (isset($_POST['submit'])) {
		mysqli_query($con,"update orders set 	paymentMethod='".$_POST['paymethod']."' where userId='".$_SESSION['id']."' and paymentMethod is null ");
		unset($_SESSION['cart']);
		header('location:orderhistory.php');
	}
?>
<html>
    </html>
    <head>
        <style>
            .pay  {
                list-style: none;
                float:right;
                font-size: x-large;
                margin-right: 6%;
                color:green;
            }
            .pay li{
                display: inline;
            }
            h2{
                display: block;
                text-align: center;
                margin-top: 4%;;
                color: white;
                background-color: rgb(120, 119, 119);
                padding: 1%;
                margin-left: 5%;
                margin-right: 5%;
            }
            h4{
                font-weight: 500;
                font-size: x-large;
                margin-left: 6%;
            }
            .choose-pay form{
                margin-left: 7%;
            }
            .choose-pay input{
                padding:1%;
                background-color:rgb(120, 119, 119);
                color: white;
                border: none;
                padding-left: 2%;
                padding-right: 2%;
                margin-top: 1%;
            }
            footer{
                margin-top:5%;
            }
        </style>
    </head>
    <body>
    <ul class="pay">
        <li>Home</li>/
        <li>Payment Method</li>
        </ul>
    <h2>Choose Payment Method</h2>
    <h4>Select your Payment Method</h4>
    <div class="choose-pay">
            <form name="payment" method="post">
            <input type="radio" name="paymethod" value="COD" checked="checked"> COD
             <input type="radio" name="paymethod" value="Internet Banking"> Internet Banking
             <input type="radio" name="paymethod" value="Debit / Credit card"> Debit / Credit card <br><br>
             <input type="submit" value="submit" name="submit" class="btn btn-primary">
            </form>		
        </div>
    <footer><?php include('footer.html');?></footer>
</body>
<?php } ?>