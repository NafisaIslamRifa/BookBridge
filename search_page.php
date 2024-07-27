<?php

include 'config.php';

session_start();

$user_id = $_SESSION['Customer_ID'];

if(!isset($user_id)){
   header('location:login.php');
};
if (isset($_POST['name'])) {
   $name = mysqli_real_escape_string($conn, $_POST['product_name']);  // assuming 'name' is the Book_Title in the form
   $select_users = mysqli_query($conn, "SELECT * FROM `book` WHERE Book_Title = '$name' ") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
       $row = mysqli_fetch_assoc($select_users);
       $_SESSION['Book_Id'] = $row['Book_Id'];
       header('location:book_details.php');
       exit();
   }
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `shopping_cart` WHERE product_name = '$product_name' AND Customer_ID  = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `shopping_cart`(Customer_ID , Quantity,Price, Image_URL,product_name) VALUES('$user_id','$product_quantity','$product_price', '$product_image','$product_name')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="homes">


</section>

<section class="search-form">
  
</section>

<section class="products" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];
         $select_products = mysqli_query($conn, "SELECT Book_Title, Book_Price, Book_Image FROM `book` WHERE Book_Title LIKE '$search_item%' UNION SELECT ac_Book_Title AS Book_Title, ac_Book_Price AS Book_Price, ac_Book_Image AS Book_Image FROM `academic_book` WHERE ac_Book_Title LIKE '$search_item%'") or die('query failed');
         
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['Book_Image']; ?>" alt="">
      
      <button type="submit" name="name" value="<?php echo $fetch_products['Book_Title']; ?>" class="name" style="background-color: white; padding: 10px; border-radius: 5px; cursor: pointer; border: none;">
                <?php echo $fetch_products['Book_Title']; ?>
            </button>

      <div class="price">TK.<?php echo $fetch_products['Book_Price']; ?>/-</div>
      
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['Book_Title']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['Book_Price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['Book_Image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
   </form>
   <?php
            }
         } else {
            echo '<p class="empty">no result found!</p>';
         }
      } else {
         echo '<p class="empty">search something!</p>';
      }
   ?>
   </div>
  
</section>










<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>