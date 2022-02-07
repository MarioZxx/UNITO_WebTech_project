<?php 

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
  header("HTTP/1.1 400 Invalid Request");
  die("ERROR 400: Invalid request - This service accepts only POST requests.");
}

header("Content-type: application/json");
print "{\n";

include("utils.php");
addUser();
print "\n}\n";


function addUser() {       
    try{
      $db = dbconnect();
      $username = $db->quote($_POST["username"]);
      $pwd = md5($_POST["pwd"]);
      $pwd = $db->quote($pwd);
      $db->query("INSERT INTO `users`(`email`, `password`, `role_id`) 
                  VALUES ($username, $pwd, '1')");
      $msg = "Success! Back to login in 5 secs";
      print "  \"msg\": \"".$msg."\"";
    } catch(PDOException $ex) {      
      $msg = "User already exists";
      print "  \"msg\": \"".$msg."\"";
    }
    
}

?>