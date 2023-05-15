<?php require "connect.php"?>
<?php

// Get the total number of ingredients submitted
$ingredientCount = count($_POST) ; 

// Loop through each ingredient and insert into database
for ($i = 1; $i < $ingredientCount; $i++) {
  $name = $_POST["ingredient{$i}"];
 

  // Insert into database using prepared statement
  $query1 = $conn->query("SELECT ingredient_id FROM ingredients where ingredient_name='$name'");
  $query1->execute();
  $myArray2 = $query1->fetch(PDO::FETCH_ASSOC);
  $myArray = array(); // create empty array
  
  if ($myArray2) {
    $x= intval(implode(', ', $myArray2) );// Convert array to string and echo it)
    array_push($myArray, $x);
    
  }
  else{
    $stmt = $conn->prepare("INSERT INTO `ingredients` (`Ingredient_name`) VALUES (:name)");
    $stmt->bindParam('name', $name);
    $stmt->execute();
    $query2 = $conn->query("SELECT ingredient_id FROM ingredients where ingredient_name='$name'");
    $query2->execute();
    $idtemp2 = $query2->fetch(PDO::FETCH_ASSOC);
    array_push($myArray, $idtemp2); // add values to array
  }
//inserted into ingredients 
echo "<script>
      if(confirm('ingredients added succesfully')){
        window.location.href = '../html/adminlandpage.html';
      }
      </script>";

  
}


?>
<html>
    <head>
    <meta charset="UTF-8">
    
<link href="../css/adminingriend.css" rel="stylesheet" >

    <script>
      function addIngredient() {
        var container = document.getElementById("ingredient-container");
        var ingredientCount = container.childElementCount + 1;
        var newIngredient = document.createElement("div");
        newIngredient.innerHTML = `
          <label for="ingredient${ingredientCount}">Ingredient:</label>
          <input type="text" id="ingredient${ingredientCount}" name="ingredient${ingredientCount}" required>
          <br><br>
        `;
        container.appendChild(newIngredient);
        
      }
     
    </script>
    </head>
    <body>
    <nav>
  <a href="../html/AdminLandPage.html">Home</a>
</nav>
    
    <section class="get-in-touch" id="section">
    <h1 style="margin-bottom:50px;" >Add Ingredients</h1>
    <form class="former" action="addingredient.php" method="post">
        <div id="ingredient-container">
            <div>
            <label for="ingredient1">Ingredient:</label>
            <input type="text" id="ingredient1" name="ingredient1" required>
           
            
            <br><br>
            </div>
        </div>
        <input type="hidden" name="ingredientCount" id="ingredientCount" value="1">

        <br><br>
        <button type="button" onclick="addIngredient()">Add Ingredient</button>
        <button type="submit">Submit</button>
        <br><br>
   </section>
    </body>
</html>
