<!DOCTYPE html>
<?php

@include 'connect.php';
session_start();
?>
<html>

    <head>
        <meta charset="UTF-8"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
   <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

        <title>Recipe</title>
     
       
    </head>
    
        <body  >
       <!-- Navigation -->    
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
                 </ul>
            </div>
          </div>
        </div>
    </header>
            
            <div class="topnav">


</div>
                        <!-- /.navbar-collapse -->
        </div>
       <!-- /.container -->
    </nav>
   
  
    


   
</div>
            
            <?php
           
// read all rows from database 
 $recipe_id = $_GET['recipe_id'];
 $sql = "SELECT * FROM `recipe` where recipe_id=$recipe_id ";
 $result= $conn->query($sql);
 $sql2= "SELECT * FROM `instruction` where recipe_id=$recipe_id ";
 $inst=$conn->query($sql2);
 $sql3="SELECT i.Ingredient_name
 FROM `recipe_ingredients` as r 
 join ingredients as i on `r`.`ingredient_id`=i.ingredient_id
 where Recipe_id=$recipe_id
 
 ";
 $ingr=$conn->query($sql3);
 //$result = mysqli_query($conn, $sql);
 if(!$result || !$inst || !$ingr)
 {
    die("invalid query" .$connection->error);
 }
 while($row = $result ->fetch(PDO::FETCH_ASSOC) )
 {
   
    echo "<div style='text-align:center;  background-color: thistle; 
    '>
    <img src='" . $row["img_url"] . "' style='width:40%;' />;
  </div>";
    echo '<div style="font-size: 46px; text-align:center; ">';
    echo $row["recipe_name"];
    echo '<div style="border-top: 5px dotted black;"></div>';

    
    
    echo '</div>';
    echo "<br>";
    echo '<div style="font-size: 24px; text-align:left; margin=16px; ">';
    echo '<h2>Description:</h2>';
    
    echo $row["description"];
    echo '<div style="border-top: 5px dotted black;"></div>';
    echo '<h2>Dish type:</h2>';
    echo  $row["dish_type"] ;
    echo '<div style="border-top: 5px dotted black;"></div>';
    echo '<h2>preparation time:</h2>';
    echo  $row["preptime"] ;
    echo '<div style="border-top: 5px dotted black;"></div>';
    echo '<h2>cook time:</h2>';
    echo  $row["cooktime"] ;
    echo '<div style="border-top: 5px dotted black;"></div>';
    echo '<h2>Servings:</h2>';
    echo  $row["servings"] ;
    echo '</div>';
    echo '<div style="border-top: 5px dotted black;"></div>';
    echo '<h2>Instructions:</h2>';
    $count = 1;
    while($row2 = $inst ->fetch(PDO::FETCH_ASSOC) )
        {
            echo '<div style="font-size: 24px; text-align:left; margin=16px; ">';
    
    echo '<div style="display:inline-block; font-size: 24px; text-align:left; ">';
    echo $count . ". " . $row2["description"];
    echo"  ";
   
    $count++;
    
    echo '</div>';
        }
        echo '<div style="border-top: 5px dotted black;"></div>';
    echo '<h2>Ingredients:</h2>';
      
    $count = 1;
    while($row3 = $ingr ->fetch(PDO::FETCH_ASSOC))
    {
        echo '<div style="display:inline-block; font-size: 24px; text-align:left; ">';
        echo $count . ". " . $row3["Ingredient_name"];
        echo". ";

        echo '</div>';
        $count++;
    }
    
    echo '<div style="border-top: 5px dotted black;"></div>';
    echo '<h3><a href="rate.php?recipe_id=' . $recipe_id . '">KINDLY RATE THE RECIPE</a></h3>';

  
 
   

    
    


    
        


    
        // Output the image container with the image
        
 }

  

        
    //     </td>
    //     <td>
    //         ". $row["dish_type"] ."
    //        </td>
    //        <td>
    //        " . $row["description"] ."
    //        </td>
    //        <td>
    //         ". $row["preptime"] ."
    //        </td>
    //        <td>
    //        ". $row["cooktime"] ."
    //       </td>
          
          
    //        <td>
    //         ". $row["servings"] ."
    //        </td>

    // </tr>";
    
 
 
?>
          


           


</html>

