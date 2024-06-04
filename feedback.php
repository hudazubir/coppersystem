<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $feedback_type = mysqli_real_escape_string($conn, $_POST['feedback_type']);
   $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

   $select_feedback = mysqli_query($conn, "SELECT * FROM `feedback` WHERE name = '$name' AND email = '$email' AND feedback_type = '$feedback_type' AND feedback = '$feedback'") or die('query failed');

   if(mysqli_num_rows($select_feedback) > 0){
      $message[] = 'Feedback already submitted!';
   }else{
      mysqli_query($conn, "INSERT INTO `feedback`(touristID, name, email, feedback_type, feedback) VALUES('$user_id', '$name', '$email', '$feedback_type', '$feedback')") or die('query failed');
      $message[] = 'Feedback submitted successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Feedback</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Provide Your Feedback</h3>
   <!-- <p> <a href="home.php">home</a> / feedback </p> -->
</div>

<section class="feedback">

   <form action="" method="post">
      <h3>Share Your Feedback!</h3>
      <input type="text" name="name" required placeholder="Enter your name" class="box">
      <input type="email" name="email" required placeholder="Enter your email" class="box">
      <select name="feedback_type" class="box">
         <option value="General">General Feedback</option>
         <option value="Bug">Bug Report</option>
         <option value="Feature">Feature Request</option>
         <!-- Add more options as needed -->
      </select>
      <textarea name="feedback" class="box" placeholder="Enter your feedback" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Submit Feedback" name="send" class="btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
