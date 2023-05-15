
<?php
@include 'connect.php';
// start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// check if user is logged in, redirect to login page if not
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// get recipe_id from POST data
$recipe_id = $_GET['recipe_id'];

// get user_id from session data
$user_id = $_SESSION['user_id'];

// handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'];
    $comment=$_POST['comment'];
    $msg="SELECT * FROM `rating` WHERE recipe_id=$recipe_id and user_id=$user_id";
    $results = $conn->query($msg);
    if ($results->rowCount() > 0) {
        $row0 = $results ->fetch(PDO::FETCH_ASSOC);
        $oldrate=$row0['rating'];
         $sql3="UPDATE `rating` SET 
         `coment`='$comment',`rating`='$rating' 
         WHERE recipe_id=$recipe_id and user_id=$user_id";
         $conn->exec($sql3);
         $sql0="SELECT * FROM `rateperrecipe` WHERE recipe_id=$recipe_id";
         $result0 = $conn->query($sql0);
         $row00 = $result0->fetch(PDO::FETCH_ASSOC);
         $tmpcnt0=$row00['counter'];
            $rates0=$row00['rating'];
            $oldsum0=$tmpcnt0*$rates0;
            $newsum0=$oldsum0-$oldrate;
            $finalsum0=$newsum0+$rating;
            $avg0=$finalsum0/$tmpcnt0;
            
                   $sql04 = "UPDATE `rateperrecipe` SET `rating`=$avg0, `counter`=$tmpcnt0
                   WHERE recipe_id=$recipe_id";
                   $conn->exec($sql04);

         
    } 
    else{
        $sql= "INSERT INTO `rating`( `Recipe_id`, `user_id`, `coment`, `rating`) 
        VALUES ('$recipe_id','$user_id','$comment','$rating')";
        $result1 = $conn->query($sql);
        $row = $result1 ->fetch(PDO::FETCH_ASSOC);
        if($result1->rowCount() >0)
        {
            $sql2="SELECT * FROM `rateperrecipe` WHERE recipe_id=$recipe_id";
            $result2 = $conn->query($sql2);
            if ($result2->rowCount() == 0) {
                $sql3="INSERT INTO `rateperrecipe`( `recipe_id`, `rating`, `counter`) 
                       VALUES ('$recipe_id','$rating','1')";
                  $conn->exec($sql3);
            } 
            else {
                $row2 = $result2->fetch(PDO::FETCH_ASSOC);
                $tmpcnt=$row2['counter'];
                $rates=$row2['rating'];
                $oldsum=$tmpcnt*$rates;
                $newsum=$oldsum+$rating;
                $newcnt=$tmpcnt+1;
                $avg=$newsum/$newcnt;
                
                       $sql4 = "UPDATE `rateperrecipe` SET `rating`=$avg, `counter`=$newcnt WHERE recipe_id=$recipe_id";
                       $conn->exec($sql4);
    
    
                
            }
    }
  
      
        
        
         
        #INSERT INTO `rateperrecipe`(`tableid`, `recipe_id`, `rating`, `counter`) 
        #VALUES ('[value-1]','[value-2]','[value-3]','[value-4]')
    }
    header('location:../php/viewrecipes.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Rate Recipe</title>
    <link rel="stylesheet" type="text/css" href="../css/rate.css">
</head>
<body>
    <h1>Rate Recipe : <?php 
    $sql="SELECT recipe_name FROM `recipe` WHERE recipe_id=$recipe_id";
    $result= $conn->query($sql);
    $row = $result ->fetch(PDO::FETCH_ASSOC);
    echo $row['recipe_name']; ?> </h1>

    <form method="POST" action="">
        <div>
            <label>Rating:</label>
            <input type="radio" name="rating" value="1">1
            <input type="radio" name="rating" value="2">2
            <input type="radio" name="rating" value="3">3
            <input type="radio" name="rating" value="4">4
            <input type="radio" name="rating" value="5">5
        </div>

        <div>
            <label>Comment:</label>
            <textarea name="comment"></textarea>
        </div>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
