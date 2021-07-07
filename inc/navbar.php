<!-- aanmaak datum: 09/06/2021, 11:14. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<!-- associative array link than title. -->
<?php
  if(!isset($_SESSION)){//SESSION start al die niet gestart is
    session_start();
  }
  $pages= array("index.php" => "Home", "login.php" => "login", "contact.php" => "contact");

  if(isset($_SESSION["login"]) && $_SESSION["login"]=="true"){//nav for users
    $pages= array("index.php" => "Home", "add_new_house.php" => "woning toegoegen", "overview.php" => "overzicht", "logout.php" => "afmelden");
  }  
?>

<link rel="stylesheet" href="./css/header.css">
<nav class="col-m-12 col-12">
  <header>
    <a href="./index.php"><img class="col-1" src="./images/logo.png" alt="Website logo"></a><p>welkom bij woningen.nl</p>
  </header>
  <ul>
    <!-- put the li and a -->
    <?php foreach($pages as $link => $title){echo "<li class=\"col-m-12 li-nav\"><a href=\"".$link."\">".$title."</a></li>";}?>
  </ul>
</nav>


	  