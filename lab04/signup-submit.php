<?php include "top.html"; 
file_put_contents("./singles.txt", implode(",", $_POST) . "\n", FILE_APPEND);
?>

<div>
  <strong>Thank you!</strong><br><br>
  Welcome to NerdLuv, <?=$_POST["name"]?><br><br>
  Now <a href="./matches.php">log in to see you matches!</a><br><br>
</div>

<?php include "bottom.html"; ?>