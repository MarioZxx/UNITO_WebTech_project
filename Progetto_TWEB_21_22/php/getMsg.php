<?php
  if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
    header("HTTP/1.1 400 Invalid Request");
    die("ERROR 400: Invalid request - This service accepts only GET requests.");
  }

  if(!isset($_SESSION)) {session_start();}

  header("Content-type: application/json");
  print "{\n";

  // return JSONObject
  if (isset($_SESSION["msg"])) {
    print "\"isSet\": true, \n";
    print "  \"msg\": \"".$_SESSION["msg"]."\" \n}\n";
    unset($_SESSION["msg"]);
  } else {
    print "\"isSet\": false \n}\n";
  }

?>