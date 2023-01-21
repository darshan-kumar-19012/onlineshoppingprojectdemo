<?php
session_start();
include('config.php');
include('main-header.html');
$search = $_GET['search'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <style>
        .display-items{
            margin-top: 2%;
            width: 100;
        }
        .display-items a{
            text-decoration:none;  
        }
        .display-items a:hover{
            color:blue;
        }
        .display-items ul{
            list-style-type:none;  
        }
        .display-items li{
            display:inline-block;
            width: 22%;
            margin-left: 1%;
            border: 1px solid rgb(235, 235, 238);
        }
        
        .list-inside{
            display: block;
            overflow: hidden;
            margin: 3%;
        }
        .list-inside h3,h4,button{
            font-size: large;
        }
        .list-inside button{
            background-color: #e7e7e7; 
            color: black; 
            border: none;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        .list-inside button:hover{
            opacity: 0.8;
            background-color: blue;
            color:white;
        }
    </style>
</head>

<body>
    <h1 style="margin-left: 4%;">Search Result</h1>
    <div class="display-items">
        <ul>
            <?php
                $ret=mysqli_query($con,"select * from products  WHERE LOWER(productName) LIKE '%$search%'");
                if($row=mysqli_fetch_array($ret)>=2){
                while ($row=mysqli_fetch_array($ret)) 
                {
                ?>
            <li>
                <a style="text-decoration:none; color: black;" onMouseOver="this.style.color='blue'"
                    onMouseOut="this.style.color='black'"
                    href="productdetails.php?pid=<?php echo htmlentities($row['id']);?>">
                    <div class="list-inside">
                        <img src="productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                            data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                            width="258" height="280" alt="">
                        <h3>
                            <?php echo htmlentities($row['productName']);?>
                        </h3>
                        <h4>Rs.
                            <?php echo htmlentities($row['productPrice']);?>
                        </h4>
                        <button>Buy</button>
                    </div>
                </a>
            </li>
            <?php }}else{?>
                <h1 style="margin-left: 8%;">No Result Found</h1>
                <?php } ?>
        </ul>
    </div>
</body>

</html>