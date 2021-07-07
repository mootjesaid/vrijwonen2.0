<?php
  if(!isset($_SESSION)){//SESSION start al die niet gestart is
    session_start();
  }

  if (isset($_SESSION["login"])) {
    if ($_SESSION["login"] == "true") {//als je ingelog bent, dan gaan we verder.
      unset($_SESSION["user_id"]);
      unset($_SESSION["user_name"]);

      $_SESSION["login"] = "false";
    }
    if ($_SESSION["login"] == "false") {
      header("Location: login.php");
      exit;
    }else{
      echo "error";
    }
  }else{
    header("Location: login.php");
    exit;
  }
?>