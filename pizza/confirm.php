<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Poppa's Pizza</title>
</head>
<body>
    <!-- Page header -->
    <div class="jumbotron">
        <h1 class="display-4">Poppa's Pizza</h1>
        <p class="lead">The best pizza GRC students have ever tasted!</p>
        <!--    <hr class="my-4">-->
        <!--    <p>Free delivery on orders of $25 or more</p>-->
        <!--    <a class="btn btn-primary btn-lg" href="#" role="button">Order Now!</a>-->
    </div>

    <?php

        //Turn on error reporting
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        /*
        echo "<pre>";
        var_dump($_POST);
        echo "</pre>";
        */

        /*
         * array(6) {
              ["fname"]=>string(7) "Jacques"
              ["lname"]=>string(8) "Cousteau"
              ["method"]=>string(8) "delivery"
              ["address"]=>string(55) "32510 108th Avenue SE
                    Underwater, Atlantis
                    32423-3242"
              ["toppings"]=>
                  array(3) {
                    [0]=>
                    string(9) "pepperoni"
                    [1]=>
                    string(7) "sausage"
                    [2]=>
                    string(6) "olives"
                  }
              ["size"]=>string(5) "large"
            }
         */

        //Define a constant for sales tax rate
        define("TAX_RATE", 0.065);
        define("TOPPING_PRICE", 0.50);

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $method = $_POST['method'];
        $address = nl2br($_POST['address']);

        $toppings = "";
        $numToppings = 0;
        if (!empty($_POST['toppings']))
        {
            $toppings = implode(", ", $_POST['toppings']);
            $numToppings = sizeof($_POST['toppings']);
        }

        $size = $_POST['size'];


        //Validate form data



        /* Calculate price of pizza
         * Base price:
         * Small - $10.00
         * Medium - $15.00
         * Large - $20.00
         * Toppings - 0.50 each
         * Sales tax, 0.065
         */
        if ($size == "small") {
            $price = 10.00;
        } elseif ($size == "medium") {
            $price = 15.00;
        } else {
            $price = 20.00;
        }

        //Add cost of toppings
        $price += $numToppings * TOPPING_PRICE;

        //Add sales tax
        $price += $price * TAX_RATE;
        $price = number_format($price, 2);

        //Send an email to Poppa
        $toEmail = "tostrander@greenriver.edu"; //YOUR address here
        $fromName = "Tina";
        $fromEmail = "tostrander@greenriver.edu";
        $subject = "New Order";
        $headers = "From: $fromName <$fromEmail>";

        $message = "A new order has been placed.\n";
        $message .= "Name: $fname $lname\n";
        $message .=  "Method: $method\n";
        $message .=  "Address: $address\n";
        $message .=  "Toppings: $toppings\n";
        $message .=  "Size: $size\n";
        $message .=  "Total Price: $$price";

        $success = mail($toEmail, $subject, $message, $headers);
        if(!$success) {
            echo "<p>There was a problem... Please call us.</p>";
        }



        //Store the order in a database


        //Display order summary for customer, including total price
        echo "<h1>Thank you for your order, $fname!!</h1>";
        echo "<h2>Order Summary</h2>";
        echo "<p>Name: $fname $lname</p>";
        echo "<p>Method: $method</p>";
        echo "<p>Address: $address</p>";
        echo "<p>Toppings: $toppings</p>";
        echo "<p>Size: $size</p>";
        echo "<p>Total Price: $$price</p>";


    ?>


</body>
</html>