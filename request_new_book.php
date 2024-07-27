<?php

include 'config.php';

session_start();

$user_id = $_SESSION['Customer_ID'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

    $name = mysqli_real_escape_string($conn, $_POST['customerName']); // Corrected to 'customerName'
    $book_name = mysqli_real_escape_string($conn, $_POST['bookName']);
    $author_name = mysqli_real_escape_string($conn, $_POST['authorName']);
    $publication_year = mysqli_real_escape_string($conn, $_POST['publicationYear']); // Corrected to 'publicationYear'

    $select_request = mysqli_query($conn, "SELECT * FROM `request` WHERE customer_name = '$name' AND book_name = '$book_name' AND author_name = '$author_name' AND publication_year = '$publication_year'") or die('query failed');

    if(mysqli_num_rows($select_request) > 0){
        $request[] = 'Request already sent!';
    }else{
        mysqli_query($conn, "INSERT INTO `request`(customer_id, customer_name, book_name, author_name, publication_year) VALUES ('$user_id', '$name', '$book_name', '$author_name', '$publication_year')") or die('query failed');
        $request[] = 'Request sent successfully!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Request New Book</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>




<section class="contact">
    <form action="" method="post">
        <h3>Request New Book</h3>
        <input type="text" name="customerName" required placeholder="Enter Your Name" class="box"> <!-- Changed to 'customerName' -->
        <input type="text" name="bookName" required placeholder="Enter Book name" class="box">
        <input type="text" name="authorName" required placeholder="Enter author name" class="box">
        <input type="date" name="publicationYear" required class="box">
        <input type="submit" value="Send Request" name="send" class="btn">
    </form>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
