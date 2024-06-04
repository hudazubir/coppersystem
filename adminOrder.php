<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

// Set the number of orders per page
$orders_per_page = 5;

// Get the current page number from the URL, default is 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1; // Ensure the page number is at least 1

// Calculate the starting row for the query
$start_from = ($page - 1) * $orders_per_page;

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn, "UPDATE `touristorder` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
    $message[] = 'Payment status has been updated!';
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `touristorder` WHERE id = '$delete_id'") or die('query failed');
    header('location:adminOrder.php');
}

// Fetch total number of orders to calculate pagination
$total_orders_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM `touristorder`") or die('query failed');
$total_orders = mysqli_fetch_assoc($total_orders_query)['total'];
$total_pages = ceil($total_orders / $orders_per_page);

$select_orders = mysqli_query($conn, "SELECT * FROM `touristorder` LIMIT $start_from, $orders_per_page") or die('query failed');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin.css">

<style>
.pagination {
    text-align: center;
    margin: 20px 0;
}

.pagination a {
    padding: 10px 15px;
    margin: 5px;
    border: 1px solid #ccc;
    text-decoration: none;
    color: #333;
    display: inline-block;
}

.pagination a:hover {
    background-color: #f0f0f0;
}

.pagination a.active {
    background-color: #333;
    color: #fff;
    border-color: #333;
}
</style>

</head>
<body>
   
<?php include 'adminHeader.php'; ?>

<section class="orders">
    <h1 class="title">Placed Orders</h1>

    <?php if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message">'.$message.'</div>';
        }
    } ?>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Number</th>
                    <!-- <th>Email</th> -->
                    <th>Address</th>
                    <th>Products</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>Receipt</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($select_orders) > 0) {
                    while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                ?>
                <tr>
                    <td><?php echo $fetch_orders['id']; ?></td>
                    <td><?php echo $fetch_orders['placed_on']; ?></td>
                    <td><?php echo $fetch_orders['fullname']; ?></td>
                    <td><?php echo $fetch_orders['phonenumber']; ?></td>
                    <!-- <td><?php //echo $fetch_orders['email']; ?></td> -->
                    <td><?php echo $fetch_orders['address']; ?></td>
                    <td><?php echo $fetch_orders['total_product']; ?></td>
                    <td>RM<?php echo $fetch_orders['total_price']; ?></td>
                    <td><?php echo $fetch_orders['method']; ?></td>
                    <td>
                        <?php
                        if (!empty($fetch_orders['receipt'])) {
                            echo '<a href="' . $fetch_orders['receipt'] . '" target="_blank">View Receipt</a>';
                        } else {
                            echo 'No Receipt';
                        }
                        ?>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                            <select name="update_payment">
                                <option value="<?php echo $fetch_orders['payment_status']; ?>" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                                <option value="Pending">Pending</option>
                                <option value="Completed">Completed</option>
                                <option value="Successful">Successful</option>
                            </select>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="submit" name="update_order" class="option-btn">
                                <i class="fas fa-edit"></i>
                            </button>
                        </form>
                        <a href="adminOrder.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Delete this order?');" class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="12" class="empty">No orders placed yet!</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination controls -->
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="adminOrder.php?page=<?php echo $page - 1; ?>">&laquo;</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="adminOrder.php?page=<?php echo $i; ?>" class="<?php if ($page == $i) echo 'active'; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="adminOrder.php?page=<?php echo $page + 1; ?>">&raquo;</a>
        <?php endif; ?>
    </div>
</section>

<!-- custom admin js file link  -->
<script src="js/adminScript.js"></script>

</body>
</html>