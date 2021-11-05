<?php //TODO personality type controll
include "top.html"; 
$name = $_GET["name"] ?? "name";
?>

<h1>Matches for <?= $name ?> </h1>

<?php 
$singles = file("./singles.txt", FILE_IGNORE_NEW_LINES);

$requirements = array(0,1,2,"default",4,5,6);
foreach($singles as $line) {  //find the name in singles.txt
  $position = strpos($line, $name);
  if( $position !== false ){
    $requirements = explode(",", $line);
    break;
  }
}

foreach($singles as $line) {  //search all ideal partners
  $line = explode(",", $line);

  if($requirements[0] == $line[0])  //name
    continue;

  if(isset($requirements[7])){  //gender
    if($requirements[7] != "both" && $requirements[7] != $line[1]){
      continue;
    }
  } else {
    if($requirements[1] === $line[1])
      continue;
  }

  if($requirements[5] > $line[2] || $requirements[6] < $line[2])  //age
    continue;

  for($i = 0; $i < 4; $i++){
    if($requirements[3][$i] == $line[3][$i]){  //Type
      break;
    }
  }
  if($i == 4) continue;

  if($requirements[4] != $line[4])  //OS
    continue;
?>

<div class="match">
  <img src="https://courses.cs.washington.edu/courses/cse190m/12sp/homework/4/user.jpg" alt="user">
  <p><?=$line[0]?></p>
  <ul>

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