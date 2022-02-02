<?php 

if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
  header("HTTP/1.1 400 Invalid Request");
  die("ERROR 400: Invalid request - This service accepts only POST requests.");
}
error_log("testing \n", 3 ,"../log/errors.log");
header("Content-type: application/json");
print "{\n";

include("utils.php");
// check if i'm logged
if (isLogged()){
  if(isset($_POST["getCart"])) printCartToJSON();
  if(isset($_POST["cartOp"]) && $_POST["cartOp"] == "add") setCart();
  if(isset($_POST["cartOp"]) && $_POST["cartOp"] == "delete") deleteCart();
}

print "\n}\n";


function printCartToJSON() {
  $email = $_SESSION["name"];
  $db = dbconnect();    
  try{
    $rows = $db->query("SELECT offers.id, title, time, description, price, image
                    FROM (carts JOIN users ON users.id = carts.user_id) JOIN offers ON carts.offer_id = offers.id
                    WHERE users.email = '$email'
                    ORDER BY offers.id;");
  } catch(PDOException $ex) {
    die('Database error: ' . $ex->getMessage());
  }

  if ($rows == null or $rows->rowCount() == 0) {
      $errMsg = "There is no offers founded";
      print "  \"errMsg\": \"".$errMsg."\"";
  } else {
          print "  \"offers\": ";
          // encode to json all the rows in our result set
          print json_encode($rows->fetchall());
  }
}

function setCart() {
  error_log("something\n", 3 ,"../log/errors.log");
    $offerId = $_POST["id"];
       
    $db = dbconnect();
    try{
      $email = $_SESSION["name"];
      $user_id =  $db -> query("SELECT id FROM users WHERE email = '$email'");
      $user_id = $user_id->fetch(PDO::FETCH_ASSOC);
      $user_id = $user_id['id'];

      $db->query("INSERT INTO `carts`(`user_id`, `offer_id`) 
                  VALUES ('$user_id','$offerId')");
    } catch(PDOException $ex) {      
      die('Database error: ' . $ex->getMessage());
    }
    $msg = "Offer added to cart with success";
    print "  \"msg\": \"".$msg."\"";    

}

function deleteCart() {
  $offerId = $_POST["id"];
       
    $db = dbconnect();
    try{
      $email = $_SESSION["name"];
      $user_id =  $db -> query("SELECT id FROM users WHERE email = '$email'");
      $user_id = $user_id->fetch(PDO::FETCH_ASSOC);
      $user_id = $user_id['id'];

      $db->query("DELETE FROM `carts` WHERE offer_id = '$offerId' AND user_id = '$user_id'");
    } catch(PDOException $ex) {      
      die('Database error: ' . $ex->getMessage());
    }
    $msg = "Offer deleted from cart with success";
    print "  \"msg\": \"".$msg."\"";    
}


?>