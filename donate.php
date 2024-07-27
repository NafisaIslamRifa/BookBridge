<?php

include 'config.php';

session_start();

$user_id = $_SESSION['Customer_ID'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $book_name = mysqli_real_escape_string($conn, $_POST['bookName']);
$author_name = mysqli_real_escape_string($conn, $_POST['authorName']);
$book_condition = mysqli_real_escape_string($conn, $_POST['book_condition']); 


$image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
 
    
   $select_product = mysqli_query($conn, "SELECT * FROM `donation` WHERE customer_name = '$name' AND book_name = '$book_name' AND author_name = '$author_name' AND book_condition = '$book_condition'") or die('query failed');

    if(mysqli_num_rows($select_product) > 0){
       $message[] = 'donated already!';
    }else{
        $add_product=mysqli_query($conn, "INSERT INTO `donation`(customer_id ,customer_name,book_name,author_name,book_condition,book_image) VALUES('$user_id','$name','$book_name','$author_name','$book_condition','$image')") or die('query failed');
        if($add_product){
            if($image_size > 2000000){
               $message[] = 'image size is too large';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'donated successfully!';
            }
         }else{
            $message[] = 'product could not be added!';
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
   <title>donate</title>

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
            <div class="button" style="padding-top:30px;padding-right:22px;">
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
        <img src="uploaded_img/donation_new.png" style="width: 100%; height: 100%; object-fit: cover;"> 
    </div>
</div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/donate.png" alt="">
      </div>

      <div class="content">
         <h3>Why Donate Book?</h3>
         <p>Donating books to BookBridge promotes literacy, education, and access to knowledge, especially in underserved communities. It fosters a culture of sharing and learning, contributing to personal growth and community development. By donating, individuals make a tangible impact on improving educational opportunities and empowering others to thrive. Additionally, it reduces waste by giving books a new life and promotes environmental sustainability.</p>
         <p>Through BookBridge, donated books find new homes where they are cherished, enriching lives and inspiring minds. Each donation is a step towards creating a more equitable world, where everyone has the chance to learn and grow.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>


<section class="show-products" style="display: flex; flex-wrap: wrap; justify-content: center;">
    <h1 class="title" style="width: 100%; text-align: center; margin-bottom: 20px;">Donated Books</h1>

    <div class="box-container" style="width: 800px; display: flex; flex-wrap: wrap; ">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `donation` where status='accept' ") or die('query failed');
        if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
        ?>
        <div class="box" style="width: calc(33.33% - 20px); margin: 10px; text-align: center; border: 2px solid #ddd; padding: 10px; border-radius: 10px; background-color: #f9f9f9;">
            <img src="uploaded_img/<?php echo $fetch_products['book_image']; ?>" alt="" style="max-width: 100%; height: auto; border-radius: 5px;">
            <div class="name" style="padding-top: 10px; font-size:23px ;"><?php echo $fetch_products['book_name']; ?></div>
        </div>
        <?php
            }
        }else{
            echo '<p class="empty" style="text-align: center;">No products added yet!</p>';
        }
        ?>
    </div>
</section>








<section class="contact">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Donate Book</h3>
        <input type="text" name="name" required placeholder="enter your name" class="box">
        <input type="text" name="bookName" required placeholder="Enter Book Name" class="box">
        <input type="text" name="authorName" required placeholder="Enter Author Name" class="box">
        <input type="text" name="book_condition" required placeholder="Enter Book Condition" class="box"> <!-- Corrected input name -->
        <input type="file" name="image" required class="box"> 
        <input type="submit" value="Upload" name="send" class="btn"> 
    </form>
</section>


<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>