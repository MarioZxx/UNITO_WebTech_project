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


function publish() {
    $title = $_POST["title"];
    $time = date("d/M/Y");
    $category = $_POST["category"];
    $desc = $_POST["desc"];
    $price = $_POST["price"];
    $image = $_POST["image"];
    $image = "../img/offers/".$image.".png";
       
    $db = dbconnect();
    try{
      $email = $_SESSION["name"];
      $user_id =  $db->query("SELECT id FROM users WHERE email = '$email'");
      $user_id = $user_id->fetch(PDO::FETCH_ASSOC);
      $user_id = $user_id['id'];
      $db->query("INSERT INTO `offers`(`title`, `time`, `category`, `description`, `price`, `image`, `user_id`) 
                  VALUES ('$title','$time','$category','$desc','$price','$image','$user_id')");
    } catch(PDOException $ex) {      
      die('Database error: ' . $ex->getMessage());
    }
    $msg = "Offer published with success";
    print "  \"msg\": \"".$msg."\"";    
}

?>