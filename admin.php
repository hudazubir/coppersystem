<?php
// Ensure only authorized users can access this page (authentication is needed in a real application)

$conn = new mysqli('localhost', 'root', '', 'orders_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status='$status' WHERE id=$order_id";

    if ($conn->query($sql) === TRUE) {
        echo "Order status updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch all orders
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

h1, h2 {
    color: #333;
    text-align: center;
    margin: 20px 0;
}

table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

table th {
    background-color: #f2f2f2;
}

table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:hover {
    background-color: #f1f1f1;
}

form {
    display: inline-block;
    margin: 0;
}

form select, form button {
    padding: 5px;
    font-size: 14px;
    margin-right: 10px;
}

form button {
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 4px;
}

form button:hover {
    background-color: #45a049;
}

a {
    color: #0066cc;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

.message {
    width: 90%;
    margin: 20px auto;
    padding: 10px;
    background-color: #dff0d8;
    color: #3c763d;
    border: 1px solid #d6e9c6;
    border-radius: 4px;
    text-align: center;
}

.error {
    width: 90%;
    margin: 20px auto;
    padding: 10px;
    background-color: #f2dede;
    color: #a94442;
    border: 1px solid #ebccd1;
    border-radius: 4px;
    text-align: center;
}

    </style>
</head>
<body>
    <h1>Admin Panel</h1>
    <h2>All Orders</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Payment Method</th>
            <th>Receipt</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $receiptLink = $row['receipt'] ? "<a href='uploads/{$row['receipt']}'>View Receipt</a>" : "N/A";
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['fullname']}</td>
                        <td>{$row['numberphone']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['payment_method']}</td>
                        <td>$receiptLink</td>
                        <td>{$row['status']}</td>
                        <td>
                            <form action='admin.php' method='post'>
                                <input type='hidden' name='order_id' value='{$row['id']}'>
                                <select name='status'>
                                    <option value='Pending' " . ($row['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                    <option value='Completed' " . ($row['status'] == 'Completed' ? 'selected' : '') . ">Completed</option>
                                    <option value='Successful' " . ($row['status'] == 'Successful' ? 'selected' : '') . ">Successful</option>
                                </select>
                                <button type='submit'>Update</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No orders found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
