<!-- aanmaak datum: 00/05/2021, 09:30. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<?php
  if(!isset($_SESSION)){//SESSION start al die niet gestart is
    session_start();
  }
  if(!isset($_SESSION["login"]) || $_SESSION["login"]!=="true"){//chek if logged in
    header("location:login.php");
  }

  if(!isset($_POST["house_id"]) || empty($_POST["house_id"])){//POST----------niet--GET
    echo "Huis ID is niet mee gegeven.";
    exit;
  }else{
    $house_id= $_POST["house_id"];
  }

  require_once("./functions/functions_form_result.php");

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
    chek_if_not_isset_or_empty($selected_status);

    $title= $_POST["title"];
    $price= $_POST["price"];
    $address= $_POST["address"];
    $postalcode= $_POST["postalcode"];
    $place= $_POST["place"];
    $description= $_POST["description"];

  //-------Update-to-DataBase--------------------------------------------------
    include("./database/config.php");
    include("./database/opendb.php");

    $query ="UPDATE houses ";
    $query .="Set  title = ?, price = ?, description  = ?, status  = ?, address  = ?, postalcode  = ?, place  = ? ";
    $query .="WHERE house_id = ?  ";

	  $preparedQuery = $dbaselink->prepare($query);
	  $preparedQuery->bind_param("sssssssi",$title, $price, $description, $selected_status, $address, $postalcode, $place, $house_id);
	  $result = $preparedQuery->execute();

	  if(($preparedQuery->errno) || ($result === false)){
	    echo $preparedQuery->error;
	    echo "<center><h3>-Fout bij uitvoeren commando.</h3></center><br><br>";
	    echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	    exit;
	  }else{
	    $added= "De gegevens van het huis is gewijzigd";
	    echo "<script type='text/javascript'>alert('$added');</script>";
	    echo '<meta http-equiv="refresh" content="0;URL=\'overview.php\'">';
	  }
    $preparedQuery->close();
  
  include("./database/closedb.php");

?>