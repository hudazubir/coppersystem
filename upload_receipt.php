<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_POST['upload_receipt'])) {
    $order_id = $_POST['order_id'];
    $receipt = '';

    if (isset($_FILES['receipt']['name']) && $_FILES['receipt']['name'] != '') {
        $receipt = 'assets/' . time() . '_' . $_FILES['receipt']['name'];
        move_uploaded_file($_FILES['receipt']['tmp_name'], $receipt);

        mysqli_query($conn, "UPDATE `touristorder` SET receipt = '$receipt' WHERE id = '$order_id'") or die('query failed');
        $message[] = 'Receipt uploaded successfully!';
    } else {
        $message[] = 'Please upload a receipt!';
    }
}

$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : 0;
$amount = isset($_GET['amount']) ? $_GET['amount'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Receipt</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
    <h3>Upload Receipt</h3>
</div>

<section class="upload-receipt">
    <?php //if (isset($message)) {
        // foreach ($message as $message) {
        //     echo '<div class="message">'.$message.'</div>';
        // }
 //   } ?>

    <form action="" method="post" enctype="multipart/form-data">
        <h3>Payment Information</h3>
        <p>Please transfer the total amount of <strong>RM<?php echo $amount; ?>.00</strong> to the following account number or scan the QR code.</p>
        <p>Account Number: <strong>162807149701 - MAYBANK BERHAD </strong></p>
        <img src="assets/qrcode.png" alt="QR Code" style="width:200px;height:200px;">

        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
        
        <div class="inputBox">
            <span>Upload Receipt</span>
            <input type="file" name="receipt" required>
        </div>
        
        <input type="submit" value="Upload Receipt" class="btn" name="upload_receipt">
    </form>
</section>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
