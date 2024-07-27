<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['Admin_ID'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `request` WHERE req_id = '$delete_id'") or die('query failed');
   header('location:admin_request.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Requests</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">requests</h1>

   <div class="box-container">
   <?php
      $select_request = mysqli_query($conn, "SELECT * FROM `request`") or die('query failed');
      if(mysqli_num_rows($select_request) > 0){
         while($fetch_request = mysqli_fetch_assoc($select_request)){
      
   ?>
   <div class="box">
      <p> Request ID: <span><?php echo $fetch_request['req_id']; ?></span> </p>
      <p> Customer ID: <span><?php echo $fetch_request['customer_id']; ?></span> </p>
      <p> Customer Name: <span><?php echo $fetch_request['customer_name']; ?></span> </p>
      <p> Book Name: <span><?php echo $fetch_request['book_name']; ?></span> </p>
      <p> Author Name: <span><?php echo $fetch_request['author_name']; ?></span> </p>
      <p> Publication Year: <span><?php echo $fetch_request['publication_year']; ?></span> </p>
      <a href="admin_request.php?delete=<?php echo $fetch_request['req_id']; ?>" onclick="return confirm('Delete this request?');" class="delete-btn">Delete Request</a>
   </div>
   <?php
      };
   }else{
      echo '<p class="empty">You have no requests!</p>';
   }
   ?>
   </div>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
