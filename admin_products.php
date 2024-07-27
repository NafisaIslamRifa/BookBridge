<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['Admin_ID'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){
   $book_id=$_POST['book_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $book_date= $_POST['book_date'];
   $author_id=$_POST['Author_id'];
   $category = mysqli_real_escape_string($conn, $_POST['category']); // Retrieve category from form
   $details = mysqli_real_escape_string($conn, $_POST['details']); // Retrieve details from form

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT Book_Title FROM `book` WHERE Book_Title = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `book`(Book_Id, Book_Title, category, Publication_Year, Book_details, Book_Price, Author_Id, Book_Image) VALUES('$book_id', '$name', '$category', '$book_date', '$details', '$price', '$author_id', '$image')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT Book_Image FROM `book` WHERE Book_Id  = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['Book_Image']);
   mysqli_query($conn, "DELETE FROM `book` WHERE  Book_Id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `book` SET Book_Title = '$update_name', Book_Price = '$update_price' WHERE Book_Id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `book` SET Book_Image = '$update_image' WHERE Book_Id  = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom admin css file link  -->
   
   <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
   <?php include 'admin_header.php'; ?>
   <!-- product CRUD section starts  -->
   <section class="add-products">
      <h1 class="title">ADD BOOK</h1>
      <form action="" method="post" enctype="multipart/form-data">
         <h3>add product</h3>
         <input type="text" name="book_id" class="box" placeholder="enter book id" required>
         <input type="text" name="name" class="box" placeholder="enter book name" required>
         <input type="number" min="0" name="price" class="box" placeholder="enter book price" required>
         <input type="date" min="0" name="book_date" class="box" placeholder="enter book publication year" required>
         <input type="text" name="Author_id" class="box" placeholder="enter Author id" required>
         <container style="display: grid;font-size: 1.5rem; justify-items: start; padding-top:10px;">
            
         <label>
    <input type="radio" name="category" value="Academic" required> ACADEMIC
</label><br>
<label  >
    <input type="radio" name="category"   value="science-fiction" required> SCIENCE FICTION
</label><br>
<label >
    <input type="radio" name="category"  value="literature" required> LITERATURE
</label><br> 
<label >
    <input type="radio" name="category"  value="kids" required> KIDS BOOK
</label><br>
<label >
    <input type="radio" name="category"  value="Religious" required> RELIGIOUS BOOK
</label><br>

</container>
        
<!-- Add more options as needed -->


         <input type="text" name="details" class="box" placeholder="enter book details" required> <!-- New field for details -->
         <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
         <input type="submit" value="add product" name="add_product" class="btn">
      </form>
   </section>
   <!-- product CRUD section ends -->
   <!-- show products  -->
   <section class="show-products">
      <div class="box-container">
         <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `book`") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
               while($fetch_products = mysqli_fetch_assoc($select_products)){
         ?>
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_products['Book_Image']; ?>" alt="">
            <div class="name"><?php echo $fetch_products['Book_Title']; ?></div>
            <div class="price">TK.<?php echo $fetch_products['Book_Price']; ?></div>
            <a href="admin_products.php?update=<?php echo $fetch_products['Book_Id']; ?>" class="option-btn">update</a>
            <a href="admin_products.php?delete=<?php echo $fetch_products['Book_Id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
         </div>
         <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
         ?>
      </div>
   </section>
   <section class="edit-product-form">
      <?php
         if(isset($_GET['update'])){
            $update_id = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM `book` WHERE Book_Id = '$update_id'") or die('query failed');
            if(mysqli_num_rows($update_query) > 0){
               while($fetch_update = mysqli_fetch_assoc($update_query)){
      ?>
      <form action="" method="post" enctype="multipart/form-data">
         <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['Book_Id']; ?>">
         <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['Book_Image']; ?>">
         <img src="uploaded_img/<?php echo $fetch_update['Book_Image']; ?>" alt="">
         <input type="text" name="update_name" value="<?php echo $fetch_update['Book_Title']; ?>" class="box" required placeholder="enter product name">
         <input type="number" name="update_price" value="<?php echo $fetch_update['Book_Price']; ?>" min="0" class="box" required placeholder="enter product price">
         <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
         <input type="submit" value="update" name="update_product" class="btn">
         <input type="reset" value="cancel" id="close-update" class="option-btn">
      </form>
      <?php
            }
         }
         }else{
            echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
         }
      ?>
   </section>
   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>
</body>
</html>
