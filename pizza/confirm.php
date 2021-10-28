<?php
    $page = "Order Confirmation";
    include('includes/header.php');

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
        $fromEmail = "poppaspizza@gmail.com";
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

        //Connect to DB
        require("/home2/tostrand/db-creds.php");
        $cnxn = mysqli_connect($host, $user, $password, $database)
            or die("Error connecting to database");

        /* Create the pizza table
         CREATE TABLE pizza (
            order_id int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            fname VARCHAR(30) NOT NULL,
            lname VARCHAR(30) NOT NULL,
            address VARCHAR(50),
            size VARCHAR(6) NOT NULL,
            toppings VARCHAR(50),
            method VARCHAR(10) NOT NULL,
            price DECIMAL(6, 2) NOT NULL,
            order_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP()
         );
         INSERT INTO pizza (fname, lname, address, size, toppings, method, price)
           VALUES ('Joe', 'Shmo', '123 Elm', 'small', 'pepperoni', 'delivery', 10.60);
        */

        //Store the order in a database
        $sql = "INSERT INTO pizza (fname, lname, address, size, toppings, method, price) 
           VALUES ('$fname', '$lname', '$address', '$size', '$toppings', '$method', $price)";
        mysqli_query($cnxn, $sql);

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
</div>

</body>
</html>