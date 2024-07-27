<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['Admin_ID'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['add_author'])) {
    $author_id = $_POST['Author_Id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $biography = mysqli_real_escape_string($conn, $_POST['Biography']);

    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    $select_author_name = mysqli_query($conn, "SELECT Author_Name FROM `author` WHERE Author_Name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_author_name) > 0) {
        $message[] = 'Author name already added';
    } else {
        $add_author_query = mysqli_query($conn, "INSERT INTO `author`(Author_Id,Author_Name, Biography, image) VALUES('$author_id','$name','$biography','$image')") or die('query failed');

        if ($add_author_query) {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Author added successfully!';
            }
        } else {
            $message[] = 'Author could not be added!';
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `author` WHERE Author_Id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/' . $fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `author` WHERE Author_Id = '$delete_id'") or die('query failed');
    header('location:admin_author_details.php');
}

if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_biography = $_POST['update_Biography'];

    mysqli_query($conn, "UPDATE `author` SET Author_Name = '$update_name', Biography = '$update_biography' WHERE Author_Id = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'Image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `author` SET image = '$update_image' WHERE Author_Id = '$update_p_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('uploaded_img/' . $update_old_image);
        }
    }

    header('location:admin_author_details.php');
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

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<!-- Author CRUD section starts  -->

<section class="add-products">

    <h1 class="title">Manage Authors</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <h3 class="subtitle">Add Author</h3>
        <input type="text" name="Author_Id" class="box" placeholder="Enter Author Id" required style="width: 300px; height:40px">

        <input type="text" name="name" class="box" placeholder="Enter Author name" required style="width: 300px; height:40px">
        <input type="text" min="0" name="Biography" class="box" placeholder="Enter Author biography" required style="width: 300px; height:40px">
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required style="width: 300px;">

        <br>
        <input type="submit" value="Add Author Details" name="add_author" class="btn">
    </form>
</section>

<!-- Author CRUD section ends -->

<!-- Show Authors  -->

<section class="show-products">

    <div class="box-container">

        <?php
        $select_authors = mysqli_query($conn, "SELECT * FROM `author`") or die('query failed');
        if (mysqli_num_rows($select_authors) > 0) {
            while ($fetch_authors = mysqli_fetch_assoc($select_authors)) {
                ?>
                <div class="box-card">
                    <div>
                        <img src="uploaded_img/<?php echo $fetch_authors['image']; ?>" alt="">
                        <div class="name"><?php echo $fetch_authors['Author_Id']; ?></div>
                        <div class="name"><?php echo $fetch_authors['Author_Name']; ?></div>
                        <div class="price"><?php echo $fetch_authors['Biography']; ?></div>

                        <a href="admin_author_details.php?update=<?php echo $fetch_authors['Author_Id']; ?>" class="option-btn">Update</a>
                        <a href="admin_author_details.php?delete=<?php echo $fetch_authors['Author_Id']; ?>" class="delete-btn"
                           onclick="return confirm('Delete this author?');">Delete</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p class="empty">No authors added yet!</p>';
        }
        ?>
    </div>
</section>

<section class="edit-product-form">

    <?php
    if (isset($_GET['update'])) {
        $update_id = $_GET['update'];
        $update_query = mysqli_query($conn, "SELECT * FROM `author` WHERE Author_Id = '$update_id'") or die('query failed');
        if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['Author_Id']; ?>">
                    <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                    <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                    <input type="text" name="update_name" value="<?php echo $fetch_update['Author_Name']; ?>" class="box" required
                           placeholder="Enter author name">
                    <input type="text" name="update_Biography" value="<?php echo $fetch_update['Biography']; ?>" class="box" required
                           placeholder="Enter author biography">
                    <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                    <input type="submit" value="Update" name="update_product" class="btn">
                    <input type="reset" value="Cancel" id="close-update" class="option-btn">
                </form>
                <?php
            }
        }
    } else {
        echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
    }
    ?>

</section>

<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>


</body>
</html>
