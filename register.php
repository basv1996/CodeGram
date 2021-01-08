<?php
// Include config file
require_once "PHP/config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Vul alstublieft een gebruikersnaam in.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($mySqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Deze gebruikersnaam wordt al gebruikt.";
                } else{
                    $username = $_POST["username"];
                }
            } else{
                echo "Er is iets mis gegaan. Probeer het later nog eens.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Vul alstublieft een wachtwoord in.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Wachtwoord moet tenminste 8 karakters hebben.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Bevestig astublieft uw wachtwoord.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Wachtwoord kwam niet overeen.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($mySqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["username"] = $username;
                
                
                header("location: index.php");
            } else{
                echo "Er is iets mis gegaan. Probeer het later nog eens.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($mySqli);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body id="registerPage">
  
  <h1>Codegram</h1>
  <blockquote>Wordt nu lid van de code familie!</blockquote>
   <form action="" method="post">
        
        
        <input type="text" name="username" placeholder="username">
        <span><?= $username_err ?></span>
        
        <input type="password" name="password" placeholder="password">
        <span><?= $password_err ?></span>
        
        <input type="password" name="confirm_password" placeholder="confirm password">
        <span><?= $confirm_password_err ?></span>
        
        <input type="submit" value="Registreren">
        
   </form>
   
   <a href="index.php">Heb je al een account? <b>Log in.</b></a>
    
</body>
</html>