<?php require "connect.php"?>
<?php
$output ="";
if(isset($_POST['submit']))
{	
   
    $Unit_name=$_POST["Unit_name"];
    $check_query = $conn->prepare("SELECT * FROM `unit` WHERE `Unit_Name` = :unit_name");
    $check_query->bindParam(':unit_name', $Unit_name);
    $check_query->execute();
    $existing_unit = $check_query->fetch();
  
    if ($existing_unit) {
      // Display an error message if the unit name already exists
      echo "Error: Unit name already exists in the database.";
    } else {
      // Insert the new unit record into the database
      $insert_query = $conn->prepare("INSERT INTO `unit` (`Unit_Name`) VALUES (:unit_name)");
      $insert_query->bindParam(':unit_name', $Unit_name);
      $insert_query->execute();
      echo "<script>
      if(confirm('unit added succesfully')){
        window.location.href = '../html/adminlandpage.html';
      }
      </script>";
  
    }
      
        
    }
     
  
?>

<html>

<html>

<head>
<meta charset="UTF-8">
<title>
  Add 
</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="../css/adminadd.css">
<style>
  /* Style the navbar with a black background color */
 
</style>


<!-- <script defer src="register.js" > </script> -->

</head>

<body >

<nav>
  <a href="../html/AdminLandPage.html">Home</a>
</nav>
<section class="get-in-touch">
   <h1 class="title">AddUnit</p></h1>
   <form class="contact-form row" action="../php/addunit.php" method="post" >
    
   <div class="form-field col-lg-6">
         <input name="Unit_name" id="Unit_name" class="input-text js-input" type="text" required>
         <label class="label" for="Unit_name">Unit_name</label>
      </div>
      
  
      <div class="form-field col-lg-6">
         <input class="submit-btn" type="submit" name="submit"  value="Add Unit">
      </div>
   </form>
</section>
</body>
</html>
