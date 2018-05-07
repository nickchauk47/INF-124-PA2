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
    
    echo "<script src='resources/validate.js'></script>";
    
    
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
                <select name="state" required>
                    <!-- LOL -->
                    <option value=""></option>
                    <option value="AL">AL</option>
                    <option value="AK">AK</option>
                    <option value="AR">AR</option>
                    <option value="AZ">AZ</option>
                    <option value="CA">CA</option>
                    <option value="CO">CO</option>
                    <option value="CT">CT</option>
                    <option value="DC">DC</option>
                    <option value="DE">DE</option>
                    <option value="FL">FL</option>
                    <option value="GA">GA</option>
                    <option value="HI">HI</option>
                    <option value="IA">IA</option>
                    <option value="ID">ID</option>
                    <option value="IL">IL</option>
                    <option value="IN">IN</option>
                    <option value="KS">KS</option>
                    <option value="KY">KY</option>
                    <option value="LA">LA</option>
                    <option value="MA">MA</option>
                    <option value="MD">MD</option>
                    <option value="ME">ME</option>
                    <option value="MI">MI</option>
                    <option value="MN">MN</option>
                    <option value="MO">MO</option>
                    <option value="MS">MS</option>
                    <option value="MT">MT</option>
                    <option value="NC">NC</option>
                    <option value="NE">NE</option>
                    <option value="NH">NH</option>
                    <option value="NJ">NJ</option>
                    <option value="NM">NM</option>
                    <option value="NV">NV</option>
                    <option value="NY">NY</option>
                    <option value="ND">ND</option>
                    <option value="OH">OH</option>
                    <option value="OK">OK</option>
                    <option value="OR">OR</option>
                    <option value="PA">PA</option>
                    <option value="RI">RI</option>
                    <option value="SC">SC</option>
                    <option value="SD">SD</option>
                    <option value="TN">TN</option>
                    <option value="TX">TX</option>
                    <option value="UT">UT</option>
                    <option value="VT">VT</option>
                    <option value="VA">VA</option>
                    <option value="WA">WA</option>
                    <option value="WI">WI</option>
                    <option value="WV">WV</option>
                    <option value="WY">WY</option>
                    <!-- LMAO -->
                </select><br>
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

    include 'resources/bottom.php';
    
    $connection->close();
?>