<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['Admin_ID'];

if (!isset($admin_id)) {
    header('location: login.php');
    exit(); // Add an exit after header redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>

    <section class="admin-dashboard">
        <h1 class="title">ANALYSIS</h1>


        <div class="admin_container" style="display: flex; justify-content: space-between; background-color: #f0f0f0; padding: 20px;">
            <div class="admin-box" style="border-radius: .5rem; padding: 2rem; background-color: #ffffff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border: 1px solid #ccc; text-align: center;">
            <?php
$total_pendings = 0;
$select_pending = mysqli_query($conn, "SELECT MAX(max_price) AS overall_max_price FROM (
    SELECT MAX(Book_Price) AS max_price FROM book
    UNION
    SELECT MAX(ac_Book_Price) AS max_price FROM academic_book
) AS combined_prices") or die('query failed');

if ($select_pending) {
    $fetch_pendings = mysqli_fetch_assoc($select_pending);
    $total_price = $fetch_pendings['overall_max_price'];
    $total_pendings = number_format($total_price, 2); // Format the price if needed
}
?>


                <h3 style="font-size: 5rem; color: #000000;"><?php echo $total_pendings; ?></h3>
                <p style="margin-top: 1.5rem; padding: 1.5rem; background-color: #f0f0f0; color: #FFA500; font-size: 2rem; border-radius: .5rem; border: 1px solid #ccc;">Maximum Book Price</p>
            </div>

            <div class="admin-box" style="border-radius: .5rem; padding: 2rem; background-color: #ffffff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border: 1px solid #ccc; text-align: center;">
                <?php
                $total_earnings = 0;

                if (isset($_POST['add_product'])) {
                    $book_date = $_POST['book_date'];

                    $select_product_name = mysqli_query($conn, "SELECT SUM(Total_Amount) AS TotalAmount
                    FROM orders
                    WHERE Order_Date = '$book_date'
                    GROUP BY Order_Date") or die('query failed');

                    if (mysqli_num_rows($select_product_name) > 0) {
                        $fetch_result = mysqli_fetch_assoc($select_product_name);
                        $total_earnings = $fetch_result['TotalAmount'];
                    }
                }
                ?>
                <form action="" method="post">
                    <input type="date" min="0" name="book_date" class="box" placeholder="enter year" required>
                    <input type="submit" value="Result" name="add_product" class="btn">
                </form>
                <h3 style="font-size: 5rem; color: #000000;"><?php echo $total_earnings; ?></h3>
                <p style="margin-top: 1.5rem; padding: 1.5rem; background-color: #f0f0f0; color: #FFA500; font-size: 2rem; border-radius: .5rem; border: 1px solid #ccc;">Total Earnings</p>
            </div>

            <div class="admin-box" style="border-radius: .5rem; padding: 2rem; background-color: #ffffff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border: 1px solid #ccc; text-align: center;">
                <?php
                $best_customer_name = "";
                $select_best_customer = mysqli_query($conn, "SELECT customer.Customer_Name
        FROM orders
        JOIN customer ON orders.Customer_ID = customer.Customer_ID
        WHERE orders.Total_Amount = (SELECT MAX(Total_Amount) FROM orders)") or die('query failed');

                if (mysqli_num_rows($select_best_customer) > 0) {
                    $fetch_best_customer = mysqli_fetch_assoc($select_best_customer);
                    $best_customer_name = $fetch_best_customer['Customer_Name'];
                }
                ?>
                <h3 style="font-size: 5rem; color: #000000;"><?php echo $best_customer_name; ?></h3>
                <p style="margin-top: 1.5rem; padding: 1.5rem; background-color: #f0f0f0; color: #FFA500; font-size: 2rem; border-radius: .5rem; border: 1px solid #ccc;"> Best Customer</p>
            </div>

            <div class="admin-box" style="border-radius: .5rem; padding: 2rem; background-color: #ffffff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border: 1px solid #ccc; text-align: center;">
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

$result = mysqli_query($conn, $query);

if ($result) {
    if ($row = mysqli_fetch_assoc($result)) {
        $bestAuthorName = $row['Author_Name'];
        $totalSales = $row['TotalSales'];

        echo '<h3 style="font-size: 5rem; color: #000000;"> Most published books: ' . $totalSales . '</h3>';
        echo '<p style="margin-top: 1.5rem; padding: 1.5rem; background-color: #f0f0f0; color: #FFA500; font-size: 2rem; border-radius: .5rem; border: 1px solid #ccc;">Author Name: ' . $bestAuthorName . '</p>';
    } else {
        echo "No data found.";
    }
} else {
    echo "Query failed.";
}
?>

</div>

            
           
            


        </div>


        <div class="admin_container" style="display: flex; justify-content: space-between; background-color: #f0f0f0; padding: 20px;">
        <div class="box" style="width: 1500px; height: 2000px;">
        <?php
if (isset($_POST['add_products'])) {

    // Replace the following query with your actual database query
    $select_product_name = mysqli_query($conn, "SELECT Book_Id, Book_Title, Publication_Year, Book_Price, Author_Id FROM book
    UNION ALL
    SELECT ac_book_id, ac_Book_Title, ac_Publication_Year, ac_Book_Price, Author_Id FROM academic_book
    ") or die('query failed');

    if (mysqli_num_rows($select_product_name) > 0) {
        echo '<div class="scroll-panel" style="width: 100%; height: 200px; overflow: auto; border: 2px solid #FFA500;">';
        echo '<table style="width: 100%; border-collapse: collapse; height: 100%;">';
        echo '<thead>';
        echo '<tr>';
        echo '<th style="border: 2px solid #FFA500; padding: 8px; text-align: left;font-size: 16px;">Book_Id</th>';
        echo '<th style="border: 2px solid #FFA500; padding: 8px; text-align: left;font-size: 16px;">Book_Title</th>';
        echo '<th style="border: 2px solid #FFA500; padding: 8px; text-align: left;font-size: 16px;">Publication_Year</th>';
        echo '<th style="border: 2px solid #FFA500; padding: 8px; text-align: left;font-size: 16px;">Book_Price</th>';
        echo '<th style="border: 2px solid #FFA500; padding: 8px; text-align: left;font-size: 16px;">Author_Id</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Fetch data from the database
        while ($fetch_result = mysqli_fetch_assoc($select_product_name)) {
            $book_id = $fetch_result['Book_Id'];
            $book_title = $fetch_result['Book_Title'];
            $publication_year = $fetch_result['Publication_Year'];
            $book_price = $fetch_result['Book_Price'];
            $author_id = $fetch_result['Author_Id'];

            // Display the data in the table
            echo '<tr>';
            echo "<td style='border: 2px solid #FFA500; padding: 8px; text-align: left; font-size: 16px;'>$book_id</td>";
            echo "<td style='border: 2px solid #FFA500; padding: 8px; text-align: left; font-size: 16px;'>$book_title</td>";
            echo "<td style='border: 2px solid #FFA500; padding: 8px; text-align: left; font-size: 16px;'>$publication_year</td>";
            echo "<td style='border: 2px solid #FFA500; padding: 8px; text-align: left; font-size: 16px;'>$book_price</td>";
            echo "<td style='border: 2px solid #FFA500; padding: 8px; text-align: left; font-size: 16px;'>$author_id</td>";
            // Add more columns if needed
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }
}
?>

                <form action="" method="post" class="search-form" style="display: flex; justify-content: center; align-items: center;">
    <input type="submit" value="Search About Books" name="add_products" class="btn">
</form>

            </div>
        </div>


    </section>
    <script src="js/admin_script.js"></script>

</body>
</html>