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

  $title= $_POST["title"];
  $price= $_POST["price"];
  $description= $_POST["description"];
  $address= $_POST["address"];
  $postalcode= $_POST["postalcode"];
  $place= $_POST["place"];
  
  //-------Update-house---------------------------------------------------
    update_house($title,$price,$description,$address,$postalcode,$place,$house_id);
    // Delete---images
    // if (file_exists('images/1---1.jpg')){
    //   unlink('images/1---1.jpg');
    //   echo "File Successfully Delete."; 
    // }else{
    //   echo "File does not exists"; 
    // }
  //-------Delete -houses_locations---------------------------------------------------
    delete_locations($house_id);
  //-------Delete -houses_properties---------------------------------------------------
    delete_properties($house_id);
  //-------Delete -houses_status---------------------------------------------------
    delete_status($house_id);
   

?>