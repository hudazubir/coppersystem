<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $numberphone = $_POST['numberphone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'orders_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($payment_method == 'COD') {
        // Insert order into database with status 'Pending'
        $sql = "INSERT INTO orders (fullname, numberphone, email, address, payment_method, status)
                VALUES ('$fullname', '$numberphone', '$email', '$address', 'Cash on Delivery', 'Pending')";

        if ($conn->query($sql) === TRUE) {
            echo "Order placed successfully! Your order status is 'Pending'.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif ($payment_method == 'Online') {
        // Save the order data in session and redirect to upload receipt page
        session_start();
        $_SESSION['order_data'] = [
            'fullname' => $fullname,
            'numberphone' => $numberphone,
            'email' => $email,
            'address' => $address,
            'payment_method' => 'Online Banking'
        ];
        header('Location: upload_receipt.php');
        exit();
    }

    $conn->close();
}
?>
