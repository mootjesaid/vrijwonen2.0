<!-- aanmaak datum: 09/06/2021, 11:14. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<?php
  if(!isset($_SESSION)){//SESSION start al die niet gestart is
    session_start();
  }
  if(!isset($_SESSION["login"]) || $_SESSION["login"]!=="true"){//chek if logged in
    header("location:login.php");
  }
?>
<!doctype html>
<html lang="nl">
  <head>
	  <title>woningen.nl - aanpassen</title>

	  <meta charset="UTF-8">
	  <meta name="description" content="In deze geweldige website kunt u allerlei revieuws toevoegen en bekijken. U bent van harte welkom ...">
	  <meta name="keywords" content="woningen.nl, review, gasten, welkom">
	  <meta name="author" content="Mohamad Dian Bah">
	  <meta name="robots" content="all">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.png" sizes="16x16">
	  <link rel="stylesheet" href="css/style.css">
	  <meta name="theme-color" content="white"/>
  </head>
  <body>
    <?php require "inc/navbar.php"; 
      require_once("./functions/functions_overview.php");

      if(!isset($_GET["house_id"]) || empty($_GET["house_id"])){
        echo "Huis ID is niet mee gegeven.";
        exit;
      }else{
        $house_id= $_GET["house_id"];
      }

      include("./database/config.php");
      include("./database/opendb.php");

      $query = "SELECT title, price, description, location, properties, status, address, postalcode, place, image_path_first_photo, image_path_photos FROM houses WHERE house_id= ?";

      $preparedQuery=$dbaselink->prepare($query);  
      $preparedQuery->bind_param("i",$house_id);
      $preparedQuery->execute();

      if($preparedQuery->errno){
        echo "query is not working ";
      }else{
        $result=$preparedQuery->get_result();
        if($result->num_rows===0){
          echo "-Er is geen huis met HUIS ID: <b>".$house_id."</b>  gevonden";
          exit;    
        }
      }
      $preparedQuery->close();

      while($row=$result->fetch_assoc ()){//putting values in variables are only useful for 1 line result in detail.php
        $title= $row["title"];
        $price= $row["price"];
        $price= substr(trim($price),0,-3);
        $address= $row["address"];
        $postalcode= $row["postalcode"];
        $place= $row["place"];
        $description= $row["description"];
        $arr_images = explode(",", $row["image_path_photos"]);  //convert string to array;
        $first_photo= $row["image_path_first_photo"];
        $location= $row["location"];
        $properties= $row["properties"];
        $status= $row["status"];
      }
      include("./database/closedb.php");
    ?>
    <script>
      // I make a javascript array whit a php array           AND add the first photo at the of the array to avoid dublle clik at the begining.
      var images = ["<?php echo $arr_images[0]."\",\"".$arr_images[1]."\",\"".$arr_images[2]."\",\"".$arr_images[3]."\",\"first_image/".$first_photo; ?>"];

      var count = 0;
      function changeImg() {
        img.src= "./images/"+images[count];    
        count++;
        if(count >= 5){count = 0;}
      }
    </script>

    <h2><b><?php echo $title; ?></b></h2>

    <table class="table_detail">
      <tr>
    	   <td><b>Afbeeldingen: </b> <!--<button class="a_next" onclick="changeImg()">volgende ››</button>--></td>           
        <td class="imgs_detail">
          <!--------------------------------------------- images-------------------------------------------------- -->
          <?php echo "<img src=\"./images/first_image/".$first_photo."\" alt=\"Afbeeldingen van het huis.\" id=\"img-id\" onclick=\"changeImg()\">"; ?>
           <script>
            var img = document.getElementById("img-id"); // Get/Set the img tag
          </script>
          <!--------------------------------------------- images-------------------------------------------------- -->
        </td>
    	</tr>
    

    <!-- form whit input -->
    <form action="./update_result.php" method="post" enctype="multipart/form-data"><role="form">
      
        <tr>
          <td class="col-3">titel: </td>
    	    <td class="col-5"><input  type="text" name="title" value="<?php echo $title; ?>"></td>          
    	  </tr>
        <tr>
          <td class="col-3">Prijs: &nbsp;&nbsp;€</td>
    	    <td class="col-5"><input  type="text" name="price" value="<?php echo $price; ?>"></td>          
    	  </tr>
        <tr>
          <td class="col-3">Adres: </td>
    	    <td class="col-5"><input type="text" name="address" value="<?php echo $address; ?>"></td>          
    	  </tr>
        <tr>
          <td class="col-3">Postcode: </td>
    	    <td class="col-5"><input type="text" name="postalcode" value="<?php echo $postalcode; ?>"></td>          
    	  </tr>
        <tr>
          <td class="col-3">Plaats: </td>
    	    <td class="col-5"><input type="text" name="place" value="<?php echo $place; ?>"></td>          
    	  </tr>
        <tr>
          <td class="col-3">Omschijving: </td>
          <td class="col-5"><textarea class="textarea_update" type="text" name="description"><?php echo $description; ?></textarea> </td>    
    	  </tr>
        
        <tr>
          <td>
            <h3>Status:</h3>
          </td>
          <td>
            <label>
              <input type="radio" name="status[]" value="0">
              beschikbaar
            </label>
          </td>
          <td>
            <label>
              <input type="radio" name="status[]" value="1">
              verkocht
            </label>
          </td>
        </tr>
    	  <tr>
    	    <td><input class="a_next" type="submit" name="submit" value="Opslaan"></td>
          <td><input type="hidden" name="house_id" value="<?php echo $house_id; ?>"></td>
    	  </tr>
      </table>
    </form>



  </body>
</html>
