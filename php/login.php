<?php
require "components/connect.php";
session_start();


if(isset($_POST['submit'])){

   function validate($data){
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
   }

   $emailusers = validate($_POST['email']);
   $pass2 = validate($_POST['pass']);

   if(empty($emailusers)){
      echo '<script>alert("email is empty")</script>';
   }
   else if(empty($pass2)){
      echo '<script>alert("password is empty")</script>';
   }
   else { 
      $login = $conn->prepare("SELECT * FROM `user` WHERE email='$emailusers' AND user_password='$pass2'");
      $login->execute();
      $data = $login->fetch(PDO::FETCH_ASSOC);

      if($login->rowCount() > 0)
      {
         if($pass2 == $data['user_password'])
         { 
            $_SESSION['user_id'] = $data['user_id'];
            if($data['Role_id']==1)
            {
               #adminpage
               header('location:../html/AdminLandPage.html');
            }
            elseif($data['Role_id']==2)
            {
               #userpage
               header('location:../php/viewrecipes.php');
            }
            else{
               #temppage for new constructions
               header('location:../html/underconstruction.html');
            }
           
         }
         else{
            echo '<script>alert("Incorrect data")</script>';
         }
      }
      else{
         echo '<script>alert("Incorrect data")</script>';
      }
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">
   
 

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<!-- login section starts  -->

<section class="account-form">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>welcome back!</h3>
      <p class="placeholder">your email <span>*</span></p>
      <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
      <p class="placeholder">your password <span>*</span></p>
      <input type="password" name="pass" required maxlength="50" placeholder="enter your password" class="box">
      <p class="link">don't have an account? <a href="register.php">register now</a></p>
      <input type="submit" value="login now" name="submit" class="btn">
   </form>

</section>

<!-- login section ends -->














<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>
