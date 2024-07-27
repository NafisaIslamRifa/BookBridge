<?php
include 'config.php';

session_start();

$user_id = $_SESSION['Customer_ID'];

if (!isset($user_id)) {
    header('location:login.php');
    exit(); // Ensure to exit after redirecting
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <section class="products" style="padding-top: 50px; background-color:white;">
        <h1 class="title" style="text-align: center; margin-bottom: 30px;">Notification</h1>

        <div class="box-container" style="display: grid; grid-template-columns:auto ">
            <?php
            // Fetch notifications from the database
            $select_notifications = mysqli_query($conn, "SELECT * FROM `notification` ORDER BY notification_id DESC
            ") or die('Query failed');

            // Check if there are any notifications
            if (mysqli_num_rows($select_notifications) > 0) {
                while ($fetch_notification = mysqli_fetch_assoc($select_notifications)) {
                    // Output notification details
                    echo '<div class="notification" style="background-color:white ;width:1000px;border-radius:5px; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); transition: all 0.3s;">';
                    echo '<p style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">' . $fetch_notification['notification_name'] . '</p>';
                    echo '<p style="font-size: 18px;color: #F39C12 ; margin-bottom: 20px;">' . $fetch_notification['details'] . '</p>';

                    // Check if notification is read or unread
                    if ($fetch_notification['is_read'] == 0) {
                        // If notification is unread, display a mark as read button
                        echo '<form action="mark_as_read.php" method="post">';
                        echo '<input type="hidden" name="notification_id" value="' . $fetch_notification['notification_id'] . '">';
                        echo '<button type="submit" name="mark_read" style="background-color:#F39C12; height: 30px;width:80px;color:white;border-radius:5px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); transition: all 0.3s;font-size:10px;">Mark as Read</button>';
                        echo '</form>';
                    } else {
                        // If notification is read, display a mark as unread button
                        echo '<form action="mark_as_unread.php" method="post">';
                        echo '<input type="hidden" name="notification_id" value="' . $fetch_notification['notification_id'] . '">';
                        echo '<button type="submit" name="mark_unread" style="background-color:red; height: 30px;width:80px;color:white;border-radius:5px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); transition: all 0.3s;">Mark as Unread</button>';
                        echo '</form>';
                    }

                    echo '</div>';
                }
            } else {
                // If there are no notifications
                echo '<p>No notifications found.</p>';
            }
            ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <!-- custom js file link  -->
    <script src="js/script.js"></script>
</body>

</html>
