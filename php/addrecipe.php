<?php require "connect.php"?>

<?php

$stmt = $conn->query('SELECT Unit_id, Unit_Name FROM unit');

// Generate options for unit select element
$options = '';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $options .= "<option value=\"{$row['Unit_id']}\">{$row['Unit_Name']}</option>";

}
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// check if user is logged in, redirect to login page if not
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit;
}
// Get the total number of ingredients submitted
if(isset($_POST['submit'])){    
        
        $user_id=$_SESSION['user_id'];
        $dish_type =$_POST['dish_type'];
        $description=$_POST['description'];
        $prep_time=$_POST['preptime'];
        $cooktime=$_POST['cooktime'];
        $servings=$_POST['servings'];
        $image=$_POST['img_url'];
        $recipe_name=$_POST['recipe_name'];
       
   # $sql = "SELECT * FROM `recipe` where recipe_id='$recipe_id';";
    #$result = $conn->query($sql);
    #if ($result->fetch(PDO::FETCH_ASSOC) == 0) 
    
           //inserting data
           $sql = "INSERT INTO `recipe`(`user_id`, `dish_type`, `description`, `preptime`,
            `cooktime`, `servings`, `img_url`, `recipe_name`)
           VALUES (:user_id, :dish_type, :description, :preptime,
            :cooktime, :servings, :img_url, :recipe_name)";
   $stmt = $conn->prepare($sql);
   
   // Bind values of parameters
   $stmt->bindValue(':user_id', $user_id);
   $stmt->bindValue(':dish_type', $dish_type);
   $stmt->bindValue(':description', $description);
   $stmt->bindValue(':preptime', $prep_time);
   $stmt->bindValue(':cooktime', $cooktime);
   $stmt->bindValue(':servings', $servings);
   $stmt->bindValue(':img_url', $image);
   $stmt->bindValue(':recipe_name', $recipe_name);
   
   // Execute statement
   $stmt->execute();
          
          
          $sql = $conn->query( "SELECT recipe_id FROM `recipe` ORDER BY recipe_id DESC LIMIT 1");
          if($sql->rowcount()==1)
          {
                
          }
          $recipeidArray = $sql->fetch(PDO::FETCH_ASSOC); 
          
          $recipeid = $recipeidArray['recipe_id'];
          
          
       
       
        
        
        $stepnumber=1;

    $ingredientCount = isset($_POST['ingredientCount']) ? $_POST['ingredientCount'] : 0;
    $instrCount = isset($_POST['instrCount']) ? $_POST['instrCount'] : 0;
//add instructions
for ($j = 1; $j <= $instrCount; $j++)
{
    $description = $_POST["desc{$j}"];
    $stmt = $conn->prepare("INSERT INTO `instruction` (`recipe_id`, 
    `step_Number`, `description`) 
    VALUES (:id,:step,:descr)");
    
    $stmt->bindParam(':id', $recipeid);
    $stmt->bindParam(':step', $stepnumber);
    $stmt->bindParam(':descr', $description);
    
    $stmt->execute();
    $stepnumber=$stepnumber+1;

}
// Loop through each ingredient and insert into database
for ($i = 1; $i <= $ingredientCount; $i++) {
  $name = $_POST["ingredient{$i}"];
  $quantity = $_POST["quantity{$i}"];
  $unitId = $_POST["unit{$i}"];

  // Insert into database using prepared statement
  $query1 = $conn->query("SELECT ingredient_id FROM ingredients where ingredient_name='$name'");
  $query1->execute();
  $myArray2 = $query1->fetch(PDO::FETCH_ASSOC);
  $myArray = array(); // create empty array
  
  if ($myArray2) {
    $x= intval(implode(', ', $myArray2) );// Convert array to string and echo it)
    #array_push($myArray, $x);
    
  }
  else{
    $stmt = $conn->prepare("INSERT INTO `ingredients` (`Ingredient_name`) VALUES (:name)");
    $stmt->bindParam('name', $name);
    $stmt->execute();
    $query2 = $conn->query("SELECT ingredient_id FROM ingredients where ingredient_name='$name'");
    $query2->execute();
    $x = intval(implode(', ', $query2->fetch(PDO::FETCH_ASSOC)) );
    #array_push($myArray, $idtemp2); // add values to array
  }
  $stmt = $conn->prepare ("INSERT INTO `recipe_ingredients` ( `Recipe_id`, `ingredient_id`, 
  `amount`, `unit`)
   VALUES ('$recipeid','$x','$quantity ','$unitId ')");
   $stmt->execute();

    }

   
   

  
}

// Redirect to recipe page or show success message



