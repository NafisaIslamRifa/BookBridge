<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['Admin_ID'];

if (!isset($admin_id)) {
    header('location:login.php');
}

$message = []; // Initialize message array

if (isset($_POST['add_notification'])) {
    $notification_id = mysqli_real_escape_string($conn, $_POST['ID']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);

    $select_notification_name = mysqli_query($conn, "SELECT notification_name FROM `notification` WHERE notification_name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_notification_name) > 0) {
        $message[] = 'Notification name already added';
    } else {
        mysqli_query($conn, "INSERT INTO `notification` (notification_id, notification_name, details, Admin_Id) VALUES ('$notification_id', '$name', '$details', '$admin_id')") or die('query failed');
        header('location:admin_notification.php');
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `notification` WHERE notification_id = '$delete_id'") or die('query failed');
    header('location:admin_notification.php');
}

if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_details = $_POST['update_price'];

    mysqli_query($conn, "UPDATE `notification` SET notification_name = '$update_name', details = '$update_details' WHERE notification_id = '$update_p_id'") or die('query failed');
    header('location:admin_notification.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'admin_header.php'; ?>

<!-- Author CRUD section starts  -->

<section class="add-products">

    <h1 class="title">Manage Notifications</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <h3 class="subtitle">Add Notifications</h3>
        <input type="text" name="ID" class="box" placeholder="Enter Notification Id" required style="width: 300px; height:40px">

        <input type="text" name="name" class="box" placeholder="Enter Notification name" required style="width: 300px; height:40px">
        <input type="text" min="0" name="details" class="box" placeholder="Enter Notification details" required style="width: 300px; height:40px">
       
        <br>
        <input type="submit" value="Add Notifications" name="add_notification" class="btn">
    </form>
</section>

<!-- notification CRUD section ends -->

<!-- Show notification  -->

<section class="show-products">

    <div class="box-container">

        <?php
        $select_notifications = mysqli_query($conn, "SELECT * FROM `notification`") or die('query failed');
        if (mysqli_num_rows($select_notifications) > 0) {
            while ($fetch_notifications = mysqli_fetch_assoc($select_notifications)) {
                ?>
                <div class="box-card">
                    <div>
                        <div class="name"><?php echo $fetch_notifications['notification_id']; ?></div>
                        <div class="name"><?php echo $fetch_notifications['notification_name']; ?></div>
                        <div class="price"><?php echo $fetch_notifications['details']; ?></div>

                        <a href="admin_notification.php?update=<?php echo $fetch_notifications['notification_id']; ?>" class="option-btn">Update</a>
                        <a href="admin_notification.php?delete=<?php echo $fetch_notifications['notification_id']; ?>" class="delete-btn"
                           onclick="return confirm('Delete this notification?');">Delete</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p class="empty">No notifications added yet!</p>';
        }
        ?>
    </div>
</section>

<section class="edit-product-form">

    <?php
    if (isset($_GET['update'])) {
        $update_id = $_GET['update'];
        $update_query = mysqli_query($conn, "SELECT * FROM `notification` WHERE notification_id = '$update_id'") or die('query failed');
        if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
                ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['notification_id']; ?>">
                    
                    <input type="text" name="update_name" value="<?php echo $fetch_update['notification_name']; ?>" class="box" required
                           placeholder="Enter notification name">
                    <input type="text" name="update_price" value="<?php echo $fetch_update['details']; ?>" class="box" required
                           placeholder="Enter notification details">
                   
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

