<?php require "connect.php"?>
<?php 
$output ="";
$stmt = $conn->query('SELECT `Role_id`, `Role_name` FROM `role`');

// Generate options for unit select element
$options = '';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
   $options .= "<option value=\"{$row['Role_id']}\">{$row['Role_name']}</option>";
}

if(isset($_POST['update']))
{   
    $user_id = $_POST["user_id"];
    $role_id = $_POST["role_id"];
    
    $insert = $conn->prepare("UPDATE `user` SET `role_id`=:role_id WHERE user_id=:user_id");

    try {
        $insert->execute([
            ':role_id' => $role_id,
            ':user_id' => $user_id
        ]);
        // do something on success
    } catch (Exception $e) {
        $output = "Invalid inputs";
    }
        
    // header('location:../php/chooserole.php');
}
     
?> 
  
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Role</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/adminadd.css">
</head>

<body>
<nav>
  <a href="../html/AdminLandPage.html">Home</a>
</nav>
    
    <section class="get-in-touch">
        <form action="updaterole.php" method="post">
            <div class="form-field col-lg-6" style="margin:30px;">
                <input name="user_id" id="user_id" class="input-text js-input" type="text" required>
                <label class="label" for="user_id">User ID</label>
            </div>
            
            <div class="form-field col-lg-6" style="margin:30px;">
                <select name="role_id" id="role_id" class="form-control" required > 
                    <option value=""></option>
                    <?php echo $options; ?>
                </select>
            </div>
  
            <div class="form-field col-lg-6" style="margin:30px;">
                <input class="submit-btn" type="submit" name="update" id="Submit" value="Update Role">
                <a href="../php/chooserole.php" class="sign" style="background: #000; color: #FFF; padding: 10px; margin-top: 150px; margin-left: 5px; border-radius: 3rem;">Go back</a>
            </div>
        </form>
    </section>
</body>
</html>