?>
<html>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/addingr.css">
    
    <script>
      function addIngredient() {
        var container = document.getElementById("ingredient-container");
        var ingredientCount = container.childElementCount + 1;
        var newIngredient = document.createElement("div");
        newIngredient.innerHTML = `
          <label for="ingredient${ingredientCount}">Ingredient:</label>
          <input type="text" id="ingredient${ingredientCount}" name="ingredient${ingredientCount}" required>
          <label for="quantity${ingredientCount}">Quantity:</label>
          <input type="number" id="quantity${ingredientCount}" name="quantity${ingredientCount}" required>
          <select id="unit${ingredientCount}" name="unit${ingredientCount}" required>
            <option value="">--Unit--</option>
            <?php echo $options; ?>
          </select><br><br>
        `;
        container.appendChild(newIngredient);
         // update ingrCount hidden input field
        // update ingredientCount hidden input field
document.getElementById("ingredientCount").value = ingredientCount;

      }
      function addinstruction() {
  var container = document.getElementById("instructions-container");
  var instrCount = container.childElementCount + 1;
  var newinstr = document.createElement("div");
  newinstr.innerHTML = `
    <label for="instruction${instrCount}">Instruction:</label>
    <input type="text" id="desc${instrCount}" name="desc${instrCount}" required>
    <br><br>
  `;
  container.appendChild(newinstr);
  
  // update instrCount hidden input field
  document.getElementById("instrCount").value = instrCount;
}

    </script>
    </head>
    <body>
    <nav>
  <a href="../php/viewrecipes.php">Home</a>
</nav>
    <h1>Ingredients</h1>
    <form class="former" action="addrecipe.php" method="post">
        <div id="ingredient-container">
            <div>
            <label for="ingredient1">Ingredient:</label>
            <input type="text" id="ingredient1" name="ingredient1" required>
            <label for="quantity1">Quantity:</label>
            <input type="number" id="quantity1" name="quantity1" required>
            
            <select id="unit1" name="unit1" required>
                <option value="">--Unit--</option>
                <?php echo $options; ?>
            </select><br><br>
            </div>
        </div>
        <input type="hidden" name="ingredientCount" id="ingredientCount" value="1">

        <br><br>
        <button type="button" onclick="addIngredient()">Add Ingredient</button>
        <br><br>
        <section class="recipe">
   <h1 class="title">ADD Recipe</h1>
   <TABle>
   
       <tr>
        <td>
        <td> <div class="recipe row">
      <label class="label" for="dish_type">recipe_name</label>
         <input  name="recipe_name" id="recipe_name" class="input-text " type="text" required></td>
       </div> </td>
       </tr>
  
   
      
      <TR>
      <td> <div class="recipe row">
      <label class="label" for="dish_type">dish_type</label>
    
      <select name="dish_type" id="dish_type" class="input-text" required>
        <?php
        $sql = "DESCRIBE recipe dish_type";
        $result = $conn->query($sql);
        $row = $result->fetch(PDO::FETCH_ASSOC);        
          $enum_list = explode(",", str_replace("'", "", substr($row['Type'], 5, -1)));
          foreach ($enum_list as $value) {
            echo "<option value='$value'>$value</option>";
          }
        ?>
</select>

      
      </select>

</div>
      <td> <div class="recipe row"><label class="label" for="description">description</label>
         <input name="description" id="description" class="input-text " type="text" required>
         </div> </td>
      
        <td>
        <div class="recipe row">
            <label class="label" for="preptime">preptime</label>
         <input name="preptime" id="preptime" class="input-text " type="number" required>
         </div></td>
    
   
      </TR>
      
<tr>
    <td><div class="recipe row">
        <label class="label" for="servings">servings</label>
            <input name="servings" id="servings" class="input-text " type="number" required>
            </div></td>
    <td><div class="recipe row">
        <label class="label" for="cooktime">cooktime</label>
            <input name="cooktime" id="cooktime" class="input-text" type="number" required>
            </div></td>
    <td><div class="recipe row">
         <label class="label" for="img_url">img_url</label>
            <input name="img_url" id="img_url" class="input-text " type="text" required>
            </div></td>
         
</tr>
      
     
     
   </TABle>
   

      <br><br>
        <h1>Instructions</h1>
        <div id="instructions-container">
            <div>
            <label for="instruction">instruction:</label>
            <input type="text" id="desc1" name="desc1" required>
            <br><br>
            </div>
            
        </div>
        <br><br>
        <input type="hidden" name="instrCount" id="instrCount" value="1">

        <button type="button" onclick="addinstruction()">Add instruction</button>
        <input type="submit" name="submit" id ="submit" value="Submit" >
    </form>
    </body>
</html>
