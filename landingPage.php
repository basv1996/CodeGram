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
 <?php
include 'header.php';
?>

<main>
<h1>Welkom <?= $_SESSION["username"]; ?> </h1>
<h3>HomeFeed:</h3>
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
        $votes = $row["vote_count"];
?>
 
   <figure>
    <img src="<?php echo $imageURL; ?>" alt="" />
       <figcaption>Geupload door: <span><?= " ".$user ?></span></figcaption>
       <p>Votes: <?php echo $votes; ?></p>
       <p><a href="#">UpVote</a></p>
       <p><a href="#">DownVote</a></p>
    </figure>
  
    
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php } 
      

     ?>


  </div>
    </main>
    <script src="script/script.js"></script>
</body>
</html>