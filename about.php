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
   <h3>WANISMA CRAFT & TRADING</h3>
   <!-- <p> <a href="home.php">home</a> / about </p> -->
</div>

<section class="about">
   <div class="flex">
      <div class="image">
         <img src="assets/about-1.png" alt="">
      </div>
      <div class="content">
         <p>Wanisma Craft & Trading Company is one of the companies that runs the business of copper-based goods. 
            This company is one of the companies passed down from one generation to the next, from father to son. 
            Basically, it was run by <b>Hj, Wan Ismail Bin Wan Omar</b> together with his wife <b>Hjh Nik Rakna Binti Nik Embong</b> 
            in <b>1948</b>. 
            This enterprise grew from one level to another, until it produced sarong batik under the <b>Batik Puteri Rakna</b> brand in 
            <b>1968</b> and grew until he died in 1995. He had also received the State of Terengganu craft figure award in 1992 by the 
            former Menteri Besar of Terengganu Dato' Seri Wan Mokhtar Ahmad.
           <br>  
           After his passing, the business was taken over by his son, Wan Mahadi Bin Ismail, in 1995 and registered under the 
           name WANISMA CRAFT & TRADING. With his determination and initiative, he further developed the business to a higher level.   
         </p>
      </div>
   </div> <br>

   <div class="section">
    <div class="image-grid-2">
        <img src="assets/kilat.png" alt="Copper Product 1">
        <img src="assets/cuci.png" alt="Copper Product 2">
        <img src="assets/nempel.png" alt="Copper Product 3">
        <img src="assets/IMG_4883.png" alt="Copper Product 4">
    </div>
    <br><br>
    <h3>ABOUT WANISMA BRASS</h3>
    <br>
    <div class="text-container">
        <p>
            This copper enterprise serves as an identity for the state of Terengganu Darul Iman and attracts tourists from both domestic
            and international destinations to witness the rich local folk art, abundant with delicate handiwork. 
            These copper products are branded as Wanisma Brass, a blend of five types of metals including bronze, in proportions as 
            determined.
        </p>
        <p>
            The copper products produced include wedding items such as pahar, tepak sireh, dulang, rose water sprinklers, 
            and many others, as well as cookie molds and souvenirs. This company also makes royal items such as scepters, belt buckles, 
            decorative eggs, palace interior decorations, mosque pulpits, and many more. This company is the largest producer of 
            copper goods in the state of Terengganu Darul Iman.
        </p>
    </div>
    <br>
    
</div>
    <br><br>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
