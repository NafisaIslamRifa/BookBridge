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
   mysqli_query($conn, "DELETE FROM `donation` WHERE donation_id  = '$delete_id'") or die('query failed');
   header('location:admin_donate.php');
   exit(); // Ensure to exit after redirecting
}

if(isset($_POST['update_order'])){
   $donation_id = $_POST['donation_id'];
   $category = mysqli_real_escape_string($conn, $_POST['category']);

   mysqli_query($conn, "UPDATE `donation` SET status = '$category' WHERE donation_id = '$donation_id'") or die('query failed');
   header('location:admin_donate.php');
   exit(); // Ensure to exit after redirecting
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Donations</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">
      <h1 class="title"> Donations </h1>
      <div class="box-container">
         <?php
            $select_donations = mysqli_query($conn, "SELECT * FROM `donation`") or die('query failed');
            if(mysqli_num_rows($select_donations) > 0){
               while($fetch_donation = mysqli_fetch_assoc($select_donations)){
         ?>
         <div class="box">
            <p> User ID: <span><?php echo $fetch_donation['customer_id']; ?></span> </p>
            <p> Name: <span><?php echo $fetch_donation['customer_name']; ?></span> </p>
            <p> Book Name: <span><?php echo $fetch_donation['book_name']; ?></span> </p>
            <p> Author Name: <span><?php echo $fetch_donation['author_name']; ?></span> </p>

            <img src="uploaded_img/<?php echo $fetch_donation['book_image']; ?>" alt="Book Image" style="width: 200px; height: auto;"> <!-- Inline CSS for fixing image size -->
            <form action="" method="post">
               <input type="hidden" name="donation_id" value="<?php echo $fetch_donation['donation_id']; ?>">
               <div style="display: flex;font-size: 2rem; align-items: center; justify-content: space-between; padding-top:20px;">
                  <label>
                     <input type="radio" name="category" value="Accept" required> Accept
                  </label><br>
                  <label>
                     <input type="radio" name="category" value="Reject" required> Reject
                  </label><br>
               </div>
               
               <input type="submit" value="Update" name="update_order" class="option-btn" >
               <a href="admin_donate.php?delete=<?php echo $fetch_donation['donation_id']; ?>" onclick="return confirm('Delete this donation?');" class="delete-btn">Delete</a>
              
            </form>
         </div>
         <?php
               }
            } else {
               echo '<p class="empty">No donations found!</p>';
            }
         ?>
      </div>
   </section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>
