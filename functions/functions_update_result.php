
<!-- aanmaak datum: 08/07/2021, 09:39. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<?php
  //--------------update_house--6 values + id megeven------------------
    function update_house($title,$price,$description,$address,$postalcode,$place,$house_id){
      include("./database/config.php");
      include("./database/opendb.php");

      $query="UPDATE houses ";
      $query.="SET title= ?, price= ?, description= ?, address= ?, postalcode= ?, place= ? ";
      $query.="WHERE house_id = ?";

	    $preparedQuery=$dbaselink->prepare($query);  
	    $preparedQuery->bind_param("ssssssi",$title,$price,$description,$address,$postalcode,$place,$house_id);
	    $preparedQuery->execute();
  
      if($preparedQuery->errno){ 
	      echo "query is not working for house table";
	    }else{
        //house is toegevoegd;
        echo "Houses tabel is gewijzigd<br>";
	    }
	    $preparedQuery->close();
    }
  //--------------Delete locations from data base-----------
    function delete_locations($house_id){
      include("./database/config.php");
      include("./database/opendb.php");

      $query="DELETE FROM houses_locations ";
      $query.="WHERE house_id = ? ";
      $query.="LIMIT 5";

      $preparedQuery=$dbaselink->prepare($query);
      $preparedQuery->bind_param("i",$house_id);
      $result=$preparedQuery->execute(); 
        if(($preparedQuery->errno)or($result===false)){ 
        echo "locatie bestaat niet<br>";
        }else{
          echo "locaties is verwijderd<br>";
        }
      $preparedQuery->close();
    }
  //--------------Delete properties from data base----------
    function delete_properties($house_id){
      include("./database/config.php");
      include("./database/opendb.php");

      $query="DELETE FROM houses_properties ";
      $query.="WHERE house_id = ? ";
      $query.="LIMIT 5";

      $preparedQuery=$dbaselink->prepare($query);
      $preparedQuery->bind_param("i",$house_id);
      $result=$preparedQuery->execute(); 
        if(($preparedQuery->errno)or($result===false)){ 
        echo "Eigenschapp bestaat niet<br>";
        }else{
          echo "Eigenschappen zijn verwijderd<br>";
        }
      $preparedQuery->close();
    }
  //--------------Delete status from data base--------------
    function delete_status($house_id){
      include("./database/config.php");
      include("./database/opendb.php");

      $query="DELETE FROM houses_status ";
      $query.="WHERE house_id = ? ";
      $query.="LIMIT 1";

      $preparedQuery=$dbaselink->prepare($query);
      $preparedQuery->bind_param("i",$house_id);
      $result=$preparedQuery->execute(); 
        if(($preparedQuery->errno)or($result===false)){ 
        echo "status bestaat niet <br>";
        }else{
          echo "De status is verwijderd <br>";
        }
      $preparedQuery->close();
    }
  //--------------insert houses_location ---------------
    function insert_up_houses_locations($house_id, $location_id){
      include("./database/config.php");
      include("./database/opendb.php");
      
      $query = "INSERT INTO houses_locations (house_id, location_id) ";
      $query .= "VALUES (?,?) ";
  
      $preparedQuery=$dbaselink->prepare($query);
      $preparedQuery->bind_param("is", $house_id, $location_id);
      $preparedQuery->execute();
  
      //location value is toegevoegd;
      echo "locatie is toegevoed<br>";
    }
  //--------------insert houses_propertie --------------
    function insert_up_houses_properties($house_id, $propertie_id){
      include("./database/config.php");
      include("./database/opendb.php");
      
      $query = "INSERT INTO houses_properties (house_id, propertie_id) ";
      $query .= "VALUES (?,?) ";
  
      $preparedQuery=$dbaselink->prepare($query);
      $preparedQuery->bind_param("is", $house_id, $propertie_id);
      $preparedQuery->execute();
  
      //propertie value is toegevoegd;
      echo "propertie is toegevoed<br>";
    }
  //--------------insert houses_status -----------------
    function insert_up_houses_status($house_id, $status_id){
      include("./database/config.php");
      include("./database/opendb.php");
      
      $query = "INSERT INTO houses_status (house_id, status_id) ";
      $query .= "VALUES (?,?) ";
  
      $preparedQuery=$dbaselink->prepare($query);
      $preparedQuery->bind_param("is", $house_id, $status_id);
      $preparedQuery->execute();
  
      //status value is toegevoegd;
      echo "status is toegevoed<br>";
      $preparedQuery->close();
    }


?>