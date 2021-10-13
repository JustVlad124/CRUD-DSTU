<?php
    $host = 'localhost';
    $user = 'root';
    $pass = 'Pony124Swim';
    $db = 'test';

    try {
        $pdo = new PDO("mysql:host=$host; dbname=$db", $user, $pass);
    }
    catch (PDOException $error)
    {
        die("Could not connect to database. Error: " . $error->getMessage());
    }
?>