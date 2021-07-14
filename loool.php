<?php
// Include the database configuration file
include 'dbConfig.php';

// Get images from the database
$query = $db->query("SELECT * FROM images ORDER BY image_id DESC");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'images/'.$row["file_name"];
        ?>
        <img src="<?php echo $imageURL; ?>" alt="" />
    <?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>