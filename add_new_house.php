<!-- aanmaak datum: 09/06/2021, 11:14. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<?php
  if(!isset($_SESSION)){//SESSION start al die niet gestart is
    session_start();
  }
  if(!isset($_SESSION["login"]) || $_SESSION["login"]=="false"){//chek if logged in
    header("location:login.php");
  }
?>
<!doctype html>
<html lang="nl">
  <head>
	  <title>woning - toevoegen</title>

	  <meta charset="UTF-8">
	  <meta name="description" content="In deze geweldige pagina kunt u allerlei revieuws toevoegen. U bent van harte welkom ...">
	  <meta name="keywords" content="Knowitall, review, gasten, welkom">
	  <meta name="author" content="Mohamad Dian Bah">
	  <meta name="robots" content="all">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="icon" href="images/logo.png" sizes="16x16">
	  <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
  <?php require "inc/navbar.php"; ?>
    <form action="./add_new_house_result.php" method="post" enctype="multipart/form-data"><role="form">
      <h1>Woning registreren</h1>
      <table class="col-12">
        <tr class="col-12">
    	    <td class="col-12"><input class="col-5" type="text" name="title" placeholder="Titel"> <input class="col-5" type="text" name="price" placeholder="Prijs"></td>
    	  </tr>
        <tr class="col-12">
    	    <td class="col-12"><input class="col-5" type="text" name="address" placeholder="Adres"> <input class="col-5" type="text" name="postalcode" placeholder="Postcode"></td>
    	  </tr>
        <tr class="col-12">
    	    <td class="col-12"><input class="col-5" type="text" name="place" placeholder="Plaats"><textarea class="col-5" input type="text" name="description" placeholder="Omschijving*"></textarea></td>
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
              <input type="checkbox" name="location[]" value="0">
              -Dicht bij een stad.
            </label>          
            <label>
              <input type="checkbox" name="location[]" value="1">
              -Dicht bij een bos.
            </label>          
            <label>
              <input type="checkbox" name="location[]" value="2">
              -Dicht bij de zee.
            </label>          
            <label>
              <input type="checkbox" name="location[]" value="3">
              -In het heuvelland.
            </label>          
            <label>
              <input type="checkbox" name="location[]" value="4">
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
              <input type="checkbox" name="properties[]" value="0">
              -Inclusief overname inventaris.
            </label>          
            <label>
              <input type="checkbox" name="properties[]" value="1">
              -Zwembad op het park.
            </label>          
            <label>
              <input type="checkbox" name="properties[]" value="2">
              -Winkel op het park.
            </label>          
            <label>
              <input type="checkbox" name="properties[]" value="3">
              -Entertainment op het park.
            </label>          
            <label>
              <input type="checkbox" name="properties[]" value="4">
              -Op een privepark.
            </label>
          </td>
        </tr>
        <tr class="col-12">
          <td class="col-11">
            <b>Status:</b>
            <label>
              <input type="radio" name="status[]" value="0">
              beschikbaar
            </label>
            <label>
              <input type="radio" name="status[]" value="1">
              verkocht
            </label>
          </td>
        </tr>
        <!-- ---------einde------Eigenschappen------------------ -->
    	  <tr class="col-12">
    	    <td><input class="a_next" type="submit" name="submit" value="verzenden"></td>
    	  </tr>
      </table>
    </form>

  </body>
</html>