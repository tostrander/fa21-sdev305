<?php
    $page = "Home Page";
    include('includes/header.php');
?>

    <!-- Order form -->
    <form id="pizza-form" action="confirm.php" method="post">

        <!--  Contact info  -->
        <fieldset class="form-group border p-2">
            <legend>Contact Information</legend>
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" aria-describedby="first name"
                       placeholder="Enter first name">
                <span class="err" id="err-fname">Please enter first name</span>
            </div>
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" aria-describedby="last name"
                       placeholder="Enter last name">
                <span class="err" id="err-lname">Please enter last name</span>

            </div>
        </fieldset>

        <!-- https://tostrander.greenriverdev.com/305/pizza/confirm.php?fname=Joe&lname=S&method=delivery&address=123+Elm+St&toppings=pepperoni&toppings=sausage&toppings=olives -->

        <!--  Pickup or delivery  -->
        <fieldset class="form-group border p-2">
            <legend>Pickup or Delivery</legend>
            <div class="form-group">
                <div class="radio">
                    <label><input id="pickup" type="radio" name="method" value="pickup" checked> Pickup</label>
                </div>
                <div class="radio">
                    <label><input id="delivery" type="radio" name="method" value="delivery"> Delivery</label>
                </div>
                <span class="err" id="err-method">Please select pickup or delivery</span>
            </div>
            <div id="address-block" class="form-group">
                <label for="address">Address</label>
                <textarea class="form-control" id="address" name="address" aria-describedby="address"
                          rows="5"></textarea>
                <span class="err" id="err-address">Please enter address</span>
            </div>
        </fieldset>

        <!--  Toppings  -->
        <fieldset class="form-group border p-2">
            <legend>Toppings</legend>
            <div class="form-group">
                <label><input type="checkbox" value="pepperoni" name="toppings[]"> Pepperoni</label><br>
                <label><input type="checkbox" value="sausage" name="toppings[]"> Sausage</label><br>
                <label><input type="checkbox" value="olives" name="toppings[]"> Olives</label><br>
                <label><input type="checkbox" value="mushrooms" name="toppings[]"> Mushrooms</label><br>
                <label><input type="checkbox" value="onions" name="toppings[]"> Onions</label><br>
                <label><input type="checkbox" value="pineapple" name="toppings[]"> Pineapple</label>
            </div>
        </fieldset>

        <!--  Pizza size  -->
        <fieldset class="form-group border p-2">
            <legend>Pizza Size</legend>
            <div class="form-group">
                <select class="form-control" id="size" name="size">
                    <option value="none">Select a Size</option>
                    <option value="small">Small</option>
                    <option value="medium">Medium</option>
                    <option value="large">Large</option>
                </select>
                <span class="err" id="err-size">Please select a size</span>
            </div>
        </fieldset>

        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="scripts/pizza.js"></script>
</body>
</html>