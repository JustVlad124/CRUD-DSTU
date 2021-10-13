<?php

    include "../config/connect.php";
    include "../config/foo.php";

    $table = $_GET['table'];
    $id = $_GET['id'];

    $keys = showTableAttributes($table);

    // Создаем пустой массив, в который будем записывать добавляемые данные
    $params = [];
    // из глобалоной переменной $_POST, которая содержит данные создаваемой записи,
    // с помощью цикла foreach, добавляем данные в массив $params
    foreach ($_POST as $value)
    {
        array_push($params, $value);
    }

    $params = array_combine($keys, $params);

    update($table, $id, $params);    

    header("Location: ../" . $table . ".php");
?>