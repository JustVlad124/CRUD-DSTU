<?php
    include "../config/connect.php";
    include "../config/foo.php";

    $table = $_GET['table'];
    $id = $_GET['id'];

    delete($table, $id);
    
    header("Location: ../" . $table . ".php");
?>