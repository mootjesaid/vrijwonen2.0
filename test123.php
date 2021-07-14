<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title></title>
</head>
<body>
<form action="" method="post">
    Search: <input type="text" name="term" /><br />
    <input type="submit" value="Submit" />
</form>
<?php
if (!empty($_REQUEST['term'])) {

    $term = ($_REQUEST['term']);

    $sql = "SELECT * FROM places WHERE place LIKE '%".$term."%'";

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



}
?>
</body>
</html>