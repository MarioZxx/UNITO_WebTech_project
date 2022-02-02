<?php
//common functions

    if(!isset($_SESSION)) {session_start();}
    
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

    function dbconnect() {
        $db = new PDO('mysql:dbname=detra;host=localhost:3306', "root", "");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
      }
    
    // check if credentials are correct
    function pwdVerify($username, $pwd) {
        try {
            $db = dbconnect();
            $rows = $db->query("SELECT password FROM users WHERE email = '$username'");
        } catch (PDOException $ex) {
            die('Database error: ' . $ex->getMessage());
        }
        if ($rows) { // controlla la corrispondenza utente / password
            foreach ($rows as $row) {
                $password = $row["password"];
                return $pwd === $password;
            }
        } else {
        return false; // user not found
        }
    }
?>