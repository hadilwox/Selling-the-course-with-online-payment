<?php


try {
     $db = new PDO("mysql:host=localhost;dbname=link-php;charset=utf8", "root", "");
    // $result = $db->query("SELECT * FROM userlinks");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

