<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['Admin_ID'];

if(!isset($admin_id)){
   header('location:login.php');
   exit(); // Ensure to exit after redirecting
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `exchange` WHERE exchange_id  = '$delete_id'") or die('query failed');
   header('location:admin_exchange.php');
   exit(); // Ensure to exit after redirecting
}

if(isset($_POST['update_order'])){
   $exchange_id = $_POST['exchange_id']; // Corrected the input name
   $category = mysqli_real_escape_string($conn, $_POST['category']);

   mysqli_query($conn, "UPDATE `exchange` SET status = '$category' WHERE exchange_id = '$exchange_id'") or die('query failed');
   header('location:admin_exchange.php');
   exit(); // Ensure to exit after redirecting
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Exchange</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">
   <h1 class="title"> Exchange </h1>
   <div class="box-container">
      <?php
         $select_exchanges = mysqli_query($conn, "SELECT * FROM `exchange`") or die('query failed');
         if(mysqli_num_rows($select_exchanges) > 0){
            while($fetch_exchange = mysqli_fetch_assoc($select_exchanges)){
      ?>
      <div class="box">
         <p> User ID: <span><?php echo $fetch_exchange['customer_id']; ?></span> </p>
         <p> Name: <span><?php echo $fetch_exchange['customer_name']; ?></span> </p>
         <p> Exchanged Book Name: <span><?php echo $fetch_exchange['exchanged_book_name']; ?></span> </p>
         <p> Exchanged Book Author Name: <span><?php echo $fetch_exchange['exchanged_book_author']; ?></span> </p>
         <p> Desired Book Name: <span><?php echo $fetch_exchange['desired_book_name']; ?></span> </p>
         <p> Desired Book Author: <span><?php echo $fetch_exchange['desired_book_author']; ?></span> </p>
         
         <img src="uploaded_img/<?php echo $fetch_exchange['exchanged_book_image']; ?>" alt="Book Image" style="width: 200px; height: auto;">
         <form action="" method="post">
            <input type="hidden" name="exchange_id" value="<?php echo $fetch_exchange['exchange_id']; ?>"> <!-- Corrected the input name -->
            <div style="display: flex; font-size: 2rem; align-items: center; justify-content: space-between; padding-top:20px;">
               <label>
                  <input type="radio" name="category" value="Accept" required> Accept
               </label><br>
               <label>
                  <input type="radio" name="category" value="Reject" required> Reject
               </label><br>
            </div>
            <input type="submit" value="Update" name="update_order" class="option-btn">
            <a href="admin_exchange.php?delete=<?php echo $fetch_exchange['exchange_id']; ?>" onclick="return confirm('Delete this exchange?');" class="delete-btn">Delete</a>
         </form>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">No exchanges found!</p>';
         }
      ?>
   </div>
</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
