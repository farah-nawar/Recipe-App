
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
  position: fixed;
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
    margin: 15px 0 10px 0;
    font-size: 1rem;
    font-weight: 300;
    }
    
    .wave {
    position: absolute;
    top: -100px;
    left: 0;
    width: 100%;
    height: 100px;
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
                  <a href="../php/login.php" class="nav-link text-white">
                    login
                  </a>
                  
            </div>
          </div>
        </div>
    </header>

      
      
  		<div class="container">
         
  				<div class="row justify-content-center text-center">
  						<div class="col-md-8 col-lg-6">
  								

  										<h1>Recipe_Page</h1>
  								
  						</div>
  				</div>
                  </div>
                  
        
    <div class="flex flex-col justify-center h-full">
        <!-- Table -->
        
        <style>

.container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
}

table {
  width: 90%;
  background-color: rgba(255, 255, 255, 0.7);
  margin: auto;
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
            
       

<style>
  .alert-box {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #f44336;
    color: #fff;
    padding: 20px;
    border-radius: 5px;
    animation: slideIn 0.5s forwards;
  }
  
  .hide {
    animation: slideOut 0.5s forwards;
  }
  
  @keyframes slideIn {
    0% { top: -100%; }
    100% { top: 50%; }
  }
  
  @keyframes slideOut {
    0% { top: 50%; }
    100% { top: -100%; }
  }
</style>
          <?php
require "components/connect.php";

$host = "localhost";
$db_name = "recipe_app";
$user = "root";
$password = "";

// Create a mysqli object and establish a database connection
$conn = new mysqli($host, $user, $password, $db_name);

    $sql = "SELECT * FROM recipe";
    $result=$conn->query($sql);

    echo "<tr><th>Recipe Name</th><th>Rating</th> <th>image</th> </tr>";
        if ($result) {
        // Loop through each row and output the recipe data
        while ($row = $result->fetch_assoc() ) {
            $sql1 = "SELECT rating FROM rateperrecipe WHERE Recipe_id = {$row['recipe_id']}";
            $result1 = $conn->query($sql1);
            
            $rating = $result1->fetch_assoc();
            if($rating==null)
            {
                $temp="no rating yet";
               
                
                echo "<tr>
                <td>" . $row["recipe_name"] . "</td>
                <td>" . $temp . "</td>
                <td>
                    <form method='post' action='viewrecipes.php'>
                        <input type='hidden' name='recipe_id' value='{$row["recipe_id"]}'>
                        <a href='recipeland.php?recipe_id={$row["recipe_id"]}'><img src='{$row["img_url"]}' width='100'></a>
                </td>
                
            </tr>";
        

            }
            else

            {
               
               
              echo "<tr>
              <td>" . $row["recipe_name"] . "</td>
              <td>" . $rating['rating'] . "</td>
              <td>
                  <form method='post' action='viewrecipes.php'>
                      <input type='hidden' name='recipe_id' value='{$row["recipe_id"]}'>
                      <a href='recipeland.php?recipe_id={$row["recipe_id"]}'><img src='{$row["img_url"]}' width='100'></a>
              </td>
             
            
          </tr>";
      


            }
            
           
          
    }
   
      } else {
        // Error executing SELECT statement.
        echo "Error: " . $sql_check . "<br>" . $conn->error;
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
