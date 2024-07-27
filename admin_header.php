<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar" style="display: flex; justify-content: space-between; align-items: center;">
    <a href="admin_page.php" style="margin-right: 10px; text-decoration: none;">HOME</a>
    <a href="admin_products.php" style="margin-right: 10px; text-decoration: none;">BOOK</a>
    <a href="admin_exchange.php" style="margin-right: 10px; text-decoration: none;">EXCHANGE</a>
    <a href="admin_orders.php" style="margin-right: 10px; text-decoration: none;">ORDERS</a>
    <a href="admin_users.php" style="margin-right: 10px; text-decoration: none;">USERS</a>
    <a href="admin_contacts.php" style="margin-right: 10px; text-decoration: none;">MESSAGES</a>
    <a href="admin_query.php" style="margin-right: 10px; text-decoration: none;">ANALYSIS</a>
    <a href="admin_author_details.php" style="margin-right: 10px; text-decoration: none;">AUTHOR</a>
    <a href="admin_donate.php" style="margin-right: 10px; text-decoration: none;">DONATION</a>

    <a href="admin_request.php" style="text-decoration: none;">
    <button style="background-color: white; margin:0; border:0; height:22px; display:flex; align-items: center;">
        <img style="height:24px;" src="images/book.png" alt="Book Icon">
    </button>
</a>
    
   
    <a href="admin_notification.php" style="text-decoration: none;">
    <button style="background-color: white; margin:0; border:0; height:22px; display:flex; align-items: center;">
        <img style="height:24px;" src="images/bell.png" alt="Bell Icon">
    </button>
</a>

</nav>


      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['Admin_Name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['Admin_Email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
      </div>

   </div>

</header>