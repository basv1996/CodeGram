<?php

$query = $mySqli->query("UPDATE images SET vote_count = vote_count + 1 WHERE user = '".$_SESSION['username']."'");

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
