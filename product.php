<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

$message = []; // Array to store messages

// Check if add_to_cart is clicked
if (isset($_POST['add_to_cart'])) {
   // Check if required form data is set
   if (isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_image']) && isset($_POST['product_quantity'])) {
       // Process form data
       $product_name = $_POST['product_name'];
       $product_price = floatval($_POST['product_price']);
       $product_image = $_POST['product_image'];
       $product_quantity = intval($_POST['product_quantity']);

       // Get productID
       $select_product_id = mysqli_query($conn, "SELECT productID FROM product WHERE productName = '$product_name'") or die('Query failed');
       $fetch_product_id = mysqli_fetch_assoc($select_product_id);
       
       if ($fetch_product_id && isset($fetch_product_id['productID'])) {
           $product_id = $fetch_product_id['productID'];

           // Check stock before adding to cart
           $select_stock = mysqli_query($conn, "SELECT totalstock, stockOut FROM stock WHERE productID = '$product_id'") or die('Query failed');
           if (mysqli_num_rows($select_stock) > 0) {
               $stock_info = mysqli_fetch_assoc($select_stock);
               $total_stock = intval($stock_info['totalstock']);
               $stock_out = intval($stock_info['stockOut']);

               // Check if there is enough stock
               if ($total_stock >= $product_quantity) {
                   // Check if product is already in the cart
                   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM cart WHERE productID = '$product_id' AND touristID = '$user_id'") or die('Query failed');

                   if (mysqli_num_rows($check_cart_numbers) > 0) {
                       $message[] = 'Already added to cart!';
                   } else {
                       // Add to cart
                       mysqli_query($conn, "INSERT INTO cart(touristID, productID, name, price, quantity, cartImage) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('Query failed');

                       // Update stockOut and totalstock
                       $new_stock_out = $stock_out + $product_quantity;
                       $new_total_stock = $total_stock - $product_quantity;

                       mysqli_query($conn, "UPDATE stock SET stockOut = $new_stock_out, totalstock = $new_total_stock WHERE productID = '$product_id'") or die('Query failed');

                       $message[] = 'Product added to cart successfully';
                   }
               } else {
                   $message[] = 'Insufficient stock to add to cart!';
               }
           } else {
               $message[] = 'Stock information not found';
           }
       } else {
           $message[] = 'Product ID not found';
       }
   } else {
       $message[] = 'Required product information is missing';
   }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Product</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="products">

   <h1 class="title">Latest Products</h1>

   <div class="box-container">

      <?php  
        $select_products = mysqli_query($conn, "SELECT * FROM product") or die('Query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                $product_id = $fetch_products['productID'];
                $select_stock = mysqli_query($conn, "SELECT totalstock FROM stock WHERE productID = '$product_id'") or die('Query failed');
                
                // Check if any record is returned
                if (mysqli_num_rows($select_stock) > 0) {
                    $stock_info = mysqli_fetch_assoc($select_stock);
                    $total_stock = intval($stock_info['totalstock']);
                } else {
                    $total_stock = 0; // Set a default value in case there's no stock record
                }

                // Display product information
                ?>
                <form action="" method="post" class="box">
                    <img class="image" src="uploaded_img/<?php echo htmlspecialchars($fetch_products['productImage']); ?>" alt="">
                    <div class="name"><?php echo htmlspecialchars($fetch_products['productName']); ?></div>
                    <div class="price">RM<?php echo htmlspecialchars($fetch_products['productPrice']); ?></div>
            
                    <?php if ($total_stock > 0) { ?>
                        <input type="number" min="1" name="product_quantity" value="1" class="qty">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_products['productName']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_products['productPrice']); ?>">
                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_products['productImage']); ?>">
                        <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
                    <?php } else { ?>
                        <div class="out-of-stock">Out of Stock</div>
                    <?php } ?>
                </form>
                <?php
            }
        } else {
            echo '<p class="empty">No products added yet!</p>';
        }
      ?>
   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
