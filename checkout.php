<?php

include 'config.php';

session_start();


$user_id = $_SESSION['Customer_ID'];

if (!isset($user_id)) {
    header('location:login.php');
}

$message = array(); // Initialize the $message array

if (isset($_POST['order_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $address = mysqli_real_escape_string($conn, $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
    $placed_on =  $_POST['date'];

    $cart_total = 0;
    $cart_products = array();
    $number_of_orders = 0; // Initialize the total quantity

    $cart_query = mysqli_query($conn, "SELECT * FROM shopping_cart WHERE Customer_ID = '$user_id'") or die('query failed');
    if (mysqli_num_rows($cart_query) > 0) {
        while ($cart_item = mysqli_fetch_assoc($cart_query)) {
            $number_of_orders += $cart_item['Quantity']; // Accumulate the quantities
            $cart_products[] = $cart_item['product_name'] . ' (' . $cart_item['Quantity'] . ' x .TK' . $cart_item['Price'] . ')';
            $sub_total = ($cart_item['Price'] * $cart_item['Quantity']);
            $cart_total += $sub_total;
        }
    }

    $total_products = implode(', ', $cart_products);
    $number_of_products = $number_of_orders;

    $order_query = mysqli_query($conn, "SELECT * FROM orders WHERE Customer_Name = '$name' AND number = '$number' AND email = '$email' AND address = '$address'  AND Total_Amount = '$cart_total' AND Booklist = '$total_products' AND No_of_order='$number_of_products'") or die('query failed');

    if ($cart_total == 0) {
        $message[] = 'Your cart is empty';
    } else {
        if (mysqli_num_rows($order_query) > 0) {
            $message[] = 'Order already placed!';
        } else {
            mysqli_query($conn, "INSERT INTO orders(Customer_ID, Customer_Name, number, email, address,Total_Amount,Booklist,No_of_order, Order_Date) VALUES('$user_id', '$name', '$number', '$email', '$address', '$cart_total', '$total_products', '$number_of_products', '$placed_on')") or die('query failed');
            $message[] = 'Order placed successfully!';
            mysqli_query($conn, "DELETE FROM shopping_cart WHERE Customer_ID = '$user_id'") or die('query failed');
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Checkout</h3>
   <p> <a href="home.php">Home</a> / Checkout </p>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM shopping_cart WHERE Customer_ID = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){

            $total_price = ($fetch_cart['Price'] * $fetch_cart['Quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['product_name']; ?> <span>(<?php echo 'TK.'.$fetch_cart['Price'].'/-'.' x '. $fetch_cart['Quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">Your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> Grand total: <span>TK.<?php echo $grand_total; ?></span> </div>

</section>













<section class="checkout">

   <form action="" method="post">
      <h3>Place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Your name:</span>
            <input type="text" name="name" required placeholder="Enter your name">
         </div>
         <div class="inputBox">
            <span>Your number:</span>
            <input type="number" name="number" required placeholder="Enter your number">
         </div>
         <div class="inputBox">
            <span>Your email:</span>
            <input type="email" name="email" required placeholder="Enter your email">
         </div>
        
         <div class="inputBox">
            <span>Street:</span>
            <input type="text" name="street" required placeholder="e.g. Street Name">
         </div>
         <div class="inputBox">
            <span>City:</span>
            <input type="text" name="city" required placeholder="e.g. City Name">
         </div>
         <div class="inputBox">
            <span>State:</span>
            <input type="text" name="state" required placeholder="e.g. State Name">
         </div>
         <div class="inputBox">
            <span>Country:</span>
            <input type="text" name="country" required placeholder="e.g. Country Name">
         </div>
         <div class="inputBox">
         <span>Date:</span>
            <input type="date" name="date" required placeholder="e.g. date">
         </div>
         <div class="inputBox">
            <span>Pin code:</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 123456">
         </div>
      </div>
      <input type="submit" value="Order now" class="btn" name="order_btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>