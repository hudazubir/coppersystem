<?php
include 'config.php'; // Include the database connection file

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location: login.php');
    exit();
}

// Fetch total_price from session
if (isset($_SESSION['total_price'])) {
    $amount = $_SESSION['total_price'];
} else {
    $amount = 0; // Set a default value or handle as needed
}

// Handle file upload when form is submitted
if (isset($_POST['upload_proof'])) {
    // Check if file was uploaded without errors
    if (isset($_FILES['proof']) && $_FILES['proof']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['proof']['tmp_name'];
        $file_name = $_FILES['proof']['name'];

        // Move uploaded file to desired location
        $upload_dir = "assets/"; // Directory where uploaded files will be stored
        $file_path = $upload_dir . $file_name;
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Insert payment details into the database
            $insert_query = "INSERT INTO payments (touristID, transaction_id, amount, payment_method, payment_status, receipt_path) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insert_query);
            $transaction_id = "YourTransactionIDHere"; // You might generate a unique transaction ID here
            $payment_method = "Online Banking"; // Adjust according to your payment method
            $payment_status = 'pending';
            mysqli_stmt_bind_param($stmt, "isdsss", $user_id, $transaction_id, $amount, $payment_method, $payment_status, $file_path);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                // Update payment status in touristorder table
                $update_order_query = "UPDATE touristorder SET payment_status = 'Paid' WHERE touristID = ? AND payment_status = 'Pending'";
                $stmt_update = mysqli_prepare($conn, $update_order_query);
                mysqli_stmt_bind_param($stmt_update, "i", $user_id);
                mysqli_stmt_execute($stmt_update);
                
                $message = "Payment proof uploaded successfully.";
            } else {
                $message = "Failed to upload payment proof.";
            }

            mysqli_stmt_close($stmt);
            mysqli_stmt_close($stmt_update);
        } else {
            $message = "Error uploading file.";
        }
    } else {
        $message = "No file uploaded or file upload error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Payment</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
   <!-- Add your custom CSS files here -->
</head>
<body>

<?php include 'header.php'; ?>

<div class="payment-details">
    <h1>Payment Details</h1>
    
    <!-- Display payment options -->
    <div class="payment-options">
        <p>Please upload proof of payment:</p>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="proof" accept="image/*,application/pdf" required>
            <input type="submit" value="Upload Proof" name="upload_proof">
        </form>
    </div>

    <!-- Display message -->
    <?php if (isset($message)) { ?>
        <div class="message"><?php echo $message; ?></div>
    <?php } ?>
</div>

<!-- Add any necessary JavaScript scripts here -->

</body>
</html>
