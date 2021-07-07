<!-- aanmaak datum: 05/06/2021, 09:30. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<?php
 
  //--------------start---chek_if_not_isset_or_empty--------------------------
  function chek_if_not_isset_or_empty($inputName){
	if(!isset($inputName) || empty($inputName)){
	  echo "<br><br><center><b>De formulier is niet volledig ingevuld</b><br>";
	  echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	  exit;
	}

	//Chek for injection.
	$pattern = "/[<\/>(){}$]/";
	$originel_inputName= $inputName;
	$inputName= preg_replace($pattern,"❄",substr(trim($inputName),0,1000));//❄❌	  
	if($inputName!==$originel_inputName){
	  echo "<br><br><center><h3>".$inputName."</h3><br>-Uw bericht bevat ongeldige tekens. op deze plek \"❄\"<br> Of Eindigt met een spatie.<br>";
	  echo "<br><a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	  exit;
	}

  }//--------------end---chek_if_not_isset_or_empty------------

  //---------------chek-photo-----AND-Upload-to-map-images
  function chek_photo_AND_Upload_to_map_images($fileName){
	if(isset($_FILES["".$fileName.""]) && (!empty($_FILES["".$fileName.""]["name"]))){

	  $target_dir = "images/";
	  if($fileName == "first_photo"){//to put the fist_photo in diffent map
		$target_dir= "images/first_image/";
	  }
	  $target_file = $target_dir . basename($_FILES["".$fileName.""]["name"]);//double

	  // Check if file already exists and change the name if he exist.
	  if(file_exists($target_file)){
	     //echo "<br>-Sorry, file already exists.<br>";
	    $rand= rand(1000000,20000000);
	    $rand .= $_FILES["".$fileName.""]["name"];
	    $_FILES["".$fileName.""]["name"]= $rand;
	  }
		
	  $target_file = $target_dir . basename($_FILES["".$fileName.""]["name"]);//double
	  $uploadOk = 1;
	  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	  // Check if image file is a actual image or fake image
	  if(isset($_POST["image"])){
	    $check = getimagesize($_FILES["".$fileName.""]["tmp_name"]);

	    if($check !== false){
	  	//echo "File is an image - " . $check["mime"] . ".";
	  	$uploadOk = 1;
	    }else{
	  	  echo "<br>-File is not an image.<br>";
		  echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	  	  $uploadOk = 0;
		  exit;			
	    }
	  }
	  // Check file size
	  if($_FILES["".$fileName.""]["size"] > 2000000){
	    echo "<br><center>-Sorry, your file is too large.</center><br><br>";
	    echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	    $uploadOk = 0;
	    exit;
	  }else{
	    // Allow certain file formats
	    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	      && $imageFileType != "gif" && $imageFileType != "webp" ){
	      echo "<br>-Sorry, only JPG, JPEG, WEBP, PNG & GIF files are allowed.<br><br>";
	  	  echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
			
		  $uploadOk = 0;
	      exit;
	    }
	  }
	    // Check if $uploadOk is set to 0 by an error
	  if($uploadOk == 0){
	    echo "<br>-Sorry, your file was not uploaded.<br><br>";
	    // if everything is ok, try to upload file
	    echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	    exit;
	  }else{
	  	if(move_uploaded_file($_FILES["".$fileName.""]["tmp_name"], $target_file)){
	  	  //echo "<br>-The file ". htmlspecialchars( basename( $_FILES["".$fileName.""]["name"])). " has been uploaded.";//--comment
	  	}else{
		  echo "<br>-Sorry, there was an error uploading your file.<br>";
	  	  echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
		  exit;
		}
	  }
	    
	}else{// image is not chosen
      echo "<br><br><center><b>U mag alle afbeeldingen selecteeren</b><br>";
	  echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	  exit;
    }
  }
  //$first_photo="".$_FILES["".$fileName.""]["name"]."";// This is the file name

  //-------end-photo-chek-------

?>