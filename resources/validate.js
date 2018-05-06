function validateForm() {

    //alert("HERE!!!");
    var invFlag = 0;
    var invInfo = "Invalid information: ";
    var phoneRE = /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/;
    var phoneNum = document.forms["orderForm"]["phoneNumber"].value;
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

function luhn(val) {
    var sum = 0;
    for (var i = 0; i < val.length; i++) {
        var intVal = parseInt(val.substr(i, 1));
        if (i % 2 == 0) {
            intVal *= 2;
            if (intVal > 9) {
                intVal = 1 + (intVal % 10);
            }
        }
        sum += intVal;
    }
    return (sum % 10) == 0;
}

function sendMail() {

    //Subject and Body
    var subject = "Rick and Morty Fan Store Reciept";
    var message = "Thank you for ordering with us!\r\n\r\n\r\n Your order:\r\n\r\n";

    //Getting what items were orderd
    var items = ["Morty T-Shirt","Rick T-Shirt","Jerry T-Shirt","Beth T-Shirt","Summer T-Shirt","Mr. Meeseeks T-Shirt","Mr. PoopyButthole T-Shirt","Mr. Meeseeks Onsie","Morty Plush","Rick and Morty Poster","Portal Gun","Pickle Rick"];
    var cost = 0;
    var itemsCount = 0;
    for (var i in items) {
        if (document.forms["orderForm"][items[i]].value > 0) {
            message += "" + document.forms["orderForm"][items[i]].value + "  " + items[i] + "\r\n";
            itemsCount += parseInt(document.forms["orderForm"][items[i]].value);
        }
    }
    if (itemsCount <= 0) {
        alert("You didn't order anything!");
        return false;
    }
    message += "\r\n"
        + "Total: $" + (itemsCount * 15) +".00 USD\r\n\r\n\r\n";

    // Adding form information (personal, shipping, payment)
    //   Shipping
    message += "Shipping Info:\r\n" + document.forms["orderForm"]["firstName"].value + " " + document.forms["orderForm"]["lastName"].value + "\r\n"
        + document.forms["orderForm"]["street"].value + "\r\n";
    if (document.forms["orderForm"]["addr2"].value != "")
        message += document.forms["orderForm"]["addr2"].value + "\r\n";
    message += document.forms["orderForm"]["city"].value + ", " + document.forms["orderForm"]["state"].value + " " + document.forms["orderForm"]["zip"].value + "\r\n";
    message += "Shipping Method Selected - " + document.forms["orderForm"]["shippingMethod"].value + "\r\n\r\n";
    //   Payment
    message += "Payment Info:\r\n";
    message += document.forms["orderForm"]["cardName"].value + "\r\n"
        + "************" + ("" + document.forms["orderForm"]["cardNumber"].value).substr(("" + document.forms["orderForm"]["cardNumber"].value).length - 4) + "\r\n\r\n";
    //   Phone
    message += "We'll contact you at " + document.forms["orderForm"]["phoneNumber"].value + " if there are any issues with your order.";

    //alert("Ready to mail");
    document.location.href = "mailto:?subject="
        + encodeURIComponent(subject)
        + "&body=" + encodeURIComponent(message);
}
