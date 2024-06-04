<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `login_register` WHERE id = '$delete_id'") or die('query failed');
   header('location:adminUser.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin.css">

</head>
<body>
   
<?php include 'adminHeader.php'; ?>

<section class="users">
   <h1 class="title">User Accounts</h1>
   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>ID</th>
               <th>Username</th>
               <th>Email</th>
               <th>User Type</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $select_users = mysqli_query($conn, "SELECT * FROM `login_register`") or die('query failed');
               while($fetch_users = mysqli_fetch_assoc($select_users)){
            ?>
            <tr>
               <td><?php echo $fetch_users['id']; ?></td>
               <td><?php echo $fetch_users['username']; ?></td>
               <td><?php echo $fetch_users['email']; ?></td>
               <td style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'var(--orange)'; } ?>"><?php echo $fetch_users['user_type']; ?></td>
               <td>
                  <a href="adminUser.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('Delete this user?');" class="delete-btn">Delete User</a>
               </td>
            </tr>
            <?php
               };
            ?>
         </tbody>
      </table>
   </div>
</section>


<!-- custom admin js file link  -->
<script src="js/adminScript.js"></script>

</body>
</html>