<?php
include 'config.php';

session_start();

$user_id = $_SESSION['Customer_ID'];

if (!isset($user_id)) {
    header('location:login.php');
    exit(); // Terminate script execution after redirection
}

// Fetch customer information from the database
$customer_id = $_SESSION['Customer_ID'];
$sql = "SELECT * FROM customer WHERE Customer_ID = $customer_id";
$result = mysqli_query($conn, $sql);

// Check if customer exists
if (mysqli_num_rows($result) > 0) {
    $customer = mysqli_fetch_assoc($result);
} else {
    echo "Customer not found!";
    exit(); // Terminate script execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    
</head>

<body>

    <?php include 'header.php'; ?>
   
    

<section class="profile">
    <div class="form-container" style="background-color: white;">
        <form >
            <h3>Your Profile Information</h3>
            <div class="box"style="background-color: white;">
               
                <input type="text" id="customerName" name="customerName" value="Name:<?php echo $customer['Customer_Name']; ?>" readonly>
            </div>

            <div class="box"style="background-color: white;">
               
                <input type="email" id="customerEmail" name="customerEmail" value="Email:<?php echo $customer['Customer_Email']; ?>" readonly>
            </div>

            <div class="box"style="background-color: white;">
                
                <input type="tel" id="phoneNo" name="phoneNo" value="Phone Number:<?php echo $customer['Phone_No']; ?>" readonly>
            </div>

            <div class="box"style="background-color: white;">
                
                <input type="tel" id="address" name="address" value="Address:<?php echo $customer['Address']; ?>" readonly>

            </div >
            <a href="request_new_book.php">
                <input type="button" value="Request New Book" name="send" class="btn">
            </a>
            </div>
        </form>
    </div>
</section>






    <?php include 'footer.php'; ?>

    
        <script src="js/script.js"></script>
   

</body>

</html>
