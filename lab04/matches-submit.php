<?php 
include "top.html"; 
$name = $_GET["name"] ?? "error";
?>

<h1>Matches for <?= $name ?> </h1>

<?php 
$singles = file("./singles.txt", FILE_IGNORE_NEW_LINES);

$requirements = array(1,2,3,4,5,6,7);
foreach($singles as $line) {  //find the name in singles.txt
  $position = strpos($line, $name);
  if( $position !== false ){
    $requirements = explode(",", $line);
    break;
  }
}

foreach($singles as $line) {  //search all ideal users
  $line = explode(",", $line);



  if($line[2] < $requirements[5] || $line[2] > $requirements[6])  //age
    continue;
  
  //echo(sizeof($line[3]));

  if($line[4] != $requirements[4])  //OS
    continue;
?>

<div class="match">
  <img src="https://courses.cs.washington.edu/courses/cse190m/12sp/homework/4/user.jpg" alt="user">
  <p><?=$line[0]?></p>
  <ul id="links">

    <li><strong>gender:</strong>  <?=$line[1]?></li>
    <li><strong>age:</strong>  <?=$line[2]?></li>
    <li><strong>type:</strong>  <?=$line[3]?></li>
    <li><strong>OS:</strong>  <?=$line[4]?></li>
    
  </ul>
</div>

<?php
}
?>

<?php include "bottom.html"; ?>