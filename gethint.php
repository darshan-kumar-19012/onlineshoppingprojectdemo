<?php 
include('config.php');
$word = $_REQUEST["q"];
$hint = "";
if ($word !== "") {
    $word = strtolower($word);
    $query="SELECT productName FROM `products` WHERE productName LIKE '%".$word."%'" ;
    $result = $con->query($query);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            if ($hint === "") {
                $hint = $row["productName"];
            } else {
                $hint .= "<br><hr>". $row["productName"];
            }
          }
    }
}
echo $hint === "" ? "no suggestion" : $hint;
?>