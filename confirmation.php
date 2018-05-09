<?php

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

include "resources/top.php";


$orderNum = $_GET[order];


$resultOrder = $connection->query("SELECT * FROM Orders WHERE oid=$orderNum");
$resultOrderInfo = $connection->query("SELECT * FROM OrderInfo WHERE orderid=$orderNum");

$infoRow = mysqli_fetch_array($resultOrderInfo);

echo "<h3> Thank you for your order of: </h3>";
while ($row = mysqli_fetch_array($resultOrder)) {
    $resultProd = $connection->query("SELECT * FROM Products WHERE pid=".$row['productid']);
    $prodRow = mysqli_fetch_array($resultProd);
    echo "".$row["quantity"]."  -  ".$prodRow['name']."<br>";
}

echo "Total Cost: $".$infoRow["totalCost"];
echo "<br><br>";


echo "<h3> Your information: </h3>";

echo "<body>";
echo "Order ID: ".$infoRow["orderid"]."<br>";
echo "Order placed date: ".$infoRow["orderDateTime"]."<br>";

echo "First Name: ".$infoRow["nameFirst"]."<br>";
echo "Last Name: ".$infoRow["nameLast"]."<br>";
echo "Phone: ".$infoRow["phoneNumber"]."<br>";
echo "Street 1: ".$infoRow["addrStreet"]."<br>";
echo "Street 2: ".$infoRow["addrStreet2"]."<br>";
echo "City: ".$infoRow["addrCity"]."<br>";
echo "State: ".$infoRow["addrState"]."<br>";
echo "Shipping Method: ".$infoRow["shippingMethod"]." day(s) shipping<br>";

echo "Name on Card: ".$infoRow["nameOnCard"]."<br>";
echo "Card: ************".(substr($infoRow["cardNumber"], -4))."<br></body><br>";

echo "<br><br><br><br><br><br>";
echo "<button class='centerbutton' onclick=window.location.href='shop.php'>Keep Shopping for More!</button>";

include "resources/bottom.php"

?>
