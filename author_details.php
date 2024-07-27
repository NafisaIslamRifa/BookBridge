<?php
include 'config.php';

session_start();

$user_id = $_SESSION['Customer_ID'];
$AUTHOR_ID = $_SESSION['Author_Id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM shopping_cart WHERE product_name = '$product_name' AND Customer_ID  = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart!';
    }else{
       mysqli_query($conn, "INSERT INTO shopping_cart(Customer_ID , Quantity,Price, Image_URL,product_name) VALUES('$user_id','$product_quantity','$product_price', '$product_image','$product_name')") or die('query failed');
       $message[] = 'product added to cart!';
    }
 
 
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Details</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <section class="author-dashboard">
        <section class="dashboard" style="display: flex; background-color: #FFFFFF;justify-content: space-between;">
            <?php
            $select_authors = mysqli_query($conn, "SELECT * FROM author WHERE Author_Id='$AUTHOR_ID'") or die('query failed');
            if (mysqli_num_rows($select_authors) > 0) {
                $fetch_author = mysqli_fetch_assoc($select_authors);
            ?>
                <div class="author-box-image" style="width: 30%; height: 10%; object-fit: cover; margin-right: 20px;">
                    <img class="image" src="uploaded_img/<?php echo $fetch_author['image']; ?>" alt="Author Image">
                </div>
                <div class="author-box-bio" style="width: 1000px;  margin-left: 0;">
                    <div class="name"><?php echo $fetch_author['Author_Name']; ?></div>
                    <div class="biography"><?php echo $fetch_author['Biography']; ?></div>
                    <form action="" method="post">
                        <input type="hidden" name="author_id" value="<?php echo $fetch_author['Author_Id']; ?>">
                        <!-- Add other form elements or actions as needed -->
                    </form>
                </div>
            <?php
            } else {
                echo '<p class="empty">No authors added yet!</p>';
            }
            ?>
        </section>
    </section>

    <section class="products">
        <h1 class="title">Author Books</h1>

        <div class="box-container">
    <?php
    $select_products = mysqli_query($conn, "SELECT * FROM author AS au JOIN book AS bo ON au.Author_Id = bo.Author_Id WHERE au.Author_Id = '$AUTHOR_ID'") or die('query failed');
    if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
    ?>
            <form action="" method="post" class="box">
                <img class="image" src="uploaded_img/<?php echo $fetch_products['Book_Image']; ?>" alt="Product Image">
                <div class="name"><?php echo $fetch_products['Book_Title']; ?></div>
                <div class="price">TK.<?php echo $fetch_products['Book_Price']; ?></div>
                <input type="number" min="1" name="product_quantity" value="1" class="qty">
                <input type="hidden" name="product_name" value="<?php echo $fetch_products['Book_Title']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_products['Book_Price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $fetch_products['Book_Image']; ?>">
                <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
            </form>
    <?php
        }
    } 
    ?>
    


</div>

    </section>

   
        <?php include 'footer.php'; ?>
        <!-- Custom JS file link -->
        <script src="js/script.js"></script>
   

</body>

</html>