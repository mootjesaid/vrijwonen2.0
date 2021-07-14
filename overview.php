<!-- aanmaak datum: 09/06/2021, 11:14. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<?php
  if(!isset($_SESSION)){//SESSION start al die niet gestart is
    session_start();
  }
  if(!isset($_SESSION["login"]) || $_SESSION["login"]!=="true"){//chek if logged in
    header("location:login.php");
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
      require_once("./functions/functions_overview.php");

      include("./database/config.php");
      include("./database/opendb.php");

      ?>

    <form action="" method="post">
        <input type="text" placeholder="Search"  name="search"></input>
        <button type="submit" name="submit">Zoek</button>
        <button type="submit" name="alles">Alles</button>
    </form>


    <?php


    //Select data from 3 tables
    if(!isset($_POST['search']) || trim($_POST['search']) == '')
    {
        $query = "SELECT h.house_id, h.title, h.price, i.image_path
      FROM houses h
      LEFT JOIN images i ON i.house_id = h.house_id
      WHERE i.order=1";

    } else{
        $searchValue = $_POST['search'];
        //Select data from 3 tables
        $query = "SELECT h.house_id, h.title, h.price, i.image_path
      FROM houses h
      LEFT JOIN images i ON i.house_id = h.house_id
      WHERE i.order=1 && place LIKE '%$searchValue'
      ";
    }


    $preparedQuery=$dbaselink->prepare($query);
    $preparedQuery->execute();

    if($preparedQuery->errno){
        echo "query is not working ";
    }else{
        $result=$preparedQuery->get_result();
        if($result->num_rows===0){
            echo "-Op dit momment er zijn geen woningen beschikbaar";
        }
    }
    $preparedQuery->close();
    echo "<table class= \"col-12\">
              <tr class=\"tr_over col-11\">";
    while($row=$result->fetch_assoc ()){
        echo "          
                <td class=\"col-4\">
                  <img class=\"col-6\" src='./images/".$row["image_path"]."' id=\"img\" alt=\"Afbeelding van het huis\">
                  <b class=\"col-5\">".$row["title"]."</b>
                  <span class=\"col-5\">€".$row["price"]." <a class=\"a_detail\" href=\"./detail.php?house_id=".$row["house_id"]."\"> Detail</a><span>
                </td>         
            ";
    }
    echo " </tr>
          </table>";






    include("./database/closedb.php");



    ?>


  </body>
</html>
