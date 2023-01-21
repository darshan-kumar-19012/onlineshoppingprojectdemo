<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <style>
        .header-nav{
            list-style-type:none; 
            background: #C33764;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #1D2671, #C33764);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #1D2671, #C33764); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

            margin-bottom:1%;
            margin-left:-2%;
            margin-right:-3%;
            margin-top:-2%;
            padding: 2%;
        }
        .header-nav a{
            text-decoration: none;
            font-size: x-large;
            color: white;
        }
        .header-nav li{
            display:inline-block;
            width: 10%;
        }
        .header-nav a:hover{
            color:blue;
        }
        .ordertrack{
            float: right;
            border-style: solid;
            color: white;
            margin-right:1%;
            margin-top: -0.6%;
            padding: 10px 20px;
            text-align:center;
        }
    </style>
</head>

<body>
    <div class="header-nav">
        <ul>
        <li><a href="#"></a></li>
        <li style="margin-left:-10.5%;"><a href="http://localhost:8080/shopping/admin-login.html">Admin</a></li>
        <li><a href="http://localhost:8080/shopping/my-account.jsp">Account</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li style="margin-left:-2%;"><a href="about.xml">About</a><li>
        <?php if(strlen($_SESSION['login'])==0)
        {   ?>
        <li style="margin-left:-10%;"><a href="login.php">Login</a></li>
        <?php }
        else{ ?>
        <li style="margin-left:-10%;"><a href="logout.php">Logout</a></li>
        <?php } ?>
        <li class="ordertrack">
            <a href="orderhistory.php">Track Order</a>	
        </li>
        </ul>
    </div>
</body>
</html>