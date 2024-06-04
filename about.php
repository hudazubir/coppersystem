<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <!-- <p> <a href="home.php">home</a> / about </p> -->
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="assets/about-1.png" alt="">
      </div>

      <div class="content">
         <h3>WANISMA CRAFT & TRADING</h3>
         <p>Wanisma Craft & Trading Company is one of the companies that runs the business of copper-based goods. 
            This company is one of the companies passed down from one generation to the next, from father to son. 
            Basically, it was run by <b>Hj, Wan Ismail Bin Wan Omar</b> together with his wife <b>Hjh Nik Rakna Binti Nik Embong</b> 
            in <b>1948</b>. 
            This enterprise grew from one level to another, until it produced sarong batik under the <b>Batik Puteri Rakna</b> brand in 
            <b>1968</b> and grew until he died in 1995. He had also received the State of Terengganu craft figure award in 1992 by the 
            former Menteri Besar of Terengganu Dato' Seri Wan Mokhtar Ahmad.
           <br>  
            This copper enterprise serves as an identity for the state of Terengganu Darul Iman and attracts tourists from both domestic
            and international destinations to witness the rich local folk art, abundant with delicate handiwork. 
            These copper products are branded as Wanisma Brass, a blend of five types of metals including bronze, in proportions as 
            determined.   
         </p>
      </div>

   </div>
</section>

<!-- <section class="authors">

   <h1 class="title">greate authors</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/author-1.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/author-2.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
         </div>
         <h3>john deo</h3>
      </div>

      <div class="box">
         <img src="images/author-3.jpg" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
         </div>
         <h3>john deo</h3>
      </div>

   </div>

</section> -->







<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>