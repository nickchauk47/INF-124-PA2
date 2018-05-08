<?php

$db = parse_ini_file("resources/dbInfo.ini");
$connection = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);

include "resources/top.php";


$orderNum = $_GET[order];


$resultOrder = $connection->query("SELECT * FROM orders WHERE oid=$orderNum");
$resultOrderInfo = $connection->query("SELECT * FROM orderinfo WHERE orderid=$orderNum");

$infoRow = mysqli_fetch_array($resultOrderInfo);

echo "<h3> Thank you for your order of: </h3>";
while ($row = mysqli_fetch_array($resultOrder)) {
    $resultProd = $connection->query("SELECT * FROM products WHERE pid=".$row['productid']);
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
