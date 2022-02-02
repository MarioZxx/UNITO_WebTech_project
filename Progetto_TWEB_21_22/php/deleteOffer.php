<?php 

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
  header("HTTP/1.1 400 Invalid Request");
  die("ERROR 400: Invalid request - This service accepts only POST requests.");
}


include("utils.php");
// check if i'm logged
if (isLogged()){
  deleteOffer();
}
    
function deleteOffer() {
  $offerId = $_POST["id"];

  $db = dbconnect();    
  try{
    $db->query("DELETE FROM `offers` WHERE id = '$offerId'");
  } catch(PDOException $ex) {
    die('Database error: ' . $ex->getMessage());
  }
}    
    
?>