<?php

include 'config.php';

session_start();

$user_id = $_SESSION['Customer_ID'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">home</a> / about </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/new.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>Choose UIU Book Shop for a diverse selection, top-notch quality, expert guidance, a vibrant community, and a convenient shopping experience. Your journey in literature and learning begins with us!</p>
         <p>Your premier choice for a diverse selection, quality materials, expert guidance, a vibrant community, and a hassle-free shopping experience</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.jpg" alt="">
         <p>UIU Book Shop is my absolute favorite! The staff's recommendations are spot-on, and their diverse selection caters to all my reading needs. A welcoming atmosphere and excellent service make every visit a pleasure.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Harry Potter</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.jpg" alt="">
         <p>Convenience and quality - that's what UIU Book Shop delivers. The easy-to-navigate layout and friendly staff make every visit enjoyable. I never shop for books anywhere else.It is a good website where we can get all study staffs</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Hermione Granger</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.jpg" alt="">
         <p>UIU Book Shop's expert guidance helped me discover hidden gems I wouldn't have found elsewhere. It's the perfect blend of personalized service and a fantastic selection. Highly recommended.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Luna Lovegood</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>Convenience and quality - that's what UIU Book Shop delivers. The easy-to-navigate layout and friendly staff make every visit enjoyable. I never shop for books anywhere else.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Irin Holmes</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>UIU Book Shop is more than just a store; it's a community. I've attended insightful book discussions and made connections with fellow readers.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Jonathon Jeorge</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>Convenience and quality - that's what UIU Book Shop delivers. The easy-to-navigate layout and friendly staff make every visit enjoyable. I never shop for books anywhere else.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Fred Maxwell</h3>
      </div>

   </div>

</section>

<section class="authors">

   <h1 class="title">GREAT AUTHORS</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/author-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <a href="authors.php"><span style="font-size: 30px; color: orange">Humayun Ahmed</span></a>
      </div>

      <div class="box">
         <img src="images/author-2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <a href="authors.php"><span style="font-size: 30px; color: orange">Sattyajit Roy</span></a>
      </div>

      <div class="box">
         <img src="images/author-3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <a href="authors.php"><span style="font-size: 30px;color: orange">Kazi Nazrul Islam</span></a>
      </div>

      <div class="box">
         <img src="images/author-4.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <a href="authors.php"><span style="font-size: 30px; color: orange">Rabindranath Tagore</span></a>
      </div>

      <div class="box">
         <img src="images/author-5.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <a href="authors.php"><span style="font-size: 30px;color: orange">William Shakespeare</span></a>
      </div>

      <div class="box">
         <img src="images/author-6.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="fab fa-linkedin"></a>
         </div>
         <a href="authors.php"><span style="font-size: 30px;color: orange">Arthur Conan Doyle</span></a>
      </div>

   </div>

</section>







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>