<?php 
   # main program
   if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
       header("HTTP/1.1 400 Invalid Request");
       die("ERROR 400: Invalid request - This service accepts only POST requests.");
    }
    
    include("utils.php");

    

    // check the credentials
    if (isset($_POST["username"]) && isset($_POST["pwd"])) {
        $username = $_POST["username"];
        $pwd = $_POST["pwd"];
        if (pwdVerify($username, $pwd) == true) {
            if (isset($_SESSION)) {
                session_regenerate_id(TRUE);  //replace the current session, and keep current info
            }
            $_SESSION["name"] = $username;
        } else {
            $_SESSION["msg"] = "invalid username or password";
        }
    }

    // return to caller if is logged
    header("Content-type: application/json");
    print "{\n";
    if(isLogged()){
        print " \"isLogged\": true, \n";
        print "  \"name\": \"".$_SESSION["name"]."\"";
    } else {
        print " \"isLogged\": false \n";
    }
    print "\n}";
    
?>