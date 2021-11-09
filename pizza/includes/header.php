<!-- header.html -->

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/styles.css">

    <title>Poppa's Pizza - <?php echo $page ?></title>

    <!--  Favicon  -->
    <link rel="icon" type="image/png" href="images/pizza-favicon.png">

    <!-- Stylesheets -->
    <?php
        if ($page == "Admin Page") {
            echo '<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
                  <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">';
        }
    ?>
</head>
<body>

<!-- Main page content -->
<div class="container" id="main">
    <!-- Page header -->
    <div class="jumbotron">
        <h1 class="display-4">Poppa's Pizza</h1>
        <p class="lead">The best pizza GRC students have ever tasted!</p>
        <!--    <hr class="my-4">-->
        <!--    <p>Free delivery on orders of $25 or more</p>-->
        <!--    <a class="btn btn-primary btn-lg" href="#" role="button">Order Now!</a>-->
    </div>

