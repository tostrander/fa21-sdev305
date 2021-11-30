<?php
    /*
     * order-details.php?order=3
     *
     */

    //Turn on error reporting
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    //Redirect to Admin page if order ID is missing from URL
    if (!isset($_GET['order'])) {
        header ("location: admin.php");
    }

    $page = "Admin Page";
    include('includes/header.php');

    //Connect to DB
    require("/home2/tostrand/db-creds.php");
    $cnxn = mysqli_connect($host, $user, $password, $database)
    or die("Error connecting to database");

?>
    <h2>Admin Page</h2>
    <h3>Order Details</h3>

<?php

    $order_id = $_GET['order'];

    //Display pizza orders
    $sql = "SELECT * FROM pizza WHERE order_id = $order_id";
    $result = mysqli_query($cnxn, $sql);

    //Make sure we got a result back
    if (mysqli_num_rows($result) == 0) {
        die ("<p>Order not found.</p>");
    }

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //var_dump($row);

    $order_id = $row['order_id'];
    $fname = $row['fname'];
    $lname = $row['lname'];
    $date = date("m/d/Y h:ma", strtotime($row['order_date']));
    $size = $row['size'];
    $toppings = $row['toppings'];
    $method = $row['method'];

    echo "<p>Order ID: $order_id</p>";
    echo "<p>Name: $fname $lname</p>";
    echo "<p>Date: $date</p>";
    echo "<p>Size: $size</p>";
    echo "<p>Toppings: $toppings</p>";

?>

</div>

<script src="//code.jquery.com/jquery-3.5.1.js"></script>

</body>
</html>
