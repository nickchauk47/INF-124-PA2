<?php

    // CHANGE CONFIG FILE DEPENDING ON MACHINE
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

    $result = $connection->query("SELECT * FROM Products");
    
    // Begining of Page
    echo "<!DOCTYPE html><html>";

    // Top Bar
    include "resources/top.php";
    
    // Body
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