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

    $result = $connection->query("SELECT * FROM Products");
    
    // Begining of Page
    echo "<!DOCTYPE html><html>";

    // Top Bar
    include "resources/top.php";
    
    // Body
    echo "<h2>Our Products</h2>";

    echo "<table align=center>";

    $newRowCount = 0;
    while($row = mysqli_fetch_array($result)) {
        if ($newRowCount == 0) {
            echo "<tr>";
        }
        $newRowCount++;
        echo "<td><a href=product.php?productid=".$row['pid']."><img src=".$row['imagePath'].'><br>'.$row['name'].
            '</a><br>Price: '.$row['price'].'<br>Color: '.$row['color'].'<br>Material: '.$row['material']."</td>";
        if ($newRowCount == 4) {
            echo "</tr>";
            $newRowCount = 0;
        }
    }
        
    
    echo "</table>";

    include "resources/bottom.php";

    echo "</html>";

    $connection->close();

?>