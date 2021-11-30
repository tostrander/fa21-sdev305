<?php

    //Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    /*
    echo "<pre>";
    var_dump($_SERVER);
    echo "</pre>";
    */

    //Make sure the form has been submitted
    //if (!isset($_SERVER['http_referer']))
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        header("location: https://tostrander.greenriverdev.com/305/pizza/");
    }
    //var_dump($_POST);

    //Make sure the request is coming from my website
    if ($_SERVER['http_referer'] != 'https://tostrander.greenriverdev.com/305/pizza/')
    {
        die("Go away, evildoer!");
    }

    //require($_SERVER['HOME'].'db-config.php');

    $page = "Order Confirmation";
    include('includes/header.php');



    /*
    array(6) {
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

        // Validate form data
        $isValid = true;

        // first name
        $fname = "";
        if (!empty($_POST['fname'])) {
            $fname = $_POST['fname'];
        } else {
            echo "<p>Please enter a first name.</p>";
            $isValid = false;
        }

        // last name
        $lname = "";
        if (!empty($_POST['lname'])) {
            $lname = $_POST['lname'];
        } else {
            echo "<p>Please enter a last name.</p>";
            $isValid = false;
        }

        // method
        $method = "";
        $validOptions = array('pickup', 'delivery');
        if (isset($_POST['method'])) {
            if (in_array($_POST['method'], $validOptions)) {
                $method = $_POST['method'];
            } else {
                echo "<p>Go away, evildoer!!</p>";
                $isValid = false;
            }
        } else {
            echo "<p>Please select pickup or delivery.</p>";
            $isValid = false;
        }

        // address (only required for deliveries)
        $address = "";
        if ($method == "delivery") {
            if (!empty($_POST['address'])) {
                $address = nl2br($_POST['address']);
            } else {
                echo "<p>Please enter an address for delivery.</p>";
                $isValid = false;
            }
        }

        // toppings
        $toppings = "";
        $numToppings = 0;
        require('includes/constants.php');
        if (!empty($_POST['toppings']))
        {
            foreach ($_POST['toppings'] as $selectedTopping) {

                //if selected topping is not valid, display an error
                if (!in_array($selectedTopping, TOPPINGS)) {
                    echo "<p>You spoofed me!</p>";
                    $isValid = false;
                }
            }

            $toppings = $isValid ? implode(", ", $_POST['toppings']) : "";
            $numToppings = sizeof($_POST['toppings']);
        }

        // size
        $size = "";
        $validSizes = array('small', 'medium', 'large');
        if (isset($_POST['size'])) {
            if (in_array($_POST['size'], $validSizes)) {
                $size = $_POST['size'];
            } else {
                echo "<p>Invalid size selection.</p>";
                $isValid = false;
            }
        } else {
            echo "<p>Please select a size.</p>";
            $isValid = false;
        }


        //Terminate script if data is not valid
        if (!$isValid) {
            die("<p>Click back to fix any errors.</p>");
        }

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

        //TODO: This needs to be refactored!

        $formData = array('fname'=>$fname, 'lname'=>$lname, 'address'=>$address,
            'size'=>$size, 'toppings'=>$toppings, 'method'=>$method, 'price'=>$price);
        save($formData);

        function save($arr)
        {
            global $cnxn;

            //Escape all single and double quotes to prevent SQL injection
            foreach ($arr as $key=>$value) {

                $arr[$key] = mysqli_real_escape_string($cnxn, $value);
            }

            //Store the order in a database
            $sql = "INSERT INTO pizza (fname, lname, address, size, toppings, method, price) 
            VALUES ('{$arr["fname"]}', 
                    '{$arr["lname"]}', 
                    '{$arr["address"]}', 
                    '{$arr["size"]}', 
                    '{$arr["toppings"]}', 
                    '{$arr["method"]}', 
                    '{$arr["price"]}'
                   )";
            //echo $sql;
            mysqli_query($cnxn, $sql);
        }

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