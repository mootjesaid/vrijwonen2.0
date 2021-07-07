<!-- aanmaak datum: 00/05/2021, 09:30. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<?php
  if(!isset($_SESSION)){//SESSION start al die niet gestart is
    session_start();
  }
  if(!isset($_SESSION["login"]) || $_SESSION["login"]=="false"){//chek if logged in
    header("location:login.php");
  }

  require_once("./functions/functions_form_result.php");
  
  //-------Chek-the-selected-locations--------------------------------------------
    $locations= [
	    "1",
	    "2",
	    "3",
	    "4",
	    "5"
    ];
    $selected_locations=""; //at the end i put it in a string.
  
    if(isset($_POST["location"])){
	    $posted_locations= $_POST["location"]; // the vallue of the selected ones in the form in an array
	    foreach($posted_locations as $item) {//i define the right location based on the value that i get out the form and put it in a string.
	      // printf("<p>%s - %s - (%s)</p>",$locations[$item],"was de keuze", "woei");
	      $selected_locations.= $locations[$item].",";
	    }

        $selected_locations = rtrim($selected_locations, ','); //rtrim means: right trim at the end.
        $arr_selected_locations = explode(",", $selected_locations);


        $house_id=1;
        foreach ($arr_selected_locations as $item) {
            insert_locations_value($house_id,$item);
        }
    }//-------end locations--
  //-------Chek-the-selected-propreties-------------------------------------------
    $properties= [
	    "-Inclusief overname inventaris. ",
	    "-Zwembad op het park. ",
	    "-Winkel op het park. ",
	    "-Entertainment op het park. ",
	    "-Op een privepark. "
    ];
    $selected_properties= "";
    if(isset($_POST["properties"])){
	    $posted_properties= $_POST["properties"];
	    foreach($posted_properties as $item) {
	      $selected_properties.= $properties[$item];
	    }
      $max_lenght= strlen($selected_properties);
      $selected_properties= substr(trim($selected_properties),0,$max_lenght-2);
    }//------end-propreties-
  //-------Chek-the-selected-status-----------------------------------------------
    $status= [
	    "beschikbaar",
	    "verkocht"
    ];
    $selected_status= "";
    if(isset($_POST["status"])){
	    $posted_status= $_POST["status"];
	    foreach($posted_status as $item){
	      $selected_status.= $status[$item];
	    }
    }//end-selected-status
  //-------chek-if-!isset-or-empty-function---------------------------------------
    chek_if_not_isset_or_empty($_POST["title"]);
    chek_if_not_isset_or_empty($_POST["price"]);
    chek_if_not_isset_or_empty($_POST["address"]);
    chek_if_not_isset_or_empty($_POST["postalcode"]);
    chek_if_not_isset_or_empty($_POST["place"]);
    chek_if_not_isset_or_empty($_POST["description"]);
    chek_if_not_isset_or_empty($selected_properties);
    chek_if_not_isset_or_empty($selected_locations);
    chek_if_not_isset_or_empty($selected_status);

    $title= $_POST["title"];
    $price= $_POST["price"];
    $address= $_POST["address"];
    $postalcode= $_POST["postalcode"];
    $place= $_POST["place"];
    $description= $_POST["description"];

  //-------first_photo-chek-AND-Upload-to-map-images-function---------------------
    chek_photo_AND_Upload_to_map_images("first_photo");//$_FILES["first_photo"];
    chek_photo_AND_Upload_to_map_images("photo_1");
    chek_photo_AND_Upload_to_map_images("photo_2");
    chek_photo_AND_Upload_to_map_images("photo_3");
    chek_photo_AND_Upload_to_map_images("photo_4");

    $first_photo= $_FILES["first_photo"]["name"];

    $four_photos=""; //i make a string to put the phat in an array for later on.
    $four_photos.= $_FILES["photo_1"]["name"].",";
    $four_photos.= $_FILES["photo_2"]["name"].",";
    $four_photos.= $_FILES["photo_3"]["name"].",";
    $four_photos.= $_FILES["photo_4"]["name"];
    //-------end-photo-chek-------

  //-------Insirt-in-to-DataBase--------------------------------------------------
    include("./database/config.php");
    include("./database/opendb.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_woningen_update";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO houses (house_location_id, price, description, address, postalcode, place)
VALUES ('".$_POST["title"]."','".$_POST["price"]."','".$_POST["description"]."','".$_POST["address"]."', '".$_POST["postalcode"]."', '".$_POST["place"]."')";

$sql = "INSERT INTO houses_location (house_id, location_id)
VALUES ('".$_POST["house_id"]."','".$_POST["location[]"]."')";

$sql = "INSERT INTO houses_location (house_id, location_id)
VALUES ('".$_POST["house_id"]."','".$_POST["location[]"]."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

?>