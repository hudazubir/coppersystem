<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

// Function to get the current quantity in the cart
function getCartQuantity($conn, $cart_id) {
    $query = "SELECT quantity FROM cart WHERE cartID = '$cart_id'";
    $result = mysqli_query($conn, $query) or die('Query failed');
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['quantity'];
    }
    return 0;
}

// Function to get stock information for a product
function getStockInfo($conn, $product_id) {
    $query = "SELECT stockID, stockIn, stockOut, totalstock, status FROM stock WHERE productID = '$product_id'";
    $result = mysqli_query($conn, $query) or die('Query failed');
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    }
    return null;
}

// Function to update stock and product table
function updateStock($conn, $product_id, $quantity_change) {
    // Get the stock information
    $stock_info = getStockInfo($conn, $product_id);

    if ($stock_info) {
        $stockID = $stock_info['stockID'];
        $new_stockOut = $stock_info['stockOut'] + $quantity_change; // Adjust stockOut
        $new_totalstock = $stock_info['stockIn'] - $new_stockOut;  // Calculate totalstock
        $new_status = ($new_totalstock > 0) ? 'In Stock' : 'Out of Stock'; // Set status

        // Update stock table
        $update_query = "UPDATE stock SET stockOut = $new_stockOut, totalstock = $new_totalstock, status = '$new_status' WHERE stockID = '$stockID'";
        mysqli_query($conn, $update_query) or die('Query failed');

        // Update product table to match stock's totalstock
        $product_update_query = "UPDATE product SET stock = $new_totalstock WHERE productID = '$product_id'";
        mysqli_query($conn, $product_update_query) or die('Query failed');
    }
}

// Handle cart update
if (isset($_POST['update_cart'])) {
    $cart_id = $_POST['cart_id'];
    $new_quantity = $_POST['cart_quantity'];

    // Get the old cart quantity
    $old_quantity = getCartQuantity($conn, $cart_id);

    // Calculate quantity change
    $quantity_change = $new_quantity - $old_quantity; // Positive for adding, negative for removing

    // Update cart quantity
    $update_cart_query = "UPDATE cart SET quantity = '$new_quantity' WHERE cartID = '$cart_id'";
    mysqli_query($conn, $update_cart_query) or die('Query failed');

    // Get the product ID for stock update
    $product_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT productID FROM cart WHERE cartID = '$cart_id'"))['productID'];

    // Update stock information
    updateStock($conn, $product_id, $quantity_change);

    $message[] = 'Cart quantity updated and stock adjusted!';
}

// Handle cart item deletion
if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];

   // Get the quantity before deletion
   $quantity = getCartQuantity($conn, $delete_id);

   // Get the product ID
   $product_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT productID FROM cart WHERE cartID = '$delete_id'"))['productID'];

   // Adjust stock before deletion
   updateStock($conn, $product_id, -$quantity); // Since we're removing, we decrease stockOut

   // Delete the cart item
   mysqli_query($conn, "DELETE FROM cart WHERE cartID = '$delete_id'") or die('Query failed');
   header('location:cart.php');
   exit();
}

// Handle deleting all cart items
if (isset($_GET['delete_all'])) {
   $select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE touristID = '$user_id'") or die('query failed');
   while ($cart = mysqli_fetch_assoc($select_cart)) {
       $product_id = $cart['productID'];
       $quantity = $cart['quantity'];
       updateStock($conn, $product_id, -$quantity); // Adjust stockOut as we remove all items
   }

   // Delete all cart items
   mysqli_query($conn, "DELETE FROM cart WHERE touristID = '$user_id'") or die('query failed');
   header('location:cart.php');
   exit();
}

// Get cart details and product information
$select_cart = mysqli_query($conn, "SELECT cart.*, product.productname, product.productprice, product.productimage 
    FROM cart 
    JOIN product ON cart.productID = product.productID 
    WHERE cart.touristID = '$user_id'") or die('Query failed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Cart</title>

   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<section class="shopping-cart">
   <h1 class="title">Products Added</h1>

   <div class="box-container">
      <?php
         $grand_total = 0;
         if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
   ?>
   <div class="box">
      <a href="cart.php?delete=<?php echo $fetch_cart['cartID']; ?>" class="fas fa-times" onclick="return confirm('Delete this from cart?');"></a>
      <img src="assets/<?php echo $fetch_cart['productimage']; ?>" alt="">
      <div class="name"><?php echo $fetch_cart['productname']; ?></div>
      <div class="price">RM<?php echo $fetch_cart['productprice']; ?></div>
      <form action="" method="post">
         <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['cartID']; ?>">
         <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
         <input type="submit" name="update_cart" value="Update" class="option-btn">
      </form>
      <div class="sub-total"> Subtotal: <span>RM<?php echo ($fetch_cart['quantity'] * $fetch_cart['productprice']); ?>.00</span> </div>
   </div>
   <?php
      $grand_total += $fetch_cart['quantity'] * $fetch_cart['productprice'];
         }
      } else {
         echo '<p class="empty">Your cart is empty</p>';
      }
   ?>
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>" onclick="return confirm('Delete all from cart?');">Delete All</a>
   </div>

   <div class="cart-total">
      <p>Grand Total: <span>RM<?php echo $grand_total; ?>.00</span></p>
      <div class="flex">
         <a href="product.php" class="option-btn">Continue Shopping</a>
         <a href="checkout.php" class="btn <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
      </div>
   </div>

</section>

<?php include 'footer.php'; ?>

<!-- Custom JS -->
<script src="js/script.js"></script>

</body>
</html>
