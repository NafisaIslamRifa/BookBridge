<?php
include 'config.php';

session_start();

$user_id = $_SESSION['Customer_ID'];
$Book_ID = $_SESSION['Book_Id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM shopping_cart WHERE product_name = '$product_name' AND Customer_ID  = '$user_id'") or die('query failed');

    if (mysqli_num_rows($check_cart_numbers) > 0) {
        $message[] = 'already added to cart!';
    } else {
        mysqli_query($conn, "INSERT INTO shopping_cart(Customer_ID , Quantity,Price, Image_URL,product_name) VALUES('$user_id','$product_quantity','$product_price', '$product_image','$product_name')") or die('query failed');
        $message[] = 'product added to cart!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Inline CSS -->
    <style>
        .dashboard {
            display: flex;
            background-color: #FFFFFF;
            justify-content: space-between;
        }

        .author-box-image {
            width: 30%;
            height: 10%;
            object-fit: cover;
            margin-right: 20px;
        }

        .author-box-bio {
            width: 1000px;
            margin-left: 0;
        }

        /* Inline CSS for rating */
       
.stars {
    font-size: 30px;
    margin: 10px 0;
}

.star {
    cursor: pointer;
    margin: 0 5px;
}

.modal-content {
    border-radius: 10px;
}

.modal-header {
    background-color: #007bff;
    color: #fff;
    border-radius: 10px 10px 0 0;
    padding: 15px;
}

.modal-title {
    font-size: 24px;
}

.modal-body {
    padding: 20px;
}

.modal-footer {
    border-radius: 0 0 10px 10px;
    padding: 15px;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    font-size: 18px; /* Increased font size for buttons */
}

.btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.review-item {
    margin-bottom: 20px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #fff;
}

.review-item .reviewer-info {
    font-size: 20px; /* Increased font size for reviewer info */
    margin-bottom: 10px;
    color: #333; /* Improved readability with darker text color */
}

.review-item .review-rating {
    margin-bottom: 10px;
}

.review-item .review-text {
    margin-bottom: 0;
    font-size: 16px; /* Increased font size for review text */
    line-height: 1.5; /* Improved spacing between lines */
    color: #555; /* Slightly lighter text color for better readability */
}

    </style>
</head>

<body>

    <?php include 'header.php'; ?>

    <section class="author-dashboard">
        <section class="dashboard">
            <?php
            $select_authors = mysqli_query($conn, "SELECT * FROM book WHERE Book_Id ='$Book_ID'") or die('query failed');
            if (mysqli_num_rows($select_authors) > 0) {
                $fetch_author = mysqli_fetch_assoc($select_authors);
            ?>
                <div class="author-box-image">
                    <img class="image" src="uploaded_img/<?php echo $fetch_author['Book_Image']; ?>" alt="Book_Image">
                </div>
                <div class="author-box-bio">
                    <div class="name"><?php echo $fetch_author['Book_Title']; ?></div>
                    <div class="biography"><?php echo $fetch_author['Book_details']; ?></div>
                    <form action="" method="post">
                        <input type="hidden" name="Book_Id" value="<?php echo $fetch_author['Book_Id']; ?>">
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

    <div class="container">
        <h1 class="mt-5 mb-5">Review Of The Book</h1>
        <div class="card">
            <div class="card-header">Review</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4 text-center">
                        <h1 class="text-warning mt-4 mb-4">
                            <b><span id="average_rating">0.0</span> / 5</b>
                        </h1>
                        <div class="mb-3">
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                            <i class="fas fa-star star-light mr-1 main_star"></i>
                        </div>
                        <h3><span id="total_review">0</span> Review</h3>
                    </div>
                    <div class="col-sm-4">
                        <p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                        </p>
                        <!-- Add other star ratings here -->
                    </div>
                    <div class="col-sm-4 text-center">
                        <h3 class="mt-4 mb-3">Write Review Here</h3>
                        <button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5" id="review_content"></div>
    </div>

    <!-- Review Modal -->
    <div id="review_modal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Submit Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="text-center mt-2 mb-4">
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                    </h4>
                    <div class="form-group">
                        <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
                    </div>
                    <div class="form-group">
                        <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>

        $(document).ready(function(){

            var rating_data = 0;

            $('#add_review').click(function(){

                $('#review_modal').modal('show');

            });

            $(document).on('mouseenter', '.submit_star', function(){

                var rating = $(this).data('rating');

                reset_background();

                for(var count = 1; count <= rating; count++)
                {

                    $('#submit_star_'+count).addClass('text-warning');

                }

            });

            function reset_background()
            {
                for(var count = 1; count <= 5; count++)
                {

                    $('#submit_star_'+count).addClass('star-light');

                    $('#submit_star_'+count).removeClass('text-warning');

                }
            }

            $(document).on('mouseleave', '.submit_star', function(){

                reset_background();

                for(var count = 1; count <= rating_data; count++)
                {

                    $('#submit_star_'+count).removeClass('star-light');

                    $('#submit_star_'+count).addClass('text-warning');
                }

            });

            $(document).on('click', '.submit_star', function(){

                rating_data = $(this).data('rating');

            });

            $('#save_review').click(function(){

                var user_name = $('#user_name').val();

                var user_review = $('#user_review').val();

                if(user_name == '' || user_review == '')
                {
                    alert("Please Fill Both Field");
                    return false;
                }
                else
                {
                    $.ajax({
                        url:"submit_rating.php",
                        method:"POST",
                        data:{rating_data:rating_data, user_name:user_name, user_review:user_review},
                        success:function(data)
                        {
                            $('#review_modal').modal('hide');

                            load_rating_data();

                            alert(data);
                        }
                    })
                }

            });

            load_rating_data();

            function load_rating_data()
            {
                $.ajax({
                    url:"submit_rating.php",
                    method:"POST",
                    data:{action:'load_data'},
                    dataType:"JSON",
                    success:function(data)
                    {
                        $('#average_rating').text(data.average_rating);
                        $('#total_review').text(data.total_review);

                        var count_star = 0;

                        $('.main_star').each(function(){
                            count_star++;
                            if(Math.ceil(data.average_rating) >= count_star)
                            {
                                $(this).addClass('text-warning');
                                $(this).addClass('star-light');
                            }
                        });

                        $('#total_five_star_review').text(data.five_star_review);

                        $('#total_four_star_review').text(data.four_star_review);

                        $('#total_three_star_review').text(data.three_star_review);

                        $('#total_two_star_review').text(data.two_star_review);

                        $('#total_one_star_review').text(data.one_star_review);

                        $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                        $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                        $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                        $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                        $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                        if(data.review_data.length > 0)
                        {
                            var html = '';

                            for(var count = 0; count < data.review_data.length; count++)
                            {
                                html += '<div class="row mb-3">';

                                html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';

                                html += '<div class="col-sm-11">';

                                html += '<div class="card">';

                                html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

                                html += '<div class="card-body">';

                                for(var star = 1; star <= 5; star++)
                                {
                                    var class_name = '';

                                    if(data.review_data[count].rating >= star)
                                    {
                                        class_name = 'text-warning';
                                    }
                                    else
                                    {
                                        class_name = 'star-light';
                                    }

                                    html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                                }

                                html += '<br />';

                                html += data.review_data[count].user_review;

                                html += '</div>';

                                html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

                                html += '</div>';

                                html += '</div>';

                                html += '</div>';
                            }

                            $('#review_content').html(html);
                        }
                    }
                })
            }

        });

    </script>

</body>

</html>
<?php include 'footer.php'; ?>
