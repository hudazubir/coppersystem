<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $productID = mysqli_real_escape_string($conn, $_POST['productID']); // Get productID from form
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_product = mysqli_query($conn, "SELECT productName, productID FROM product WHERE productName = '$name' OR productID = '$productID'") or die('query failed');

   if(mysqli_num_rows($select_product) > 0){
      $row = mysqli_fetch_assoc($select_product);
      $existingProductName = $row['productName'];
      $existingProductID = $row['productID'];
   
      if ($existingProductID === $productID) {
          $message[] = "Product with ID '$existingProductID' already exists";
      } 
      
      if ($existingProductName === $name) {
          $message[] = "Product Name '$existingProductName' already exists";
      }
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO product(productID, productName, productPrice, productImage) VALUES('$productID', '$name', '$price', '$image')") or die('query failed');

      if($add_product_query){
         if($image_size > 200000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}


if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT productImage FROM product WHERE productID = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM product WHERE productID = '$delete_id'") or die('query failed');
   header('location:adminProduct.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE product SET productName = '$update_name', productPrice = '$update_price' WHERE productID = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 200000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE products SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:adminProduct.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin.css">

</head>
<body>
   
<?php include 'adminHeader.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-products">
   <h1 class="title">Product Copper</h1>
   <form action="" method="post" enctype="multipart/form-data">
      <h3>Add Product</h3>
      <input type="text" name="productID" class="box" placeholder="Enter Product ID" required>
      <input type="text" name="name" class="box" placeholder="Enter Product Name" required>
      <input type="number" min="0" name="price" class="box" placeholder="Enter Product Price" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="submit" value="Add Product" name="add_product" class="btn">
   </form>
</section>


<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-products">

   <div class="box-container">
   <?php
         $select_products = mysqli_query($conn, "SELECT * FROM product") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <img src="uploaded_img/<?php echo $fetch_products['productImage']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['productName']; ?></div>
         <div class="price">RM<?php echo $fetch_products['productPrice']; ?></div>
         <a href="adminProduct.php?update=<?php echo $fetch_products['productID']; ?>" class="option-btn">update</a>
         <a href="adminProduct.php?delete=<?php echo $fetch_products['productID']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

</section>

<section class="edit-product-form">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM product WHERE productID = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['productID']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['productImage']; ?>">
      <img src="uploaded_img/<?php echo $fetch_update['productImage']; ?>" alt="">
      <input type="text" name="update_name" value="<?php echo $fetch_update['productName']; ?>" class="box" required placeholder="Enter product name">
      <input type="number" name="update_price" value="<?php echo $fetch_update['productPrice']; ?>" min="0" class="box" required placeholder="Enter product price"> 
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="update" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-update" class="option-btn">
   </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
   ?>

</section>


<!-- custom admin js file link  -->
<script src="js/adminScript.js"></script>

</body>
</html>