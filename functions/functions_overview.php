<!-- aanmaak datum: 06/06/2021, 15:17. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<?php
 
  //--------------start---Select_houses_from_database--------------------------
    function chek_if_not_isset_or_empty($inputName){
	  if(!isset($inputName) || empty($inputName)){
	    echo "<br><br><center><b>De formulier is niet volledig ingevuld</b><br>";
	    echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	    exit;
	  }
    }
  //--------------end---chek_if_not_isset_or_empty---------------------------chek-photo-----AND-Upload-to-map-images
  
?>