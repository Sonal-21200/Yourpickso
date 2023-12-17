<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['update_order'])){

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
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

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">
      <?php
      $select_payments = mysqli_query($conn, "SELECT * FROM `payments`") or die('query failed');
      if(mysqli_num_rows($select_payments) > 0){
         while($fetch_payments = mysqli_fetch_assoc($select_payments)){
      ?>
      <div class="box">
      <p> placed on : <span><?php echo $fetch_payments['created_at']; ?></span> </p>
         <p> name : <span><?php echo $fetch_payments['payer_name']; ?></span> </p>
         <p> email : <span><?php echo $fetch_payments['payer_email']; ?></span> </p>
         <p> payer id : <span><?php echo $fetch_payments['payer_id']; ?></span> </p>
         <p> payment id : <span><?php echo $fetch_payments['payment_id']; ?></span> </p>
         <p> product name : <span><?php echo $fetch_payments['item_name']; ?></span> </p>
         <p> payment status : <span><?php echo $fetch_payments['status']; ?></span> </p>
            </select>
            <input type="submit" value="update" name="update_order" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_payments['id']; ?>" onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>










<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>
</html>