<?php
// Start output buffering FIRST (before any output)
ob_start();

// Start the session immediately — before including anything
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database configuration (must not echo anything)
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Add to cart functionality
if (isset($_POST['add_to_cart'])) {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_image = mysqli_real_escape_string($conn, $_POST['product_image']);
    $product_quantity = (int)$_POST['product_quantity'];

    $check_cart = mysqli_query(
        $conn,
        "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'"
    ) or die('Query failed');

    if (mysqli_num_rows($check_cart) > 0) {
        $message[] = 'Product already added to cart!';
    } else {
        mysqli_query(
            $conn,
            "INSERT INTO `cart` (user_id, name, price, quantity, image) 
             VALUES ('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')"
        ) or die('Query failed');
        $message[] = 'Product added to cart!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link -->
   <link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php include 'header.php'; ?>

<section class="home">
   <div class="content">
      <h3>Hand Picked Books to your door</h3>
      <p>Discover your next favorite read with us. Handpicked books from top authors delivered to you.</p>
      <a href="about.php" class="white-btn">Discover more</a>
   </div>
</section>

<section class="products">
   <h1 class="title">Latest Products</h1>
   <div class="box-container">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('Query failed');
      if (mysqli_num_rows($select_products) > 0) {
         while ($fetch_products = mysqli_fetch_assoc($select_products)) {
      ?>
      <form action="" method="post" class="box">
         <img class="image" src="uploaded_img/<?php echo htmlspecialchars($fetch_products['image']); ?>" alt="">
         <div class="name"><?php echo htmlspecialchars($fetch_products['name']); ?></div>
         <div class="price">&#8377; <?php echo htmlspecialchars($fetch_products['price']); ?>/-</div>
         <input type="number" min="1" name="product_quantity" value="1" class="qty">
         <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_products['name']); ?>">
         <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_products['price']); ?>">
         <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_products['image']); ?>">
         <input type="submit" value="Add to Cart" name="add_to_cart" class="option-btn">
      </form>
      <?php
         }
      } else {
         echo '<p class="empty">No products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="shop.php" class="option-btn">Load more</a>
   </div>
</section>

<section class="about">
   <div class="flex">
      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>
      <div class="content">
         <h3>About Us</h3>
         <p>We are passionate about bringing books closer to readers. From classics to modern gems, explore our collection.</p>
         <a href="about.php" class="option-btn">Read more</a>
      </div>
   </div>
</section>

<section class="home-contact">
   <div class="content">
      <h3>Have any questions?</h3>
      <p>We'd love to hear from you. Reach out for help, feedback, or collaborations.</p>
      <a href="contact.php" class="option-btn">Contact us</a>
   </div>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link -->
<script src="js/script.js"></script>

</body>
</html>

<?php
// End output buffering and send output
ob_end_flush();
?>
