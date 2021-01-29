<?php
// Include the database configuration file
include 'PHP/config.php';
session_start();
$statusMsg = '';

// File upload path
$targetDir = "uploads/";


$userName = $_SESSION["username"];

if($_SERVER["REQUEST_METHOD"] == "POST") {

if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $insert = $mySqli->query("INSERT INTO images (file_name, uploaded_on, user) VALUES ('".$fileName."', NOW(), '".$userName."')");
            //$insert = $mySqli->query("INSERT INTO images (file_name, uploaded_on, user) VALUES ('".$fileName."', NOW(), 'username')");
             
            if($insert){
                $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                header("location: landingPage.php");
            }else{
                $statusMsg = "File upload failed, please try again.";
            } 
        }else{
            $statusMsg = "Sorry, there was an error uploading your file.";
        }
    }else{
        $statusMsg = 'Sorry, only JPG, JPEG, PNG files are allowed to upload.';
    }
}else{
    $statusMsg = 'Please select a file to upload.';
}
} else {
    $statusMsg = '';
}

// Display status message
?>