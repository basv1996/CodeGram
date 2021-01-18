 <header>
   <nav>
       <ul>
          <li><a href="landingPage.php">Home</a></li>
           <li><h1><a href="accountPage.php"><?= $_SESSION["username"]; ?></a> </h1></li>
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