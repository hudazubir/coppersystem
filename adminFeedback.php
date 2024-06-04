<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `feedback` WHERE id = '$delete_id'") or die('query failed');
   header('location:adminFeedback.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin.css">

</head>
<body>
   
<?php include 'adminHeader.php'; ?>

<!-- Display any success or error messages -->
<?php
// if(isset($message)) {
//    foreach($message as $message) {
//        echo '<div class="alert">' . $message . '</div>';
//    }
// }
?>

<section class="messages">
   <h1 class="title">Messages</h1>
   <div class="table-container">
      <table>
         <thead>
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Feedback Type</th>
               <th>Email</th>
               <th>Message</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $select_message = mysqli_query($conn, "SELECT * FROM `feedback`") or die('query failed');
               if(mysqli_num_rows($select_message) > 0){
                  while($fetch_message = mysqli_fetch_assoc($select_message)){
            ?>
            <tr>
               <td><?php echo $fetch_message['id']; ?></td>
               <td><?php echo $fetch_message['name']; ?></td>
               <td><?php echo $fetch_message['feedback_type']; ?></td>
               <td><?php echo $fetch_message['email']; ?></td>
               <td><?php echo $fetch_message['feedback']; ?></td>
               <td>
                  <a href="adminFeedback.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Delete this message?');" class="delete-btn">Delete Message</a>
               </td>
            </tr>
            <?php
                  };
               }else{
                  echo '<tr><td colspan="6" class="empty">You have no messages!</td></tr>';
               }
            ?>
         </tbody>
      </table>
   </div>
</section>


<!-- custom admin js file link  -->
<script src="js/adminScript.js"></script>

</body>
</html>