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
<!DOCTYPE html>
<html lang="en">
<head>
   <title>BOOKBRIDGE</title>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/style.css">

   <!-- Add the FontAwesome CDN link here if not already added -->
</head>
<body>

<div class="headers">
   <div class="left-section"> 
      <p class="logo">BOOKBRIDGE</p> 
   </div>

   <div class="middle-section">
      <form action="search_page.php" method="post" onsubmit="return validateSearch()" style="flex: 1; margin-left: 60px; margin-right: 65px; max-width: 800px; display: flex; align-items: center;">
         <input class="search-bar" type="text" id="searchInput" name="search" placeholder="Search your book" style="flex: 1; height: 50px; border: 2px solid #ccc; padding-left: 10px; font-size: 16px; border-radius: 5px;">
         <button type="submit" class="search-button" name="submit" style="height: 50px; width: 50px; background-color: white; border: 2px solid #ccc; margin-left: -2px; border-radius: 0 5px 5px 0;">
            <img class="search-icon" src="images/search-icon-2048x2048-cmujl7en.png" style="width: 25px; height: 25px;">
         </button>
      </form>

      <script>
         function validateSearch() {
            var searchInput = document.getElementById("searchInput").value.trim();
            if (searchInput === "") {
               alert("Please enter a search term.");
               return false; // Prevent form submission
            }
            return true; // Allow form submission
         }
      </script>
   </div>
   
   <div class="right-section">

   <div class="notification">
   <form action="notification.php" method="post">
    <button class="notifications" style="background-color: white; margin:0; border:0; height:22px; display:flex; align-items: center;" onmouseover="this.style.backgroundColor='orange'" onmouseout="this.style.backgroundColor='white'" onclick="fetchNotificationCount()">
        <img class="noti-image" style="height:24px;" src="images/bell.png">
        <span class="notification-count" style="margin-left: 2px; font-size: 20px;" id="notificationCount">
            <?php
            // Your PHP code to fetch notification count from the database and echo it here
            $query = mysqli_query($conn, "SELECT COUNT(*) AS total_rows FROM notification where is_read=0") or die('query failed');
            $row = mysqli_fetch_assoc($query);
            $notification_count = $row['total_rows']; // Get notification count
            echo $notification_count;
            ?>
        </span>
    </button>
   </form>
</div>

<script>
    function fetchNotificationCount() {
        // Use AJAX to fetch the notification count from the server without page reload
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("notificationCount").innerText = this.responseText;
            }
        };
        xhttp.open("GET", "fetch_notification_count.php", true); // Create a separate PHP script to fetch the count
        xhttp.send();
    }
</script>



      <div class="dropdown">
         <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; margin:0; border:0; width:20px; display:flex; align-items: center;">
            <img src="images/user.png" class="profile-icon" style="height:22px;">
         </button>
         <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="profile.php"><h4>Profile</h4></a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php"><h4>Logout</h4></a></li>
         </ul>
      </div>

      <div class="icons">
   <?php
      $select_cart_number = mysqli_query($conn, "SELECT * FROM `shopping_cart` WHERE Customer_ID = '$user_id'") or die('query failed');
      $cart_rows_number = mysqli_num_rows($select_cart_number); 
   ?>
   <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span > (<?php echo  $cart_rows_number; ?>)</span> </a>
</div>

   </div>
</div>

<!-- Bootstrap navbar -->
<div class="container-fluid" style="box-shadow: 0 .125rem .25rem rgba(0, 0, 0, 0.095);margin-top: 15px;">
  <div class="row">
    <div class="col">
      <ul class="nav justify-content-center" style="font-family: 'Rubik', sans-serif;font-size: 18px; background-color: white;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php" >HOME</a>
        </li>
      </ul>
    </div>
    <div class="col">
      <ul class="nav justify-content-center" style="font-size: 18px; background-color: white;">
        <li class="nav-item">
          <a class="nav-link" href="shop.php" >BOOK</a>
        </li>
      </ul>
    </div>
    <div class="col">
      <ul class="nav justify-content-center" style="font-size: 18px; background-color: white;">
        <li class="nav-item">
          <a class="nav-link" href="ebook.php" >EBOOK</a>
        </li>
      </ul>
    </div>
    <div class="col">
      <ul class="nav justify-content-center" style="font-size: 18px; background-color: white;">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
            CATEGORY
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="Academic.php" style=" font-size:14px;">ACADEMIC</a></li>
            <li><a class="dropdown-item" href="science-fiction.php" style="font-size:14px;">SCIENCE FICTION</a></li>
            <li><a class="dropdown-item" href="literature.php" style="font-size:14px;">LITERATURE</a></li>
            <li><a class="dropdown-item" href="kids.php" style="font-size:14px;">KIDS BOOK</a></li>
            <li><a class="dropdown-item" href="Religious.php" style="font-size:14px;">RELIGIOUS BOOK</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="col">
      <ul class="nav justify-content-center" style="font-size: 18px; background-color: white;">
        <li class="nav-item">
          <a class="nav-link" href="authors.php" >AUTHOR</a>
        </li>
      </ul>
    </div>
    <div class="col">
      <ul class="nav justify-content-center" style="font-size: 18px; background-color: white;">
        <li class="nav-item">
          <a class="nav-link" href="donate.php" >DONATION</a>
        </li>
      </ul>
    </div>
    <div class="col">
      <ul class="nav justify-content-center" style="font-size: 18px; background-color: white;">
        <li class="nav-item">
          <a class="nav-link" href="exchange.php" >EXCHANGE</a>
        </li>
      </ul>
    </div>
    <div class="col">
      <ul class="nav justify-content-center" style="font-size: 18px; background-color: white;">
        <li class="nav-item">
          <a class="nav-link" href="contact.php" >CONTACT</a>
        </li>
      </ul>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="js/header.js"></script>
</body>
</html>
