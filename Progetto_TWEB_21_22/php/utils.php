<?php
//common functions

    if(!isset($_SESSION)) {session_start();}
    
    //check if there is a logged user
    function isLogged() {
        if (!isset($_SESSION["name"])) {
            if (!isset($_SESSION["msg"])) {
                $_SESSION["msg"] = "Please, login if you want to use this website.";
            }
            return false;
        }
        else {
            return true;
        }
    }

    //connect to the database
    function dbconnect() {
        $db = new PDO('mysql:dbname=detra;host=localhost:3306', "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
      }
    
?>