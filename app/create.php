<?php
    include "../config/connect.php";
    include "../config/foo.php";

    // Получаение имени таблицы, из которой был вызван запрос на создание новой записи
    $table = $_GET['table'];

    // Создаем массив, который содержит имена атрибутов таблицы
    // например, $keys('id', 'name', 'date_of_birth', 'date_of_death')
    $keys = showTableAttributes($table);

    // Создаем пустой массив, в который будем записывать добавляемые данные
    $params = [];
    // из глобалоной переменной $_POST, которая содержит данные создаваемой записи,
    // с помощью цикла foreach, добавляем данные в массив $params
    foreach ($_POST as $value)
    {
        array_push($params, $value);
    }

    /*
    Объединяем два массива $keys и $params. 
    Массив $keys будет определен как ключи будущего массива,
    а массив $params, как его значения.
    Делается это для того, чтобы запрос на добавление работал корректно
    */
    $params = array_combine($keys, $params);

    // Добавляем новые данные в таблицу с помощью запроса INSERT INTO...
    insert($table, $params);

    // Переход обратно на страницу, с которой был вызван запрос на создание новой записи
    header('Location: ../' . $table . '.php');
?>