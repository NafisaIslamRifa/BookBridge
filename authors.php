<?php
include 'config.php';

session_start();

$user_id = $_SESSION['Customer_ID'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['author_search'])) {
    $name = mysqli_real_escape_string($conn, $_POST['product_name']);  // assuming 'name' is the Author_Name in the form
    $select_users = mysqli_query($conn, "SELECT * FROM `author` WHERE Author_Name = '$name' ") or die('query failed');

    if (mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);
        $_SESSION['Author_Id'] = $row['Author_Id'];
         header('location:author_details.php');
       
        
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authors</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php include 'header.php'; ?>

    <div class="grid text-center" style="--bs-columns: 4; --bs-gap: 10rem; display: flex; justify-content: center;">
    <div class="g-col-2 d-flex flex-column justify-content-center align-items-center" style="width: 800px; height: 400px; padding-top: 50px; padding-bottom: 90px; align-self: center;">
        <?php
        $query = "
        SELECT Author_Name, SUM(TotalSales) AS TotalSales
        FROM (
            SELECT au.Author_Name, COUNT(*) AS TotalSales
            FROM author au
            INNER JOIN book b ON au.Author_Id = b.Author_Id
            GROUP BY au.Author_Id
    
            UNION
    
            SELECT au.Author_Name, COUNT(*) AS TotalSales
            FROM author au
            INNER JOIN academic_book ac ON au.Author_Id = ac.Author_Id
            GROUP BY au.Author_Id
        ) AS combined
        GROUP BY Author_Name
        ORDER BY TotalSales DESC
        LIMIT 4";
        $select_products = mysqli_query($conn, $query) or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            $fetch_products = mysqli_fetch_assoc($select_products); // Assuming you want to display the first notification's details in the h1 tag
            $details = $fetch_products['Author_Name']; // Extract details from the fetched row
        ?>
            <div >
            <h1 style="font-size: 35px; color:orange;"> Most published books<br><?php echo $details; ?></h1>

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
        <img src="uploaded_img/authors.png" style="width: 100%; height: 100%; object-fit: cover;"> 
    </div>
</div>

    </section>

    <section class="products">

        <h1 class="title">AUTHORS</h1>

        <div class="box-container">

            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `author` ") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
            ?>
                    <form action="" method="post" class="box">
                        <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="Author_Id "><?php echo $fetch_products['Author_Id']; ?></div>
                        <div class="name"><?php echo $fetch_products['Author_Name']; ?></div>

                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['Author_Name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['Biography']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <input type="hidden" name="author_id" value="<?php echo $fetch_products['Author_Id']; ?>">
                        <input type="submit" value="View details" name="author_search" class="btn">
                    </form>
            <?php
                }
            } else {
                echo '<p class="empty">No authors added yet!</p>';
            }
            ?>
        </div>

    </section>

    <section class="about">
        <?php include 'footer.php'; ?>
        <!-- custom js file link  -->
        <script src="js/script.js"></script>
    </section>

</body>

</html>
