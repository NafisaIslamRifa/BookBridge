<?php
include 'config.php'; // Include your database configuration file

// Check if the notification ID is set and not empty
if(isset($_POST['notification_id']) && !empty($_POST['notification_id'])) {
    // Sanitize the input to prevent SQL injection
    $notification_id = mysqli_real_escape_string($conn, $_POST['notification_id']);

    // Update the notification status to mark it as unread using a prepared statement
    $update_query = "UPDATE `notification` SET is_read = 0 WHERE notification_id = ?";
    $stmt = mysqli_prepare($conn, $update_query);
    
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $notification_id);
    
    // Execute the statement
    if(mysqli_stmt_execute($stmt)) {
        // If the update is successful, redirect back to the notification page with a success message
        header('Location: notification.php?status=success');
        exit();
    } else {
        // If the update fails, redirect back to the notification page with an error message
        header('Location: notification.php?status=error');
        exit();
    }
} else {
    // If notification ID is not set or empty, redirect back to the notification page with an error message
    header('Location: notification.php?status=error');
    exit();
}
?>
