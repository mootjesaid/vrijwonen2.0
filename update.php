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
  <?php 
    require "inc/navbar.php";
    require_once("./functions/functions_detail.php");
    require_once("./functions/functions_update_result.php");

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

    //--------------house_locations id's ophalen---
      houses_locations($house_id);
      $str_location_id= $_SESSION["location_id"];
      $arr_location_id = explode(",", $str_location_id);

      //-----location_value------
      $str_value_locations="";
      foreach ($arr_location_id as $item) {
        value_location($item); // value_location
        $str_value_locations.= $_SESSION["value_location"];
      }
    //--------------house_propertie ids ophalen----
      houses_properties($house_id);
      $str_propertie_id= $_SESSION["propertie_id"];
      $arr_propertie_id = explode(",", $str_propertie_id);
      
      //-----propertie_value------
      $str_value_properties="";
      foreach ($arr_propertie_id as $item) {
        value_propertie($item); // value_propertie
        $str_value_properties.= $_SESSION["value_propertie"];
      }
    //--------------house_status ids ophalen-------
      houses_status($house_id);
      $str_status_id= $_SESSION["status_id"];
      $arr_status_id = explode(",", $str_status_id);

      //-----status_value------
      $str_value_status="";
      foreach ($arr_status_id as $item) {
        value_status($item); // value_status
        $str_value_status.= $_SESSION["value_status"];
      }
    //Dit werkt niet in een functie
      //$counter= substr_count($str_value_status, $str_value_locations);
      //if($counter> 0){
      //  echo "checked= \"checked\"";
      //}
    
  ?>
    <form action="./update_result.php?house_id=<?php echo $house_id; ?>" method="post" enctype="multipart/form-data"><role="form">
      <h1><?php echo $title; ?></h1>
      <table class="col-12">
        <tr class="col-12">
    	    <td class="col-12">
            <input class="col-5" type="text" name="title" value="<?php echo $title; ?>"> 
            <input class="col-5" type="text" name="price" value="<?php echo $price; ?>">
          </td>
    	  </tr>
        <tr class="col-12">
    	    <td class="col-12">
            <input class="col-5" type="text" name="address" value="<?php echo $address; ?>">
            <input class="col-5" type="text" name="postalcode" value="<?php echo $postalcode; ?>">
          </td>
    	  </tr>
        <tr class="col-12">
    	    <td class="col-12">
            <input class="col-5" type="text" name="place" value="<?php echo $place; ?>">
            <textarea class="col-5" input type="text" name="description" ><?php echo $description; ?></textarea>
          </td>
    	  </tr>
        <tr class="col-12">
    	    <td class="col-12">
            <label class="col-7">
              <b>Default Afbeelding:</b>  <input type="file" name="first_photo" accept="image/*">
            </label>
          </td>
    	  </tr>
        <tr class="col-12">
    	    <td class="col-12">
            <b class="col-12">4 Afbeelding kiezen: </b>
          </td>
          <td class="col-12">
            <label><b>1</b>
              <input class="col-2" type="file" name="photo_1" accept="image/*">              
            </label>
            <label>2
              <input class="col-2" type="file" name="photo_2" accept="image/*">
            </label>
            <label>3
              <input class="col-2" type="file" name="photo_3" accept="image/*">              
            </label>
            <label><b>4</b>
              <input class="col-2" type="file" name="photo_4" accept="image/*">
            </label>           
          </td>
        </tr>
          <!-- -----------start----Ligging------------------ -->
        <tr class="col-12">
          <td class="col-11">
            <b>Ligging:</b>          
            <label>
              <input type="checkbox" name="location[]" value="0" <?php $counter= substr_count($str_value_locations,"bos"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              -Dicht bij een bos.
            </label>          
            <label>
              <input type="checkbox" name="location[]" value="1" <?php $counter= substr_count($str_value_locations,"stad"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              -Dicht bij een stad.
            </label>          
            <label>
              <input type="checkbox" name="location[]" value="2" <?php $counter= substr_count($str_value_locations,"zee"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              -Dicht bij de zee.
            </label>          
            <label>
              <input type="checkbox" name="location[]" value="3" <?php $counter= substr_count($str_value_locations,"heuvelland"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              -In het heuvelland.
            </label>          
            <label>
              <input type="checkbox" name="location[]" value="4" <?php $counter= substr_count($str_value_locations,"water"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              -Aan het water.
            </label>
          </td>
        </tr>
        <!-- ----------einde-----Ligging------------------ -->
        <!-- ----------start-----Eigenschappen------------------ -->
        <tr class="col-12">
          <td class="col-11">
            <b>Eigenschappen:</b>          
            <label>
              <input type="checkbox" name="properties[]" value="0" <?php $counter= substr_count($str_value_properties,"inventaris"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              -Inclusief overname inventaris.
            </label>          
            <label>
              <input type="checkbox" name="properties[]" value="1" <?php $counter= substr_count($str_value_properties,"Zwembad"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              -Zwembad op het park.
            </label>          
            <label>
              <input type="checkbox" name="properties[]" value="2" <?php $counter= substr_count($str_value_properties,"Winkel"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              -Winkel op het park.
            </label>          
            <label>
              <input type="checkbox" name="properties[]" value="3" <?php $counter= substr_count($str_value_properties,"Entertainment"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              -Entertainment op het park.
            </label>          
            <label>
              <input type="checkbox" name="properties[]" value="4" <?php $counter= substr_count($str_value_properties,"privepark"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              -Op een privepark.
            </label>
          </td>
        </tr>
        <tr class="col-12">
          <td class="col-11">
            <b>Status:</b>
            <label>
              <input type="radio" name="status[]" value="0" <?php $counter= substr_count($str_value_status,"beschikbaar"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              beschikbaar
            </label>
            <label>
              <input type="radio" name="status[]" value="1" <?php $counter= substr_count($str_value_status,"verkocht"); if($counter> 0){ echo "checked= \"checked\"";}?> >
              verkocht
            </label>
          </td>
        </tr>
        <!-- ---------einde------Eigenschappen------------------ -->
    	  <tr class="col-12">
    	    <td><input class="a_next" type="submit" name="submit" value="Opslaan"></td>
    	  </tr>
      </table>
    </form>

  </body>
</html>
