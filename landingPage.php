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
    <link rel="stylesheet" href="styles/style.css">
    
</head>
<body id="landingPage">
  <header>
   <nav>
       <ul>
           <li><h1><a href="#"><?= $_SESSION["username"]; ?></a> </h1></li>
           <li><a href="#">Upload +</a></li>
           <li><a href="logout.php">Uitloggen</a></li>
       </ul>
    </nav>
   <form action="upload.php" method="post" enctype="multipart/form-data">
       <label>Select Image File to Upload:</label>
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
</form>
    </header>

<main>
<h1>Welkom <a href="#"><?= $_SESSION["username"]; ?></a> </h1>
 <div class="Uploads">
<?php
// Include the database configuration file
include 'PHP/config.php';

// Get images from the database
$query = $mySqli->query("SELECT * FROM images ORDER BY uploaded_on DESC");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
        $user = $row["user"];
?>
 
   <figure>
    <img src="<?php echo $imageURL; ?>" alt="" />
       <figcaption>Geupload door: <span><?= " ".$user ?></span></figcaption>
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