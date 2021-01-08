<?php
session_start();
 
// Kijken of de gebruiker is ingelogd. Als hij ingelogd is dan gaat hij naar de landing page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: landingPage.php");
    exit;
}
 
// config file erbij doen
require_once "PHP/config.php";
 
// Lege variabelen van het formulier benomemen
$username = $password = "";
$username_err = $password_err = "";
 
// Pas het formulier bekijken als er op submit wordt geklikt.
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Kijken of username een waarde heeft
    if(empty(trim($_POST["username"]))){
        $username_err = "Vul uw gebruikersnaam in.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Kijken of er wat bij password is ingevuld
    if(empty(trim($_POST["password"]))){
        $password_err = "Vul uw wachtwoord in.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Kijken of de gebruikersnaam en wachtwoord geen error geven
    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($mySqli, $sql)){
            // Variabele aan een parameter binden
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // parameter benoemen
            $param_username = $username;
            
            // Uitvoeren van statement
            if(mysqli_stmt_execute($stmt)){
                // Als dit lukt. Sla dan resultaat op
                mysqli_stmt_store_result($stmt);
                
                // Kijken of de gebruikersnaam bestaat. Als dit het geval is, check dan of het wachtwoord klopt
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // variabel van resultaat binden
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Als het wachtwoord overeenkomt, begin dan een nieuwe sessie.
                            session_start();
                            
                            // Data opslaan in SESSION variabele. Deze kunnen later weer teruggehaald worden.
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Gebruiker doorsturen naar de landing page
                            header("location: landingPage.php");
                        } else{
                            // Mocht het wachtwoord niet kloppen, geef dan deze error aan.
                            $password_err = "Het wachtwoord dat u hebt ingevuld is niet geldig.";
                        }
                    }
                } else{
                    // Geef deze error melding als de gebruikersnaam niet bestaat.
                    $username_err = "Geen account gevonden met deze username.";
                }
            } else{
                echo "Oeps! Er is iets mis gegaan. Probeer het later nog eens";
            }

            // Sluiten van statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Afbreken van connectie
    mysqli_close($mySqli);
}
?>