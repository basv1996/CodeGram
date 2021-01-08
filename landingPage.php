<?php

//session_start();
include 'upload.php';

$username = $_SESSION["username"];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <h1>Welkom <a href="#"><?= $_SESSION["username"]; ?></a> </h1>
   
   <a href="logout.php">Uitloggen</a>
   
   <form action="upload.php" method="post" enctype="multipart/form-data">
    Select Image File to Upload:
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>

<?php
// Include the database configuration file
include 'PHP/config.php';

// Get images from the database
$query = $mySqli->query("SELECT * FROM images ORDER BY uploaded_on DESC");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
?>
    <img src="<?php echo $imageURL; ?>" alt="" />
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>



    
</body>
</html>