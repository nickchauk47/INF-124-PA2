<?php
    
    // product.php?productid=2 <- product id same as table


    // CHANGE THIS PART DEPENDING ON THE DB/MACHINE BEING USED
    // (server, username, password, dbname)
    $connection = new mysqli("localhost", "root", "root", "inf124");
    /* TEST CONNECTION
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } 
	echo "Connected successfully";
    */

    // Get the requested product
    $product = $_GET[productid];
    $result = $connection->query("SELECT * FROM products WHERE pid=$product");
    $productInfo = mysqli_fetch_array($result); // #productInfo["column name"]
    
    // Begining of Page
    echo "<!DOCTYPE html><html>";

    // Top Bar
    include "../resources/top.html";
    
    echo "<body>";
    echo "<h1>RICK AND MORTY FAN STORE</h1>";
    echo "<h2>$productInfo[name]</h2><br>";
    echo "<img class=zoom src=$productInfo[imagePath]/>";
    
    echo "<h3>$productInfo[name]</h3>";
    echo "<h4>$ $productInfo[price]<br>Color: $productInfo[color] <br>Material: $productInfo[material]</h4><button class=button onclick=window.location.href='../order.html'>Order Now!</button>";
    echo "<p>$productInfo[description]</p>";

    echo "<p align=center>© Rick and Morty Fan Store 2018</p>";

    echo "</body>";
    echo "</html>";

    // 


    mysql_close($connection);
?>
