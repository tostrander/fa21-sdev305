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

    <table id="pizza-orders" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Size</th>
                <th>Toppings</th>
                <th>Method</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

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
        $date = date("m/d/Y h:ia", strtotime($row['order_date']));
        $size = $row['size'];
        $toppings = $row['toppings'];
        $method = $row['method'];

        echo "
            <tr>
                <td>$order_id</td>
                <td>$fname $lname</td>
                <td>$date</td>
                <td>$size</td>
                <td>$toppings</td>
                <td>$method</td>
                <td><a href='order-details.php?order=$order_id'>view</a></td>
            </tr>";
    }
?>

        </tbody>
        <tfoot>
            <tr>
                <th>Order ID</th>
                <th>Name</th>
                <th>Date</th>
                <th>Size</th>
                <th>Toppings</th>
                <th>Method</th>
                <th></th>
            </tr>
        </tfoot>
    </table>

</div>

<script src="//code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
    $('#pizza-orders').DataTable(
        {
            responsive: true
        }
    );
</script>

</body>
</html>

<!-- Basic table structure
<table>
    <thead>

    </thead>
    <tbody>

    </tbody>
    <tfoot>

    </tfoot>
</table>
-->