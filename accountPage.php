<?php
//session_start();
include 'upload.php';
$username = $_SESSION["username"];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $_SESSION["username"]; ?> Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    
</head>
<body id="AccountPage">
 <?php
include 'header.php';
?>

<main>
<h1><?= $_SESSION["username"]; ?> </h1>
 <div class="Uploads">
<?php
// Include the database configuration file
include 'PHP/config.php';

// Get username from the database
$query = $mySqli->query("SELECT * FROM images WHERE user = '".$_SESSION['username']."' ");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
        $user = $row["user"];
        $uploadDate = $row["uploaded_on"];
?>
 
   <figure>
    <img src="<?php echo $imageURL; ?>" alt="" />
<!--
       <figcaption>Geupload door: <span><?= " ".$user ?></span></figcaption>
       <p> Uploaded on: <?php echo $uploadDate; ?> </p>
-->
    </figure>
  
    
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } ?>


  </div>
    </main>
    <script src="script/script.js"></script>
</body>
</html>