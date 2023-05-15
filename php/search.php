
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <title>Search</title>
        <link rel="stylesheet" href="../css/style.css"> 
</head>
<body>
    <form method="post">

    <?php       
                $host = "localhost";
                $db_name = "recipe_app";
                $user = "root";
                $password = "";
                $conn= new mysqli($host, $user, $password, $db_name);
                mysqli_report(MYSQLI_REPORT_STRICT);
                if(isset($_REQUEST["search"])){
                  $search= $_REQUEST["search"]; 
                 
                  $sth ="SELECT * FROM `recipe`
                   WHERE description Like'%$search%'Or recipe_name Like'%$search%'
                  Or dish_type Like '%$search%'  ";
                  
                  $query=mysqli_query($conn,$sth);
                  $res=mysqli_num_rows($query);

                   echo " There are ".$res." results!";
                   
                  if( $res> 0 ) {
                     while($row1=mysqli_fetch_assoc($query)){
                        $user_id =$row1['user_id'];
                        $dish_type =$row1['dish_type'];
                        $description=$row1['description'];
                        $prep_time=$row1['preptime'];
                        $cooktime=$row1['cooktime'];
                       $servings=$row1['servings'];
                       $image=$row1['img_url'];
                       $recipe_name=$row1['recipe_name'];
            ?>
                        
                                <table  border="4" width="90%" >

                            </div>
                        </a>
                    <?php 
                      echo " <tr >
        <td> 
        <img  src='". $row1["img_url"] . "' width='90%' height='90%' >
        
        </td>
        <td>
            ". $row1["dish_type"] ."
           </td>
           <td>
           " . $row1["description"] ."
           </td>
           <td>
            ". $row1["preptime"] ."
           </td>
           <td>
           ". $row1["cooktime"] ."
          </td>
          
          
           <td>
            ". $row1["servings"] ."
           </td>

    </tr>";}
                }
                  else {
                    echo "there are no results matching your search";
                     die('Could not get data: ' . mysqli_error());
                  }
                
              }
                 // $res->execute(); 
                  //if($row = $res->fetch()){
                    ?>
     

    </form>
</body>