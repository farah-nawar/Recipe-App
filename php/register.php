<?php
require "components/connect.php";
session_start();

if (isset($_POST['submit'])) {
    function validate2($data1){
        $data1 = trim($data1);
        $data1= stripslashes($data1);
        $data1 = htmlspecialchars($data1);
        return $data1;
    }

    $role_id = 2;
    $username = validate2($_POST['username']);
    $user_password = validate2($_POST['user_password']);
    $email = validate2($_POST['email']);
    $c_pass = validate2($_POST['c_pass']);

    $verify_email = $conn->prepare("SELECT * FROM `user` WHERE email = ?");
    $verify_email->execute([$email]);

    $row_count = $verify_email->fetchAll();
    if (count($row_count) > 0) {
        $warning_msg[] = 'Email already taken!';
    } else {
        if ($user_password !== $c_pass) {
            echo '<script>alert("passwords do not match. Please enter matching passwords")</script>';
        } else {
            $insert_user = $conn->prepare("INSERT INTO `user`(`role_id`, `username`, `user_password`, `email`) VALUES(:role_id, :username, :user_password, :email)");
            $insert_user->execute([
                ':role_id' => $role_id,
                ':username' => $username,
                ':user_password' => $user_password,
                ':email' => $email
            ]);
            $success_msg[] = 'Registered successfully!';
            header('location:../php/login.php');
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
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/header.php'; ?>
<!-- header section ends -->

<section class="account-form">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>make your account!</h3>
      <p class="placeholder">your name <span>*</span></p>
      <input type="text" name="username" required maxlength="50" placeholder="enter your name" class="box">
      <p class="placeholder">your email <span>*</span></p>
      <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="box">
      <p class="placeholder">your password <span>*</span></p>
      <input type="password" name="user_password" required maxlength="50" placeholder="enter your password" class="box">
      <p class="placeholder">confirm password <span>*</span></p>
      <input type="password" name="c_pass" required maxlength="50" placeholder="confirm your password" class="box">
      <p class="link">already have an account? <a href="login.php">login now</a></p>
      <input type="submit" value="register now" name="submit" class="btn">
   </form>

</section>














<!-- sweetalert cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/alers.php'; ?>

</body>
</html>