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

    echo "<style>
table,th,td {
  border : 1px solid black;
  border-collapse: collapse;
}
th,td {
  padding: 5px;
}
</style>";

    echo "<script type='text/javascript' src='resources/helper.js'></script>";

    echo "<script src='https://code.jquery.com/jquery-1.12.4.js'></script>
	<script src='https://code.jquery.com/ui/1.12.1/jquery-ui.js'></script>
<script src='script.js'></script>";

echo '<script>
function validateForm() {

    //Getting what items were orderd
    var items = ["1","2","3","4","5","6","7","8","9","10","11","12"];
    var cost = 0;
    var itemsCount = 0;
    for (var i in items) {
        if (document.forms["orderForm"][items[i]].value > 0) {
            itemsCount += parseInt(document.forms["orderForm"][items[i]].value);
        }
    }
    if (itemsCount <= 0) {
        alert("You didn\'t order anything!");
        return false;
    }

    //alert("HERE!!!");
    var invFlag = 0;
    var invInfo = "Invalid information: ";
    var phoneRE = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    var phoneNum = window.document.forms["orderForm"]["phoneNumber"].value;
    if (!phoneRE.test(phoneNum.toString())) {
        //alert("Invalid Phone");
        invInfo += "Phone Number. ";
        invFlag += 1;
    }
    var cardNum = document.forms["orderForm"]["cardNumber"].value;
    if (!validateCardNumber(cardNum)) {
        //alert("Invalid Card");
        invInfo += "Card Number. ";
        invFlag += 1;
    }
    var cardMonth = document.forms["orderForm"]["exMonth"].value;
    var cardYear = document.forms["orderForm"]["exYear"].value;
    var D = new Date();
    if ((D.getFullYear() > parseInt(cardYear)) ||
        ((parseInt(cardMonth) <= (D.getMonth()+1)) && (parseInt(cardYear) <= D.getFullYear()))
       ) {
        //alert("Invalid Exp");
        invInfo += "Card Expiration Date. ";
        invFlag = 1;
    }
    //alert("HERE");
    var cardCCV = document.forms["orderForm"]["ccv"].value;
    //alert(cardCCV);
    if (cardCCV.length != 3) {
        //alert("Invalid CCV");
        invInfo += "Card CCV. ";
        invFlag = 1;
    }
    //alert("Finally!");

    if (invFlag > 0) {
        alert(invInfo);
        return false;
    }

}

function validateCardNumber(number) {
    var regex = new RegExp("^[0-9]{16}$");
    return regex.test(number);

    //return luhn(number);
}
</script>';

    echo '
    <form name="orderForm" method="post" action="resources/submitOrder.php">
    <!-- Select Items -->
    <h3>Select items to purchase</h3>
    <table class="table1" width="100%">';
        while($row = mysqli_fetch_array($result)) {
        if ($newRowCount == 0) {
            echo "<tr>";
        }
        $newRowCount++;
        echo "<td><img src=".$row['imagePath'].">".
                $row['name']."<br>".
                "Cost: ".$row['price']."<br>Quantity:".
                "<input type='number' name='".$row['pid']."' placeholder=0 style='width: 3em' value=0><br>
            </td>";
        if ($newRowCount == 4) {
            echo "</tr>";
            $newRowCount = 0;
        }
    }

    echo '</table>';

    echo '
    <table class="table2" width="750" align="left">
        <tr>
            <td>
            <h3>Personal Information</h3>
                <label>First Name:</label><br>
                <input type="text" name="firstName" value="" required><br>
                <label>Last Name:</label><br>
                <input type="text" name="lastName" value="" required><br>
                <label>Phone Number:</label><br>
                <input type="tel"  name="phoneNumber" value="" required><br>
                <br><br>
            </td>
            <td>
            <h3>Shipping Information</h3>
                <label>Address Line 1:</label><br>
                <input type="text" name="street" placeholder="Street Address" value="" required><br>
                <label>Address Line 2:</label><br>
                <input type="text" name="addr2"
                       placeholder="Apt, suite, unit, building, floor, etc." value=""><br>
                <label>City:</label><br>
                <input type="text" name="city" value="" required><br>
                <label>State:</label><br>
	              <input id="birds" type="text" name="state" required><br>
                <label>Zip:</label><br>
                <input type="number" name="zip" value="" required><br>
                <br>
                <label>Shipping Method</label><br>
                1 Day
                <input type="radio" name="shippingMethod" value="1 Day" required>
                    <br>2 Days
                <input type="radio" name="shippingMethod" value="2 Days">
                    <br>6 Days
                <input type="radio" name="shippingMethod" value="6 Days">
                    <br>
                <br><br>
            </td>
            <td>
            <h3>Payment Information</h3>
                <label>Full name on card:</label>
                <input type="text" name="cardName" required><br>
                <label>Card Number:</label><br>
                <input type="number" name="cardNumber" required><br>
                <label>Expiration:</label><br>
                <select id="exMonth" title="select a month">
                <option value="0">Month</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>

                <select id="exYear" title="select a year">
                <option value="0">Year</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                </select><br>
                <label>CCV:</label><br>
                <input type="number" name="ccv" required>
            </td>
        </tr>

    </table>

    <input class="button" type="submit" name="submit" value="submit" onclick="return validateForm()">
    </form>
    ';

    echo "<br><button class='button' type='button' onclick='loadDoc()'>SHOW SHIPPING RATES</button><br><br><table id='shippingRate'></table>";

    echo "<script>function loadDoc() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          myFunction(this);
        }
      };
      xhttp.open('GET', 'resources/shipping.xml', true);
      xhttp.send();
    }
    function myFunction(xml) {
      var i;
      var xmlDoc = xml.responseXML;
      var table='<tr><th>Type</th><th>Cost</th></tr>';
      var x = xmlDoc.getElementsByTagName('SHIPPING');
      for (i = 0; i <x.length; i++) {
        table += '<tr><td>' +
        x[i].getElementsByTagName('TITLE')[0].childNodes[0].nodeValue +
        '</td><td>' +
        x[i].getElementsByTagName('RATE')[0].childNodes[0].nodeValue +
        '</td></tr>';
      }
      document.getElementById('shippingRate').innerHTML = table;
    }</script>";

    include 'resources/bottom.php';

    $connection->close();
?>
