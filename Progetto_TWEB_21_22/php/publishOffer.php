<?php 

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
  header("HTTP/1.1 400 Invalid Request");
  die("ERROR 400: Invalid request - This service accepts only POST requests.");
}

header("Content-type: application/json");
print "{\n";

include("utils.php");
// check if i'm logged
if (isLogged()){
    publish();
} 
print "\n}\n";


//publish a new offer
function publish() {
  
  try{
      $db = dbconnect();
      $title = $db->quote($_POST["title"]);
      $time = $db->quote(date("d/M/Y"));
      $category = $db->quote($_POST["category"]);
      $desc = $db->quote($_POST["desc"]);
      $price = $db->quote($_POST["price"]);
      $image = $_POST["image"];
      $image = $db->quote("../img/offers/".$image.".png");

      $email = $db->quote($_SESSION["name"]);
      $user_id =  $db->query("SELECT id FROM users WHERE email = $email");
      $user_id = $user_id->fetch(PDO::FETCH_ASSOC);
      $user_id = $db->quote($user_id['id']);

      $db->query("INSERT INTO `offers`(`title`, `time`, `category`, `description`, `price`, `image`, `user_id`) 
                  VALUES ($title, $time, $category, $desc, $price, $image, $user_id)");
    } catch(PDOException $ex) {      
      die('Database error: ' . $ex->getMessage());
    }
    $msg = "Offer published with success";
    print "  \"msg\": \"".$msg."\"";    
}

?>