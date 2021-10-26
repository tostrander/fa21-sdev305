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

        define("TAX_RATE", 0.065);
        $price = 10.00 * TAX_RATE;

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $method = $_POST['method'];
        $address = nl2br($_POST['address']);
        $toppings = implode(", ", $_POST['toppings']);
        $size = $_POST['size'];

        $numToppings = sizeof($_POST['toppings']);

        if ($numToppings <= 1) {
            $basePrice = 10.00;
        } else {
            $basePrice = 15.00;
        }

        $basePrice = $numToppings <= 1 ? 10.00 : 15.00;
        echo $numToppings <= 1 ? 10.00 : 15.00;
        echo "<pre>";
        //var_dump($_SERVER);
        echo "</pre>";

        echo "<h1>Thank you for your order, $fname!!</h1>";
        echo "<h2>Order Summary</h2>";
        echo "<p>Name: $fname $lname</p>";
        echo "<p>Method: $method</p>";
        echo "<p>Address: $address</p>";
        echo "<p>Toppings: $toppings</p>";
        echo "<p>Size: $size</p>";
    ?>


</body>
</html>