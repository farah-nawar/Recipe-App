<?php require "connect.php"?>
<?php
$output ="";
if(isset($_POST['submit']))
{	
    function validate2($data1){
		$data1 = trim($data1);
		$data1= stripslashes($data1);
		$data1 = htmlspecialchars($data1);
		return $data1;

	}

   
    $role_name=validate2($_POST["role_name"]);

    if(empty($role_name))
    {
        echo '<script>alert("please enter all fields fileds are missing")</script>';
    }
     else{
        $insert = $conn->prepare("INSERT INTO `role`( `role_name`) VALUES (:role_name)");
        $signup = $conn->query("SELECT * FROM `role` WHERE role_name = '$role_name'");
        $signup->execute();
        $data1 = $signup->fetch(PDO::FETCH_ASSOC);
    if($signup->rowcount() > 0)
    {

        echo '<script>alert("Role already exists in database")</script>';
    }else{
    try{$insert->execute([
        ':role_name'=> $role_name
     
        ]		
          
          );}
             catch(Exception $E){
              $output="Invalid inputs";
              
             }
             echo '<script>alert"Role Added Successfully" </script>';
             header('location:../php/addrole.php');
            }
}
    }



     
  
?>


<html>

<head>
<meta charset="UTF-8">
<title>
  Add Role
</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="../css/adminadd.css" rel="stylesheet" >
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
      function allLetter(inputtxt)
  {
   var letters = /^[A-Za-z]+$/;
   if(inputtxt.value.match(letters))
     {
      return true;
     }
   else
     {
     alert("Enter Text");
     return false;
     }
  }
   </script>
<!-- <script defer src="register.js" > </script> -->

</head>

<body >
<div class ="div1">
   
   <a href="../html/Adminlandpage.html" class ="sign1">Admin Page</a>
 </div>
<section class="get-in-touch" id="section">
   <h1 class="title" style="margin-bottom:50px;">Add Role</p></h1>
   <form name="form1" class="contact-form row" action="../php/addrole.php" method="post" onsubmit= "return allLetter(document.form1.role_name)" >
    
   <div class="form-field col-lg-6">
         <input  name="role_name" id="role_name" class="input-text js-input" type="text" required>
         <label class="label" for="role_name">Role Name</label>
</div>
    <div style="margin-left:250px;">
         <input class="submit-btn" type="submit" name="submit"  value="Add Role">
         <a href="../php/chooserole.php" class ="sign1" >Go back</a>
      </div> 

     
   </form>
</section>
</body>
</html>


