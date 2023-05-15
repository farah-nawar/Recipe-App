<?php @include 'connect.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// check if user is logged in, redirect to login page if not
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}?>
<!DOCTYPE html>
<html lang="eg">

<head>

  <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
   <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

   <title>Recipe-House</title>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
   <link rel="stylesheet" href="footer.css">
   <link href="/dist/output.css" rel="stylesheet">
   <link rel="stylesheet" href="RecipePage.css">
   <style>@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap");



    #divv {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
    width: 100%;
    display: inline-flex;
    background: white;
    justify-content: flex-start;
    align-items: flex-end;
    min-height: 45vh;
    }
    
    .footer {
  font-family: "Poppins", sans-serif;
  position: absolute;
  width: 100%;
  background: #3586ff;
  min-height: 100px;
  display: flex;
  align-items: flex-end;
  bottom: 0;
}

    
   
    
    .menu__link {
    font-size: 1.2rem;
    color: #fff;
    margin: 0 10px;
    display: inline-block;
    transition: 0.5s;
    text-decoration: none;
    opacity: 0.75;
    font-weight: 300;
    }
    
    .menu__link:hover {
    opacity: 1;
    }
    
    .footer p {
    color: #fff;
    
    font-size: 1rem;
    font-weight: 300;
    }
    
    .wave {
    position: absolute;
    top: -100px;
    left: 0;
    width: 100%;
    background: url("https://i.ibb.co/wQZVxxk/wave.png");
    background-size: 1000px 100px;
    }
    
    .wave#wave1 {
    z-index: 1000;
    opacity: 1;
    bottom: 0;
    animation: animateWaves 4s linear infinite;
    }
    
    .wave#wave2 {
    z-index: 999;
    opacity: 0.5;
    bottom: 10px;
    animation: animate 4s linear infinite;
    }
    
    .wave#wave3 {
    z-index: 1000;
    opacity: 0.2;
    bottom: 15px;
    animation: animateWaves 3s linear infinite;
    }
    
    .wave#wave4 {
    z-index: 999;
    opacity: 0.7;
    bottom: 20px;
    animation: animate 3s linear infinite;
    }
    
    @keyframes animateWaves {
    0% {
    background-position-x: 1000px;
    }
    100% {
    background-positon-x: 0px;
    }
    }
    
    @keyframes animate {
    0% {
    background-position-x: -1000px;
    }
    100% {
    background-positon-x: 0px;
    }
    }
    </style>

</head>
  <body>
    <header>
        <div class="px-3 py-2 text-bg-dark">
          <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
             



              <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
                <li>
                  <a href="../php/viewrecipes.php" class="nav-link text-white">
                    Home
                  </a>
                </li>
                <li>
            <a href="../php/logout.php" class="nav-link text-white">
                logout
            </a>
            </li>

            </div>
          </div>
        </div>
    </header>

      
      
  		<div class="container">
         
  				<div class="row justify-content-center text-center">
  						<div class="col-md-8 col-lg-6">
  								

  										<h1>Favourites</h1>
  								
  						</div>
  				</div>
                  </div>
        
    <div class="flex flex-col justify-center h-full">
        <!-- Table -->
        
        <style>

    .container {
        display: inline-block;
        justify-content:flex-start;
        width: 100%;
    }

    table {
        border-collapse: collapse;
        width: 200vh;
        justify-content:flex-start;
        background-color: rgba(255, 255, 255, 0.7); /* Transparent white background */
    }

    th, td {
        text-align: center;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2; /* Light gray background for even rows */
    }

    th {
        background-color: #FFA500; /* Orange background for table headers */
        color: white;
    }
</style>

    <div class="container">
        <table>
            
            <?php
require "components/connect.php";


$user_id = $_SESSION['user_id'];
    $sql1 = "SELECT * FROM `favorites` where user_id='$user_id'";
    $result1=$conn->query($sql1);
    
        if ($result1->rowCount() > 0) {
            echo "<tr><th>Recipe name</th> <th>image</th> </tr>";
            while ($row1 = $result1->fetch(PDO::FETCH_ASSOC)) {
                // Access data using $row1['column_name']
                $x=$row1['recipe_id'];
                $sql = "SELECT * FROM recipe where recipe_id=$x";
                $result = $conn->query($sql);
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $recipe_name = $row['recipe_name'];
                $img_url = $row['img_url'];

                // Print the data in a table
                
                echo "<td>$recipe_name</td><td><img src='$img_url' alt='Recipe Image' width='100'></td></tr>";

                
                
                            
            }
        } 
        else {
            echo 'No favorites found for user ID ' . $user_id;
        }

       
        
    
    
    ?>
        </table>
    </div>





      <div id="divv"> <footer class="footer">
          <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
          </div>
          
          
          <p>&copy;2022 Recipe House | All Rights Reserved</p>
        </footer>
      </div>
      
      
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="cart.js">


        </script>
<script  src="./js/script.js"></script>
  </body>
</html>