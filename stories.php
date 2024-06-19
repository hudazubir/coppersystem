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
   <title>stories</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Copper Manufacturing</h3>
   <!-- <p> <a href="home.php">home</a> / about </p> -->
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="assets/items-2.png" alt="">
      </div>

      <div class="content">
         <h3>WHAT COPPER</h3>
         <p>
         Copperware is a heritage product that has been passed down through generations, proudly representing Terengganu alongside 
         songket and batik. Originally, Kampung Ladang was renowned for copperware production, and that's where our workshop used 
         to be located. However, due to development initiatives, we've relocated to a new site in Kampung Pulau Kerengga, Marang.</p>
         <p>
         The copper products produced include wedding items such as pahar, tepak sireh, dulang, rose water sprinklers, 
         and many others, as well as cookie molds and souvenirs. This company also makes royal items such as scepters, belt buckles, 
         decorative eggs, palace interior decorations, mosque pulpits, and many more. This company is the largest producer of 
         copper goods in the state of Terengganu Darul Iman.</p>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">COPPER FORMATION</h1>

   <div class="box-container">

      <div class="box">
         <img src="assets/lilin.png" alt="">
         <p>The process of shaping wood to serve as a reference base and framework for creating the form and patterns of the intended goods..</p>
            <!-- Proses membentuk kayu untuk dijadikan asas acuan dan merangka bentuk dan corak barang yang akan dihasilkan. -->
         <!-- <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div> -->
         <h3>Forming</h3>
      </div>

      <div class="box">
         <img src="assets/lilin1.png" alt="">
         <p>The process involves making a mold or core shape of the desired item. The mold is dipped into wax repeatedly to achieve
            the desired thickness.
            <!-- Proses membuat kelonsong atau teras bentuk barang yang diingini. Acuan dicelup ke dalam lilin berulang kali mengikut 
            ketebalan yang dikehendaki. Kemudian lilin dilarik supaya seimbang dan sama rata, sesuai dengan bentuk luar barang itu.  -->
            <!-- Lilin yang telah siap dilarik, ditampalkan dengan tiga lapisan tanah liat halus. --> </p>
         <!-- <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div> -->
         <h3>Making Molds</h3>
      </div>

      <div class="box">
         <img src="assets/cuci.png" alt="">
         <p>The process involves melting the metal mixture and pouring it into the mold. Copper is melted in a special container using a 
            furnace called a "relau" flame. The relau flame is also used to melt the wax inside the fine clay. The molten wax is poured out, 
            leaving cavities that form the mold. When the mold is fired, the wax melts and absorbs into the mold mix.</p>
         <!-- <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div> -->
         <h3>Melting / Pouring</h3>
      </div>

      <div class="box">
         <img src="assets/kilat.png" alt="">
         <p>This process involves finishing work, including washing, deburring, polishing, and buffing. Any black spots and excess 
            metal on the items removed from the mold are carefully removed. Features that cannot be formed within the mold are refined. 
            Then, the items are rubbed with sandpaper and polished with a type of chemical to provide a smooth and glossy finish.</p>
         <!-- <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div> -->
         <h3>Washing / Polishing</h3>
      </div>
   </div>

</section>

<section class="authors">

   <h1 class="title">copper founder</h1>

   <div class="box-container">
      <div class="box">
         <img src="assets/author.png" alt="">
         <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
         </div>
         <h3>Encik Saiful</h3>
      </div>

   </div>

</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>