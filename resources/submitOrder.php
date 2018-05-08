<?php

ob_start();

// Connect to DB
$db = parse_ini_file("dbInfo.ini");
$connection = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);
echo 1;

// Get all product IDs
$productIDs = array();
$result = $connection->query("SELECT * FROM products");
while($row = mysqli_fetch_array($result))
    $productIDs[] = $row['pid'];
echo 2;

// MySQL prepare statements
$orderInFirst = $connection->prepare("INSERT INTO Orders (productid, quantity) VALUES (?, ?)");
$orderInOther = $connection->prepare("INSERT INTO Orders (oid, productid, quantity) VALUES (?, ?, ?)");
$orderInfoIn = $connection->prepare("INSERT INTO OrderInfo (orderid, totalCost, orderDateTime, nameFirst, nameLast, phoneNumber, addrStreet, addrStreet2, addrCity, addrState, addrZip, shippingMethod, nameOnCard, cardNumber, expMonth, expYear, cardCCV) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
echo 3;

// MySQL prepare statements binding
$orderInFirst->bind_param("ii", $pid, $quant);
$orderInOther->bind_param("iii", $oid, $pid, $quant);
$orderInfoIn->bind_param("idsssssssssisissi", $orderid, $totalCost, $orderDateTime, $nameFirst, $nameLast, $phoneNumber, $addrStreet, $addrStreet2, $addrCity, $addrState, $addrZip, $shippingMethod, $nameOnCard, $cardNumber, $expMonth, $expYear, $cardCCV);
echo 4;

// See what they bought
$bought = array();
for ($i = 0 ; $i < count($productIDs) ; $i++) {
    if ( (int)$_POST[(int)$productIDs[$i]] != 0 )
        $bought[$productIDs[$i]] = (int)$_POST[(int)$productIDs[$i]];
}
echo 5;

// Param assignments
$firstCheck = 0;
$total = 0;
foreach ($bought as $key => $val) {
    if ($firstCheck == 0) {
        $pid = (int) $key;
        $quant = (int) $val;

        $res = $connection->query("SELECT * FROM Products WHERE pid=$key");
        $total += ((int) ($res->fetch_object()->price))*$quant;

        $firstCheck++;
        $orderInFirst->execute();
    } else {
        $oid = $connection->insert_id;
        $pid = $key;
        $quant = $val;

        $res = $connection->query("SELECT * FROM Products WHERE pid=$key");
        $total += ((int) ($res->fetch_object()->price))*$quant;

        $orderInOther->execute();
    }
}
echo 6;

// Param assignments (OrderInfo)
$orderid = $connection->insert_id;
$totalCost = $total;
$orderDateTime = date('Y-m-d H:i:s');
$nameFirst = $_POST['firstName'];
$nameLast = $_POST['lastName'];
$phoneNumber = $_POST['phoneNumber'];
$addrStreet = $_POST['street'];
$addrStreet2 = $_POST['addr2'];
$addrCity = $_POST['city'];
$addrState = $_POST['state'];
$addrZip = $_POST['zip'];
$shippingMethod = $_POST['shippingMethod'];
$nameOnCard = $_POST['cardName'];
$cardNumber = $_POST['cardNumber'];
$expMonth = $_POST['exMonth'];
$expYear = $_POST['exYear'];
$cardCCV = $_POST['ccv'];

$orderInfoIn->execute();
echo 7;


$connection->close();

header("Location: ../confirmation.php?order=".$orderid,TRUE,303);

ob_end_flush();
?>
