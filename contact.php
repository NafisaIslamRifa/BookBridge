<?php

include 'config.php';

session_start();

$user_id = $_SESSION['Customer_ID'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `messages` WHERE customer_name = '$name' AND customer_email = '$email' AND customer_num = '$number' AND message = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'message sent already!';
   }else{
      mysqli_query($conn, "INSERT INTO `messages`(customer_id , customer_name, customer_email,  customer_num, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'message sent successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="homes">
<div class="grid text-center" style="--bs-columns: 4; --bs-gap: 10rem; display: flex; justify-content: center;">
    <div class="g-col-2 d-flex flex-column justify-content-center align-items-center" style="width: 800px; height: 400px; padding-top: 50px; padding-bottom: 90px; align-self: center;">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM notification ORDER BY notification_id DESC") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            $fetch_products = mysqli_fetch_assoc($select_products); // Assuming you want to display the first notification's details in the h1 tag
            $details = $fetch_products['details']; // Extract details from the fetched row
        ?>
            <div>
                <h1 style="font-size: 36px; color:orange;"><?php echo $details; ?></h1>
            </div>
            <div class="button" style="padding-top:30px;">
                <a href="shop.php" style="text-decoration: none;">
                    <button class="buttonss" style="padding: 15px 30px; font-size: 20px; border: 1px solid white; border-radius: 20px; background-color: orange; color: white; cursor: pointer; transition: background-color 0.3s, border-color 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        SHOP
                    </button>
                </a>
            </div>
        <?php
        } else {
            echo "No notifications found.";
        }
        ?>
    </div>

    <div class="g-col-2 d-flex justify-content-center align-items-center" style="width: 1000px; height: 800px; align-self: center;"> 
        <img src="uploaded_img/contact.jpg" style="width: 100%; height: 100%; object-fit: cover;"> 
    </div>
</div>

</section>

<section class="contact">

   <form action="" method="post">
      <h3>say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box">
      <input type="email" name="email" required placeholder="enter your email" class="box">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="send message" name="send" class="btn">
   </form>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>