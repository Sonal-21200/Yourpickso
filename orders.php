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
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>your orders</h3>
   <p> <a href="home.php">home</a> / orders </p>
</div>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
         $payments_query = mysqli_query($conn, "SELECT * FROM `payments` ") or die('query failed');
         if(mysqli_num_rows($payments_query) > 0){
            while($fetch_payments = mysqli_fetch_assoc($payments_query)){
      ?>
      <div class="box">
      <p> placed on : <span><?php echo $fetch_payments['created_at']; ?></span> </p>
         <p> name : <span><?php echo $fetch_payments['payer_name']; ?></span> </p>
         <p> email : <span><?php echo $fetch_payments['payer_email']; ?></span> </p>
         <p> payer id : <span><?php echo $fetch_payments['payer_id']; ?></span> </p>
         <p> payment id : <span><?php echo $fetch_payments['payment_id']; ?></span> </p>
         <p> product name : <span><?php echo $fetch_payments['item_name']; ?></span> </p>
         <p> payment status : <span><?php echo $fetch_payments['status']; ?></span> </p>
      </div>
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>








<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>