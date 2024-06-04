<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order</title>
    <link rel="stylesheet" href="css/stylecss.css">
</head>
<body>
    <h1>Place Your Order</h1>
    <form action="process_order.php" method="post">
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required><br>

        <label for="numberphone">Phone Number:</label>
        <input type="text" id="numberphone" name="numberphone" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea><br>

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="COD">Cash on Delivery</option>
            <option value="Online">Online Banking</option>
        </select><br>

        <button type="submit">Place Order</button>
    </form>
</body>
</html>
