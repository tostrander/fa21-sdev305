<?php

    //LAMP Stack:  Linux, Apache, MySQL, PHP

    //Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $page = "Admin Page";
    include('includes/header.php');

    //Connect to DB
    require("/home2/tostrand/db-creds.php");
    $cnxn = mysqli_connect($host, $user, $password, $database)
            or die("Error connecting to database");
?>

    <h2>Admin Page</h2>
    <pre>
<?php
    //Display pizza orders
    $sql = "SELECT * FROM pizza ORDER BY order_date DESC";
    $result = mysqli_query($cnxn, $sql);
    //var_dump($result);

    /*
     * array(9) {
      ["order_id"]=>string(2) "17"
      ["fname"]=>string(7) "Yasaira"
      ["lname"]=>string(7) "Reynoso"
      ["address"]=>string(0) ""
      ["size"]=>string(5) "small"
      ["toppings"]=>string(7) "sausage"
      ["method"]=>string(6) "pickup"
      ["price"]=>string(5) "11.18"
      ["order_date"]=>string(19) "2021-10-28 13:18:12"
    }
     */
    foreach($result as $row) {
        //var_dump($row);
        $order_id = $row['order_id'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $date = date("m/d/Y h:ma", strtotime($row['order_date']));
        echo "<p>$order_id - $fname $lname, $date</p>";
    }

?>
    </pre>
</div>

</body>
</html>