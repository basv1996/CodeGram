<?php

include "login.php";

?>

<!--Gemaakt door Jody Lorist & Bas Vugts-->

<!DOCTYPE html>
<html id="loginHTML" lang="en">
<head>
    <meta charset="UTF-8">
    <title>phpgram</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body id="loginPage">
    
    
    <main>
      
      <h1>codegram</h1>
       
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
            <input type="text" placeholder="username" name="username">
            <span><?= $username_err ?></span>
            
            <input type="password" placeholder="password" name="password">
            <span><?= $password_err ?></span>
            
            <input type="submit" value="Log In">
            
        </form>
        
        
        
        
        <a href="register.php">Heb je nog geen account? <b>Sign up.</b></a>
        
    </main>
    
    
</body>
</html>