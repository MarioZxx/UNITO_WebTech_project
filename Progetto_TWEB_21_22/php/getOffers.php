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
    if(isset($_POST["id"])){
      printShowOfferToJSON();
    } else { if(isset($_POST["myOffers"])){
            printMyOffersToJSON();
            }else {printOffersToJSON();}
    }
}

print "\n}\n";


function printShowOfferToJSON() {
  $offerId = $_POST["id"];
  $db = dbconnect();
  try{
    $rows = $db->query("SELECT title, time, description, price, image, users.email
                    FROM offers JOIN users ON offers.user_id = users.id
                    WHERE offers.id = '$offerId'");

    $email = $_SESSION["name"];
    $user_id =  $db -> query("SELECT id, role_id FROM users WHERE email = '$email'");
    $user_id = $user_id->fetch(PDO::FETCH_ASSOC);
    $role_id = $user_id['role_id'];
    $user_id = $user_id['id'];

    $cartCheck = $db->query("SELECT id FROM carts
                        WHERE offer_id = '$offerId' AND user_id = '$user_id'");
  } catch(PDOException $ex) {
    die('Database error: ' . $ex->getMessage());
  }

  if ($role_id == 0) {
    print "  \"admin\": true, \n";
  }

  if ($cartCheck == null or $cartCheck->rowCount() == 0) {
    print "  \"cartCheck\": false, \n";
  } else {
    print "  \"cartCheck\": true, \n";
  }

  print "  \"offers\": ";
  print json_encode($rows->fetchall());

}


function printOffersToJSON() {
    $search = $_POST["search"];
    $category = $_POST["category"];
    if($category == "all") $category = "";
   
    $db = dbconnect();    
    try{
      $rows = $db->query("SELECT id, title, time, description, price, image
                      FROM offers
                      WHERE category LIKE '%$category%' AND ( title LIKE '%$search%' OR description LIKE '%$search%' )
                      ORDER BY id;");
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


function printMyOffersToJSON() {
  $email = $_SESSION["name"];
  $db = dbconnect();    
  try{
    $rows = $db->query("SELECT offers.id, title, time, description, price, image
                    FROM offers JOIN users ON offers.user_id = users.id
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

?>