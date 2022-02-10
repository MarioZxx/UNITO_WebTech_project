<?php 
//get single offer, my offer, search offer

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

//display the offer on the offer page
function printShowOfferToJSON() {
  try{
    $db = dbconnect();
    $offerId = $db->quote($_POST["id"]);
    $rows = $db->query("SELECT title, time, description, price, image, users.email
                    FROM offers JOIN users ON offers.user_id = users.id
                    WHERE offers.id = $offerId");
    if ($rows == null or $rows->rowCount() == 0) {print "  \"offerNA\": true, \n";}
    else{
      $email = $db->quote($_SESSION["name"]);
      $user_id =  $db -> query("SELECT id, role_id FROM users WHERE email = $email");
      $user_id = $user_id->fetch(PDO::FETCH_ASSOC);
      $role_id = $user_id['role_id'];
      $user_id = $db->quote($user_id['id']);

      $cartCheck = $db->query("SELECT id FROM carts
                        WHERE offer_id = $offerId AND user_id = $user_id");
    }
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


//display the list of offers on the page in the home page
function printOffersToJSON() {
  $search = $_POST["search"];
  $category = $_POST["category"];
  try{
      $db = dbconnect();    
      $search = $db->quote("%".$search."%");
      if($category == "all") $category = $db->quote("%%");
      else $category = $db->quote("%".$category."%");
      $rows = $db->query("SELECT id, title, time, description, price, image
                      FROM offers
                      WHERE category LIKE $category AND ( title LIKE $search OR description LIKE $search )
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


//display the list of offers published by current user on the page in the MyOffer page
function printMyOffersToJSON() {
  try{
    $db = dbconnect();    
    $email = $db->quote($_SESSION["name"]);
    $rows = $db->query("SELECT offers.id, title, time, description, price, image
                    FROM offers JOIN users ON offers.user_id = users.id
                    WHERE users.email = $email
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