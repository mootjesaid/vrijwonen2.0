<!-- aanmaak datum: 08/07/2021, 11:07. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<?php
  if(!isset($_SESSION)){//SESSION start al die niet gestart is
    session_start();
  }
  if(!isset($_SESSION["login"]) || $_SESSION["login"]!=="true"){//chek if logged in
    header("location:login.php");
  }

  //chek the ID
  if(!isset($_GET["house_id"]) || empty($_GET["house_id"])){
    echo "Huis ID is niet mee gegeven.";
    exit;
  }else{
    $house_id= $_GET["house_id"];
  }

  require_once("./functions/functions_form_result.php");
  require_once("./functions/functions_update_result.php");
  require_once("./functions/functions_detail.php");

  $title= $_POST["title"];
  $price= $_POST["price"];
  $description= $_POST["description"];
  $address= $_POST["address"];
  $postalcode= $_POST["postalcode"];
  $place= $_POST["place"];
  
  //var_dump($_FILES["photos"]);

  //-------Update - images------------------------------------------------
    //images_path($house_id);
    //$str_images_path= $_SESSION["images_path"];
    //$arr_images_path = explode(",", $str_images_path);
    // Delete---images
    // if (file_exists('images/1---1.jpg')){
    //   unlink('images/1---1.jpg');
    //   echo "File Successfully Delete."; 
    // }else{
    //   echo "File does not exists"; 
    // }
  //-------Update-house---------------------------------------------------
    update_house($title,$price,$description,$address,$postalcode,$place,$house_id);
  //-------Delete -houses_locations------------------------------------------------
    delete_locations($house_id);
  //-------Delete -houses_properties-----------------------------------------------
    delete_properties($house_id);
  //-------Delete -houses_status---------------------------------------------------
    delete_status($house_id);

  //-------insert -houses_locations------------------------------------------------
    //-------Chek-the-selected-propreties --
    $locations= ["1","2","3","4","5"];
    $selected_locations=""; //at the end i put it in a string.

    if(isset($_POST["locations"])){
      $posted_locations= $_POST["locations"]; // the vallue of the selected ones in the form in an array
      foreach($posted_locations as $item) {//i define the right location value based on the value that i get out the form and put it in a string.
        $selected_locations.= $locations[$item].",";
      }

      $selected_locations = rtrim($selected_locations, ','); //rtrim means: right trim at the end.
      $arr_selected_locations = explode(",", $selected_locations);

      foreach ($arr_selected_locations as $item) {
        insert_up_houses_locations($house_id, $item);
      }
    }
  //-------insert -houses_properties------------------------------------------------
    $properties= ["1","2","3","4","5"];
    $selected_properties="";

    if(isset($_POST["properties"])){
      $posted_properties= $_POST["properties"];
      foreach($posted_properties as $item) {
        $selected_properties.= $properties[$item].",";
      }

      $selected_properties = rtrim($selected_properties, ',');
      $arr_selected_properties = explode(",", $selected_properties);
      foreach ($arr_selected_properties as $item) {
        insert_up_houses_properties($house_id, $item);
      }
    }
  //-------insert -houses_staus-----------------------------------------------------
    $status= ["1","2"];
    $selected_status="";

    if(isset($_POST["status"])){
      $posted_status= $_POST["status"];
      foreach($posted_status as $item) {
        $selected_status.= $status[$item].",";
      }

      $selected_status = rtrim($selected_status, ',');
      $arr_selected_status = explode(",", $selected_status);
      foreach ($arr_selected_status as $item) {
        insert_up_houses_status($house_id, $item);
      }
    }
    $added= "Het huis is gewijzigd";
    echo "<script type='text/javascript'>alert('$added');</script>";
    echo '<meta http-equiv="refresh" content="0;URL=\'./detail.php?house_id='.$house_id.'\'">';
    
?>