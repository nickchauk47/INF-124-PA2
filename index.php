<?php

    // CHANGE CONFIG FILE DEPENDING ON MACHINE
    $db = parse_ini_file("resources/dbInfo.ini");

    $connection = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
    /* TEST CONNECTION
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    } 
	echo "Connected successfully";
    */
    $result = $connection->query("SELECT * FROM products");
    
    // Begining of Page
    echo "<!DOCTYPE html><html>";

    // Top Bar
    include "resources/top.php";
    
    // Body
    echo "<h2>Our Products</h2>";

    echo "<table align=center>";

    echo "<h1>RICK AND MORTY FAN STORE</h1>";
    echo "<h3>The #1 online store for all your Rick and Morty gear.</h3>";
    echo "<h4>FREE SHIPPING AND NO SALES TAX ADDED !!!</h4>";
    
    echo "<h2>Our Most Popular Items!!!</h2>";
    echo "<table allign='center'>";
    echo "<tr>";
    for ($i = 0; $i < 4; $i++) {
        $row = mysqli_fetch_array($result);
        echo "<td><a href=product.php?productid=".$row['pid']."><img src=".$row['imagePath'].'><br>'.$row['name'].
            '</a><br>Price: '.$row['price'].'<br>Color: '.$row['color'].'<br>Material: '.$row['material']."</td>";
    }
    echo "</tr>";
    echo "</table>";
    
    echo "<button class='centerbutton' onclick=window.location.href='shop.php'>See ALL Items!</button>";
    
    include "resources/bottom.php";

    echo "</html>";

    $connection->close();
?>