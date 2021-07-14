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

        foreach ($arr_selected_locations as $item) {
            insert_locations_value($_SESSION["house_id"] + 1,$item);
        }
    }//-------end locations--
  //-------Chek-the-selected-propreties-------------------------------------------
    $properties= [
	    "1",
	    "2",
	    "3",
	    "4",
	    "5"
    ];
    $selected_properties= "";

if(isset($_POST["properties"])){
    $posted_properties= $_POST["properties"]; // the vallue of the selected ones in the form in an array
    foreach($posted_properties as $item1) {//i define the right location based on the value that i get out the form and put it in a string.
        // printf("<p>%s - %s - (%s)</p>",$locations[$item],"was de keuze", "woei");
        $selected_properties.= $properties[$item1].",";
    }

    $selected_properties = rtrim($selected_properties, ','); //rtrim means: right trim at the end.
    $arr_selected_properties = explode(",", $selected_properties);

    foreach ($arr_selected_properties as $item1) {
        insert_properties_value($_SESSION["house_id"] + 1,$item1 );
    }

    }//------end-propreties-
  //-------Chek-the-selected-status-----------------------------------------------
    $status= [
	    "1",
	    "2"
    ];

$selected_status= "";

if(isset($_POST["status"])){
    $posted_status= $_POST["status"]; // the vallue of the selected ones in the form in an array
    foreach($posted_status as $item1) {//i define the right location based on the value that i get out the form and put it in a string.
        // printf("<p>%s - %s - (%s)</p>",$locations[$item],"was de keuze", "woei");
        $selected_status.= $status[$item1].",";
    }

    $selected_status = rtrim($selected_status, ','); //rtrim means: right trim at the end.
    $arr_selected_status = explode(",", $selected_status);

    foreach ($arr_selected_status as $item1) {
        insert_status_value($_SESSION["house_id"] + 1,$item1 );
    }
    }//end-selected-status


  //-------chek-if-!isset-or-empty-function---------------------------------------
    /*    chek_if_not_isset_or_empty($_POST["title"]);
        chek_if_not_isset_or_empty($_POST["price"]);
        chek_if_not_isset_or_empty($_POST["address"]);
        chek_if_not_isset_or_empty($_POST["postalcode"]);
        chek_if_not_isset_or_empty($_POST["place"]);
        chek_if_not_isset_or_empty($_POST["description"]);
        chek_if_not_isset_or_empty($selected_properties);
        chek_if_not_isset_or_empty($selected_locations);
        chek_if_not_isset_or_empty($selected_status);
    */

    $title= $_POST["title"];
    $price= $_POST["price"];
    $address= $_POST["address"];
    $postalcode= $_POST["postalcode"];
    $place= $_POST["place"];
    $description= $_POST["description"];

  //-------first_photo-chek-AND-Upload-to-map-images-function---------------------



include 'dbConfig.php';


// File upload path
$targetDir = "images/";
$fileName = basename($_FILES["first_photo"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$house_id = $_SESSION["house_id"] + 1;

if(isset($_POST["submit"]) && !empty($_FILES["first_photo"]["name"])) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["first_photo"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $order = 1;
            $insert = $db->query("INSERT into images (image_path, house_id, `order`) VALUES ('" . $fileName . "', '" . $house_id . "','" . $order . "')");
        }
    }
}

// File upload path
$targetDir = "images/";
$fileName = basename($_FILES["photo_1"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$house_id = $_SESSION["house_id"] + 1;

if(isset($_POST["submit"]) && !empty($_FILES["photo_1"]["name"])) {
    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["photo_1"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $order = 2;
            $insert = $db->query("INSERT into images (image_path, house_id, `order`) VALUES ('" . $fileName . "', '" . $house_id . "','" . $order . "')");
        }
    }
}

// File upload path
$targetDir = "images/";
$fileName = basename($_FILES["photo_2"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType1 = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["photo_2"]["name"])) {
    // Allow certain file formats
    $allowTypes1 = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType1, $allowTypes1)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["photo_2"]["tmp_name"], $targetFilePath)) {
            // Insert image file name into database
            $order = 3;
            $insert = $db->query("INSERT into images (image_path, house_id, `order`) VALUES ('" . $fileName . "', '" . $house_id . "','" . $order . "')");
        }
    }
}



// File upload path
$targetDir = "images/";
$fileName = basename($_FILES["photo_3"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType1 = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["photo_3"]["name"])){
    // Allow certain file formats
    $allowTypes1 = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType1, $allowTypes1)){
        // Upload file to server
        if(move_uploaded_file($_FILES["photo_3"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $order = 4;
            $insert = $db->query("INSERT into images (image_path, house_id, `order`) VALUES ('".$fileName."', '".$house_id."','".$order."')");
        }
    }
}


// File upload path
$targetDir = "images/";
$fileName = basename($_FILES["photo_4"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType1 = pathinfo($targetFilePath,PATHINFO_EXTENSION);

if(isset($_POST["submit"]) && !empty($_FILES["photo_4"]["name"])){
    // Allow certain file formats
    $allowTypes1 = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType1, $allowTypes1)){
        // Upload file to server
        if(move_uploaded_file($_FILES["photo_4"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $order = 5  ;
            $insert = $db->query("INSERT into images (image_path, house_id, `order`) VALUES ('".$fileName."', '".$house_id."','".$order."')");
        }
    }
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
    // Display status message


      ?>
  </body>
</html>

<?php









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

$sql = "INSERT INTO houses (title, price, description, address, postalcode, place)
VALUES ('".$_POST["title"]."','".$_POST["price"]."','".$_POST["description"]."','".$_POST["address"]."', '".$_POST["postalcode"]."', '".$_POST["place"]."')";



if ($conn->query($sql) === TRUE) {
    $house_id = $conn->insert_id;
    $_SESSION["house_id"]= $house_id;
    echo "<p style=' height: 200px;
    position: fixed;
    top: 50%;
    left: 50%;
    font-weight: bolder;
    font-size: 1.5rem;
    margin-top: -100px;
    margin-left: -200px;'>Woning succesvol toegevoegd" ;

    echo "<a style='
    position: fixed;
    top: 60%;
    left: 50%;
    font-size: 1rem;
    font-weight: bold;
    margin-top: -100px;
    margin-left: -200px;' href=\"overview.php\">Ga naar overzicht</a>";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
