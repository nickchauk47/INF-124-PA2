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
    $result = $connection->query("SELECT * FROM products");
    
    // Begining of Page
    echo "<!DOCTYPE html><html>";

    // Top Bar
    include "resources/top.html";
    
    // Body
    echo "<h2>Our Products</h2>";

    echo "<table align=center>";

    $newRowCount = 0;
    while($row = mysqli_fetch_array($result)) {
        if ($newRowCount == 0) {
            echo "<tr>";
        }
        $newRowCount++;
        echo "<td><a href=".$row['imagePath']."><img src=".$row['imagePath'].'><br>'.$row['name'].
            '</a><br>Price: '.$row['price'].'<br>Color: '.$row['color'].'<br>Material: '.$row['material']."</td>";
        if ($newRowCount == 4) {
            echo "</tr>";
            $newRowCount = 0;
        }
    }
        
    
    echo "</table>";



    echo "</html>";

?>