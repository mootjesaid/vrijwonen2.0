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
	  <title>woningen.nl</title>

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
      require_once("./functions/functions_detail.php");

      //chek the ID
      if(!isset($_GET["house_id"]) || empty($_GET["house_id"])){
        echo "Huis ID is niet mee gegeven.";
        exit;
      }else{
        $house_id= $_GET["house_id"];
      }

      //--------------houses data-------------
        house_data($house_id);//It returns the house data in SESSIONS

        $title= $_SESSION["title"];
		    $price= $_SESSION["price"];
		    $address= $_SESSION["address"];
		    $postalcode= $_SESSION["postalcode"];
		    $place= $_SESSION["place"];
		    $description= $_SESSION["description"];

      //--------------images_path--------
        images_path($house_id);
        $str_images_path= $_SESSION["images_path"];
        $arr_images_path = explode(",", $str_images_path);  //convert string to array;

      //--------------------------------------------------house_locations ids ophalen----
        houses_locations($house_id);
        $str_location_id= $_SESSION["location_id"];
        $arr_location_id = explode(",", $str_location_id);

        //-----location_value------
        $str_value_locations="";
        foreach ($arr_location_id as $item) {
          value_location($item); // value_location
          $str_value_locations.= $_SESSION["value_location"];
        }

      //--------------------------------------------------house_propertie ids ophalen----
        houses_properties($house_id);
        $str_propertie_id= $_SESSION["propertie_id"];
        $arr_propertie_id = explode(",", $str_propertie_id);

        //-----propertie_value------
        $str_value_properties="";
        foreach ($arr_propertie_id as $item) {
          value_propertie($item); // value_propertie
          $str_value_properties.= $_SESSION["value_propertie"];
        }
      //--------------------------------------------------house_status ids ophalen----
        houses_status($house_id);
        $str_status_id= $_SESSION["status_id"];
        $arr_status_id = explode(",", $str_status_id);

        //-----status_value------
        $str_value_status="";
        foreach ($arr_status_id as $item) {
          value_status($item); // value_status
          $str_value_status.= $_SESSION["value_status"];
        }
        
        
        
    ?>
    <script>
      // I make a javascript array whit a php array           AND add the first photo at the of the array to avoid dublle clik at the begining.
      var images = ["<?php echo $arr_images_path[1]."\",\"".$arr_images_path[2]."\",\"".$arr_images_path[3]."\",\"".$arr_images_path[4]."\",\"".$arr_images_path[0]; ?>"];

      var count = 0;
      function changeImg() {
        img.src= "./images/"+images[count];    
        count++;
        if(count >= 5){count = 0;}
      }
    </script>


    <h1><?php echo $title; ?></h2>
    <a class="a_next" id="a_aanpassen" href="./update.php?house_id=<?php echo $house_id; ?>"> Aanpassen</a>

    <table class="col-9 table_detail">
        <tr class="col-12">
          <td class="col-6"><b>Address:</b> <?php echo $address; ?></td>
          <td class="col-5"><b>Plaats:</b> <?php echo $place; ?></td>
    	  </tr>
        <tr class="col-12">
          <td class="col-6"><b>Postcode:</b> <?php echo $postalcode; ?></td>    	    
          <td class="col-5"><b>Prijs:</b> <?php echo "€".$price; ?></td>
    	  </tr>
        <tr class="col-12">       
    	    <td class="col-8"><b>Omschrijving:</b> <?php echo "<br><p>".$description."</p>"; ?></td>
    	  </tr>
        <tr class="col-12">
    	    <td class="col-8"><b>Afbeeldingen: </b> <button class="a_next" onclick="changeImg()">Volgende ››</button></td>          
          <td class="col-8 imgs_detail">
          <!---------------- images---------------- -->
          <?php echo "<img src=\"./images/".$arr_images_path[0]."\" alt=\"Afbeeldingen van het huis.\" id=\"img-id\" onclick=\"changeImg()\">"; ?>
          <script>
            var img = document.getElementById("img-id"); // Get/Set the img tag
          </script>
          <!---------------- images---------------- -->
          </td>
    	  </tr>
        <tr class="col-12">
          <td class="col-12"><b>Ligging:</b> <?php echo $str_value_locations; ?></td>
        </tr>
        <tr class="col-12">
          <td class="col-6"><b>Eingenschappen: </b><?php echo $str_value_properties; ?></td>
          <td class="col-3"><b>Status:</b> <?php echo $str_value_status; ?></td>
        </tr>
    </table>
  </body>
</html>
