<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['Admin_ID'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `customer` WHERE Customer_ID = '$delete_id'") or die('query failed');
   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="users">

   <h1 class="title"> user accounts </h1>

   <div class="box-container">
      <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `customer`") or die('query failed');
         while($fetch_users = mysqli_fetch_assoc($select_users)){
      ?>
      <div class="box">
         <p> user id : <span><?php echo $fetch_users['Customer_ID']; ?></span> </p>
         <p> username : <span><?php echo $fetch_users['Customer_Name']; ?></span> </p>
         <p> email : <span><?php echo $fetch_users['Customer_Email']; ?></span> </p>
         <!-- Assuming there's no user_type column in the customer table -->
         <!-- If there's a user_type column, replace 'admin' with $fetch_users['user_type'] -->
         <p> user type : 
            <span style="color:<?php echo ($fetch_users['Customer_ID'] == 1) ? 'var(--orange)' : 'var(--black)'; ?>">
               <?php echo ($fetch_users['Customer_ID'] == 1) ? 'admin' : 'user'; ?>
            </span>
         </p>
         <a href="admin_users.php?delete=<?php echo $fetch_users['Customer_ID']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete user</a>
      </div>
      <?php } ?>
   </div>

</section>

   </div>

</section>

   </div>

</section>









<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>