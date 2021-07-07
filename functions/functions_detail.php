<!-- aanmaak datum: 1/07/2021, 17:17. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<?php
  if(!isset($_SESSION)){//SESSION start al die niet gestart is
    session_start();
  }
 
  //--------------Select_house_database---------------------------
    function house_data($house_id){
	  include("./database/config.php");
      include("./database/opendb.php");
	  $query = "SELECT title, price, description, address, postalcode, place FROM houses WHERE house_id= ?";

	  $preparedQuery=$dbaselink->prepare($query);  
	  $preparedQuery->bind_param("i",$house_id);
	  $preparedQuery->execute();
  
	  if($preparedQuery->errno){
	    echo "query is not working";
	  }else{
	    $result=$preparedQuery->get_result();
	    if($result->num_rows===0){
	      echo "-Er is geen huis met HUIS ID: <b>".$house_id."</b>  gevonden";
          exit;    
	    }
	  }
	  $preparedQuery->close();
  
	  while($row=$result->fetch_assoc ()){//putting values in SESSIONS are only useful for 1 line result in detail.php
	    $_SESSION["title"]= $row["title"];
	    $_SESSION["price"]= $row["price"];
	    $_SESSION["address"]= $row["address"];
	    $_SESSION["postalcode"]= $row["postalcode"];
	    $_SESSION["place"]= $row["place"];
	    $_SESSION["description"]= $row["description"];
	  }	
	  include("./database/closedb.php");
    }
  //--------------Select_images_database--------------------------
    function images_path($house_id){
      include("./database/config.php");
      include("./database/opendb.php");
      $query = "SELECT image_path FROM images WHERE house_id= ? ORDER BY `images`.`order` ASC";

      $preparedQuery=$dbaselink->prepare($query);  
      $preparedQuery->bind_param("i",$house_id);
      $preparedQuery->execute();

      if($preparedQuery->errno){
        echo "query is not working ";
      }else{
        $result=$preparedQuery->get_result();
        if($result->num_rows===0){
          echo "-Er zijn geen afbeeldingen voor dit huis met HUIS ID: <b>".$house_id."</b>  gevonden";
          exit;    
        }
      }
      $preparedQuery->close();
      
      $str_images_path="";
      while($row=$result->fetch_assoc ()){
        $str_images_path.= $row["image_path"].","; //voeg image_path aan de string
      }
	  $str_images_path = rtrim($str_images_path, ','); //rtrim means: right trim at the end.
	  
	  $_SESSION["images_path"]= $str_images_path;

	  include("./database/closedb.php");
	}
  //--------------houses_locations--------------------------------
    function houses_locations($house_id){	
	  include("./database/config.php");
      include("./database/opendb.php");
      $query = "SELECT location_id FROM houses_locations WHERE house_id=?";

      $preparedQuery=$dbaselink->prepare($query);  
      $preparedQuery->bind_param("i",$house_id);
      $preparedQuery->execute();

      if($preparedQuery->errno){
        echo "query is not working ";
      }else{
        $result=$preparedQuery->get_result();
        if($result->num_rows===0){
          echo "-Er is geen location_id met HUIS ID: <b>".$house_id."</b>  gevonden";
          exit;    
        }
      }
      $preparedQuery->close();
      
	  $str_location_id="";
      while($row=$result->fetch_assoc ()){
        $str_location_id.= $row["location_id"].",";//voeg image_path aan de string
      }
	  $str_location_id = rtrim($str_location_id, ','); //rtrim means: right trim at the end.
	  $_SESSION["location_id"]= $str_location_id;

	  include("./database/closedb.php");
	}
    //----------------value_location--------------------------------
    function value_location($location_id){	
	  include("./database/config.php");
      include("./database/opendb.php");
      $query = "SELECT value_location FROM `locations` WHERE location_id=?";

      $preparedQuery=$dbaselink->prepare($query);  
      $preparedQuery->bind_param("i",$location_id);
      $preparedQuery->execute();

      if($preparedQuery->errno){
        echo "query is not working ";
      }else{
        $result=$preparedQuery->get_result();
        if($result->num_rows===0){
          echo "-Er is geen location met location ID: <b>".$location_id."</b>  gevonden";
          exit;    
        }
      }
      $preparedQuery->close();
      $value_location="";
      while($row=$result->fetch_assoc ()){
        $value_location.= $row["value_location"].",";//voeg image_path aan de string
      }
	  $value_location = rtrim($value_location, ','); //rtrim means: right trim at the end.
	  $_SESSION["value_location"]= $value_location;

	  include("./database/closedb.php");
	}

  //--------------houses_properties-------------------------------
    function houses_properties($house_id){	
	  include("./database/config.php");
	  include("./database/opendb.php");
	  $query = "SELECT propertie_id FROM houses_properties WHERE house_id=?";
  
	  $preparedQuery=$dbaselink->prepare($query);  
	  $preparedQuery->bind_param("i",$house_id);
	  $preparedQuery->execute();
  
	  if($preparedQuery->errno){
	    echo "query is not working ";
	  }else{
	    $result=$preparedQuery->get_result();
	    if($result->num_rows===0){
	  	echo "-Er is geen propertie_id met HUIS ID: <b>".$house_id."</b>  gevonden";
	  	exit;    
	    }
	  }
	  $preparedQuery->close();
	  
	  $str_propertie_id="";
	  while($row=$result->fetch_assoc ()){
	    $str_propertie_id.= $row["propertie_id"].",";//voeg image_path aan de string
	  }
	  $str_propertie_id = rtrim($str_propertie_id, ','); //rtrim means: right trim at the end.
	  $_SESSION["propertie_id"]= $str_propertie_id;
  
	  include("./database/closedb.php");
	}
	//----------value_propertie
	  function value_propertie($propertie_id){	
		include("./database/config.php");
		include("./database/opendb.php");
		$query = "SELECT value_propertie FROM `properties` WHERE propertie_id=?";
  
		$preparedQuery=$dbaselink->prepare($query);  
		$preparedQuery->bind_param("i",$propertie_id);
		$preparedQuery->execute();
  
		if($preparedQuery->errno){
		  echo "query is not working ";
		}else{
		  $result=$preparedQuery->get_result();
		  if($result->num_rows===0){
			echo "-Er is geen propertie met propertie ID: <b>".$propertie_id."</b>  gevonden";
			exit;    
		  }
		}
		$preparedQuery->close();
		$value_propertie="";
		while($row=$result->fetch_assoc ()){
		  $value_propertie.= $row["value_propertie"].",";//voeg image_path aan de string
		}
		$value_propertie = rtrim($value_propertie, ','); //rtrim means: right trim at the end.
		$_SESSION["value_propertie"]= $value_propertie;
  
		include("./database/closedb.php");
	  }
  //--------------houses_status-------------------------------
    function houses_status($house_id){	
	  include("./database/config.php");
	  include("./database/opendb.php");
	  $query = "SELECT status_id FROM houses_status WHERE house_id=?";

	$preparedQuery=$dbaselink->prepare($query);  
	$preparedQuery->bind_param("i",$house_id);
	$preparedQuery->execute();

	if($preparedQuery->errno){
	  echo "query is not working ";
	}else{
	  $result=$preparedQuery->get_result();
	  if($result->num_rows===0){
		echo "-Er is geen status_id met HUIS ID: <b>".$house_id."</b>  gevonden";
		exit;    
	  }
	}
	$preparedQuery->close();
	
	$str_status_id="";
	while($row=$result->fetch_assoc ()){
	  $str_status_id.= $row["status_id"].",";//voeg image_path aan de string
	}
	$str_status_id = rtrim($str_status_id, ','); //rtrim means: right trim at the end.
	$_SESSION["status_id"]= $str_status_id;

	include("./database/closedb.php");
  }
//----------value_status
  function value_status($status_id){	
	include("./database/config.php");
	include("./database/opendb.php");
	$query = "SELECT value_status FROM `status` WHERE status_id=?";

	$preparedQuery=$dbaselink->prepare($query);  
	$preparedQuery->bind_param("i",$status_id);
	$preparedQuery->execute();

	if($preparedQuery->errno){
	  echo "query is not working ";
	}else{
	  $result=$preparedQuery->get_result();
	  if($result->num_rows===0){
		echo "-Er is geen status met status ID: <b>".$status_id."</b>  gevonden";
		exit;    
	  }
	}
	$preparedQuery->close();
	$value_status="";
	while($row=$result->fetch_assoc ()){
	  $value_status.= $row["value_status"].",";//voeg image_path aan de string
	}
	$value_status = rtrim($value_status, ','); //rtrim means: right trim at the end.
	$_SESSION["value_status"]= $value_status;

	include("./database/closedb.php");
  }
  
?>