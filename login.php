<!-- aanmaak datum: 09/06/2021, 11:14. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
<!doctype html>
<html lang="nl">
  <head>
	<title>woningen.nl - login</title>

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
    <form action="./login_result.php" method="post">

      <h2>Login om onderandere woningen toe te voegen.</h2>
      <table>
        <tr>
    	  <td><input type="text" name="user_name" placeholder="Gebruikers"></td>
    	</tr>
        <tr>
    	  <td><input type="password" name="password" placeholder="password"></td>
    	</tr>
    	<tr>
    	  <td><input class="a_next" type="submit" name="submit" value="verzenden"></td>
    	</tr>
      </table>
    </form>

  </body>
</html>