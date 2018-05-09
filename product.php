<?php

    // product.php?productid=2 <- product id same as table


    include('resources/dbconfig.php');
    
//    $host = "matt-smith-v4.ics.uci.edu";
//    $name = "inf124db010";
//    $userName = "inf124db010";
//    $pass = "Zfywje!tni~A";
        
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

    // TEST CONNECTION
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } 

    // Get the requested product
    $product = $_GET[productid];
    $result = $connection->query("SELECT * FROM Products WHERE pid=$product");
    $productInfo = mysqli_fetch_array($result); // #productInfo["column name"]

    // Begining of Page
    echo "<!DOCTYPE html><html>";

    // Top Bar
    include "resources/top.php";

    echo "<body>";
    echo "<h1>RICK AND MORTY FAN STORE</h1>";
    echo "<h2>$productInfo[name]</h2><br>";
    echo "<img class=zoom src=$productInfo[imagePath]>";

    echo "<h3>$productInfo[name]</h3>";
    echo "<h4>$ $productInfo[price]<br>Color: $productInfo[color] <br>Material: $productInfo[material]</h4><button class=button onclick=window.location.href='order.php'>Order Now!</button>";
    echo "<p>$productInfo[description]</p>";

    echo "</body>";

    include "resources/bottom.php";

    echo "</html>";


    $connection->close();
?>
