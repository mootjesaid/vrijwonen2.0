<!-- aanmaak datum: 09/06/2021, 11:14. author: Mohamad Dian Bah
Revision history
0.1            00/00/2030  Mohamad Dian  update ect...-->
  <?php
     include("./database/config.php");
	 include("./database/opendb.php");
	 if(!isset($_SESSION)){//SESSION start al die niet gestart is
	   session_start();
	 }
	 if(isset($_SESSION["login"]) && $_SESSION["login"]== "true"){//chek if loged in than go auto.. to overvieuw.php
		header("location:overview.php");
	 }
	 
	 if (isset($_POST["user_name"]) && (!empty($_POST["user_name"]))) {
	   $user_name = $_POST["user_name"];
	 }else{
	   echo "<center>-gebruikersnaam is niet ingevuld<br>";
	   echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	   exit;
	 }
	 if (isset($_POST["password"]) && (!empty($_POST["password"]))) {
		$password = $_POST["password"];
	  }else{
		echo "<center>-Wachtwoord is niet ingevuld<br>";
		echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
		exit;
	  }
	 //-------patern---user_name------
	 $pattern = "/[<\/>(){}-]/";
	 $user_name = preg_replace($pattern, "", substr(trim($user_name), 0, 40));
	 if ($user_name !== $_POST["user_name"]) {
	   if ($user_name == "") {
		 echo "<center>-Uw gebruikersnaam bevat ongedige tekens<br> of is niet ingevoeld.<br>";
		 echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	     exit;
	   }else{
		echo "<center>-U heeft ongeldige letters of tekens opgegeven bij uw user_name. <br> Of Eindigt met een spatie of enter.<br>";
		echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
		exit;
	   }			  
	    exit;
	 }
	 //-------patern---password------
	 $pattern = "/[<\/>(){}-]/";
	 $password = preg_replace($pattern, "", substr(trim($password), 0, 4000));
 
	 if ($password !== $_POST["password"]) {
	   if ($password == "") {
		 echo "<center>-Uw password is niet ingevuld <br><br>
		   <a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	   }else{
		 echo "<center>-Uw wachtword bevat ongeldige tekens. <br><br>
		   <a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
	   }
	   exit;
	 }

	 $query= "SELECT user_id, user_name FROM users WHERE user_name = ? AND password = ?";
   
	 $preparedQuery=$dbaselink->prepare($query);
	 $preparedQuery->bind_param("ss", $user_name, $password);
	 $preparedQuery->execute();

	 if($preparedQuery->errno){
	   echo "query is not working ";
	 }else{
	   $result=$preparedQuery->get_result();
	   if($result->num_rows===0){
	   //   echo "there is not any result found";
	   echo "<center>Uw gebruikersnaam en wachtwoord komen niet overeens<br>";
	   echo "<a href=\"javascript:%20history.go(-1)\">Terug naar Invoerscherm</a></center>";
		exit;
	   exit;
	   }
	 }
	 $preparedQuery->close();
	 while($row=$result->fetch_assoc ()){
	   $user_id= $row["user_id"];
	   $user_name= $row["user_name"];
	 }
	 $_SESSION["user_id"] = $user_id;
	 $_SESSION["user_name"] = $user_name;
	 
	 if(isset($_SESSION["user_id"]) && ($_SESSION["user_name"])){
	   $_SESSION["login"] = "true";//login is true
	   include("./database/closedb.php");	   
	   echo '<meta http-equiv="refresh" content="0;URL=\'overview.php\'">';
	   exit;
	 }
?>