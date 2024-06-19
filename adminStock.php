<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
    header('Location: login.php');
    exit();
}

$message = [];

// Handle form submission for adding new stock
if (isset($_POST['add_stock'])) {
    $product_id = $_POST['product_id'];
    $stock_in = intval($_POST['stock_in']);

    $stock_out = 0;
    $total_stock = $stock_in;

    $insert_stock_query = "INSERT INTO stock (productID, stockIn, stockOut, totalstock, status) VALUES ('$product_id', $stock_in, $stock_out, $total_stock, 'instock')";

    if (mysqli_query($conn, $insert_stock_query)) {
        $message[] = 'Stock added successfully!';
    } else {
        $message[] = 'Error adding stock: ' . mysqli_error($conn);
    }
}

// Handle form submission for updating stock
if (isset($_POST['update_stock'])) {
    $stock_id = intval($_POST['stock_id']);
    $stock_in = intval($_POST['stock_in']);
    $stock_out = intval($_POST['stock_out']);

    $current_stock_query = "SELECT totalstock FROM stock WHERE stockID = '$stock_id'";
    $current_stock_result = mysqli_query($conn, $current_stock_query);
    if ($current_stock_result && mysqli_num_rows($current_stock_result) > 0) {
        $current_stock_assoc = mysqli_fetch_assoc($current_stock_result);
        $current_total_stock = intval($current_stock_assoc['totalstock']);

        $new_total_stock = $current_total_stock + $stock_in - $stock_out;

        $status = 'In Stock';
        if ($new_total_stock <= 0) {
            $status = 'Out of Stock';
        } else if ($new_total_stock <= 2) {
            $status = 'Low';
        }

        $update_stock_query = "UPDATE stock SET stockIn = stockIn + $stock_in, stockOut = stockOut + $stock_out, totalstock = $new_total_stock, status = '$status' WHERE stockID = '$stock_id'";

        if (mysqli_query($conn, $update_stock_query)) {
            $message[] = 'Stock updated successfully!';
        } else {
            $message[] = 'Error updating stock: ' . mysqli_error($conn);
        }
    } else {
        $message[] = 'Error fetching stock details: ' . mysqli_error($conn);
    }
}

// Fetch existing products for dropdown
$product_query = "SELECT productID, productName FROM product";
$product_result = mysqli_query($conn, $product_query);

// Execute the Python script and fetch the results
$command = escapeshellcmd('python3 sma_method/calculate_averages.py');
$output = shell_exec($command);
$averages = json_decode($output, true);

// Initialize average stock and average price to default values
$average_stock = 0;
$average_price = 'RM 0.00';

// Check if averages were calculated correctly
if (is_array($averages)) {
    if (isset($averages['average_stock'])) {
        $average_stock = $averages['average_stock'];
    }
    if (isset($averages['average_price'])) {
        $average_price = $averages['average_price'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Stock Management</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin.css">

</head>
<body>

<?php include 'adminHeader.php'; ?>

<section class="stock-management">
    <h1 class="title">Product Stock</h1>
    
    <?php
    if (!empty($message)) {
        foreach ($message as $message) {
            echo "<div class='message'>$msg</div>";
        }
    }
    ?>

    <!-- Form to add new stock -->
    <form action="" method="post" class="add-stock-form">
        <h2>Add New Stock</h2>
        <label for="product_id">Select Product:</label>
        <select name="product_id" required>
            <option value="">Select</option>
            <?php
            if ($product_result && mysqli_num_rows($product_result) > 0) {
                while ($product = mysqli_fetch_assoc($product_result)) {
                    echo "<option value='{$product['productID']}'>Product ID: {$product['productID']} - {$product['productName']}</option>";
                }
            }
            ?>
        </select>

        <label for="stock_in">Stock In:</label>
        <input type="number" name="stock_in" min="0" required>

        <input type="submit" name="add_stock" value="Add Stock">
    </form>

    <br>

    <!-- Form to update stock -->
    <form action="" method="post" class="update-stock-form">
        <h2>Update Stock</h2>
        <label for="stock_id">Select Stock to Update:</label>
        <select name="stock_id" required>
            <option value="">Select</option>
            <?php
            $stock_query = "SELECT stockID, productID, totalstock FROM stock";
            $stock_result = mysqli_query($conn, $stock_query);
            if ($stock_result && mysqli_num_rows($stock_result) > 0) {
                while ($stock = mysqli_fetch_assoc($stock_result)) {
                    echo "<option value='{$stock['stockID']}'>Stock ID: {$stock['stockID']} (Total: {$stock['totalstock']})</option>";
                }
            }
            ?>
        </select>

        <label for="stock_in">Stock In:</label>
        <input type="number" name="stock_in" min="0">

        <label for="stock_out">Stock Out:</label>
        <input type="number" name="stock_out" min="0">

        <input type="submit" name="update_stock" value="Update Stock">
    </form>
    <br>
    <!-- Display average stock and average price -->
    <!-- <div class="averages">
        <h2>Averages</h2>
        <p><strong>Average Stock Level:</strong> <?php //echo round($average_stock, 2); ?></p>
        <p><strong>Average Price:</strong> <?php //echo $average_price; ?></p>
    </div> -->

</section>

<script src="js/adminScript.js"></script>

</body>
</html>
