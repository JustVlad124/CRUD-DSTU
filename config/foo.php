<?php

    include "connect.php";

    // Функция вывода результат запроса на выбрку
    function tt($value)
    {
        echo "<pre>";
        print_r($value);
        echo "<pre>";
    }

    // Проверка выполнения запроса к БД
    function dbCheckError($query)
    {
        $errorInfo = $query->errorInfo();
        if ($errorInfo[0] !== PDO::ERR_NONE)
        {
            echo $errorInfo[2];
            exit();
        }
        return true;
    }

    // Запрос на выборку всех записей из выбранной таблицы
    function selectAll($table, $params = [])
    {
        global $pdo;
        $sql = "SELECT * FROM $table";
        $i = 0;
        foreach ($params as $key => $value)
        {
            if (empty($value))
            {
                continue;
            }
            else
            {
                if (!is_numeric($value))
                {
                    $value = "'" . $value . "'";
                }
                if ($i === 0)
                {
                    $sql = $sql . " WHERE $key = $value";
                }
                else
                {
                    $sql = $sql . " AND $key = $value";
                }
            }
            $i++;
        }

        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

    // Запрос на выборку одной записи из выбранной таблицы
    function selectOne($table, $params = [])
    {
        global $pdo;
        $sql = "SELECT * FROM $table";
        $i = 0;
        foreach ($params as $key => $value)
        {
            if (empty($value))
            {
                continue;
            }
            else
            {
                if (!is_numeric($value))
                {
                    $value = "'" . $value . "'";
                }
                if ($i === 0)
                {
                    $sql = $sql . " WHERE $key = $value";
                }
                else
                {
                    $sql = $sql . " AND $key = $value";
                }
            }
            $i++;
        }

        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetch();
    }

    // Запрос на добавление записи в БД
    function insert($table, $params)
    {
        global $pdo;
        $i = 0;
        $col = "";
        $mask = "";
        foreach ($params as $key => $value)
        {
            if (empty($value))
            {
                if ($i === 0)
                {
                    $col = $col . $key;
                    $mask = $mask . "NULL";
                }
                else
                {
                    $col = $col . ", " . $key;
                    $mask = $mask . ", NULL";
                }
            }
            else
            {
                if ($i === 0)
                {
                    $col = $col . $key;
                    $mask = $mask . "'" . $value . "'";
                }
                else
                {
                    $col = $col . ", " . $key;
                    $mask = $mask . ", '" . $value . "'";
                }
            }
            $i++;
        }
        
        $sql = "INSERT INTO $table ($col) VALUES ($mask)";

        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
    }

    // Запрос на редактирование записи в выбранной таблице
    function update($table, $id, $params)
    {
        global $pdo;
        $i = 0;
        $str = "";
        foreach ($params as $key => $value)
        {
            if (empty($value))
            {
                if ($i === 0)
                {
                    $str = $str . $key . " = NULL";
                }
                else
                {
                    $str = $str . ", " . $key . " = NULL";
                }
            }
            else 
            {
                if ($i === 0)
                {
                    $str = $str . $key . " = '" . $value . "'";
                }
                else
                {
                    $str = $str . ", " . $key . " = '" . $value . "'";
                }
            }
            $i++;
        }

        $sql = "UPDATE $table SET $str WHERE id = $id";

        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
    }

    // Запрос на удаление записи из выбранной таблицы
    function delete($table, $id)
    {
        global $pdo;
        $sql = "DELETE FROM $table WHERE id = $id";

        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
    }

    // Запрос на выборку таблицы из базы данных 
    function showTable($tableName)
    {
        global $pdo;
        $sql = "SHOW TABLES LIKE '$tableName'";

        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetch();
    }

    // Запрос на выборку атрибутов указанной таблицы
    function showTableAttributes($table)
    {
        global $pdo;
        $sql = "SHOW COLUMNS FROM $table";

        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        $attributesArray = $query->fetchAll();
        $attributes = [];
        foreach($attributesArray as $atrTitle)
        {
            if ($atrTitle[0] === 'id') continue;
            array_push($attributes, $atrTitle[0]);
        }
        return $attributes;
    }

    function queryBooks($attrVal, $oper, $orderAttr=NULL, $orderMode='ASC')
    {
        global $pdo;
        $sql = "SELECT * FROM books";

        $i = 1;
        foreach ($attrVal as $key => $value)
        {
            if (empty($value) && ($oper[$key] !== 'IS NULL' && $oper[$key] !== 'IS NOT NULL'))
            {
                continue;
            }
            else
            {
                // if (!is_numeric($value))
                // {
                //     $value = "'" . $value . "'";
                // }
                if ($i === 1)
                {
                    if ($oper[$key] == 'IN' || $oper[$key] == 'NOT IN'){
                        $sql = $sql . " WHERE $key $oper[$key]($value)";
                        $i = 0;
                        continue;
                    }
                    elseif ($oper[$key] == 'BETWEEN' || $oper[$key] == 'NOT BETWEEN'){
                        $sql = $sql . " WHERE $key $oper[$key] $value";
                        $i = 0;
                        continue;
                    }
                    elseif ($oper[$key] == 'IS NULL' || $oper[$key] == 'IS NOT NULL'){
                        $sql = $sql . " WHERE $key $oper[$key]";
                        $i = 0;
                        continue;
                    }
                    elseif ($oper[$key] == 'LIKE' || $oper[$key] == 'NOT LIKE'){
                        $sql = $sql . " WHERE $key $oper[$key] '$value'";
                        $i = 0;
                        continue;
                    }
                    $sql = $sql . " WHERE $key $oper[$key] '$value'";
                    $i = 0;
                }
                else
                {
                    if ($oper[$key] == 'IN' || $oper[$key] == 'NOT IN'){
                        $sql = $sql . " AND $key $oper[$key]($value)";
                        continue;
                    }
                    elseif ($oper[$key] == 'BETWEEN' || $oper[$key] == 'NOT BETWEEN'){
                        $sql = $sql . " AND $key $oper[$key] $value";
                        continue;
                    }
                    elseif ($oper[$key] == 'IS NULL' || $oper[$key] == 'IS NOT NULL'){
                        $sql = $sql . " AND $key $oper[$key]";
                        continue;
                    }
                    elseif ($oper[$key] == 'LIKE' || $oper[$key] == 'NOT LIKE'){
                        $sql = $sql . " AND $key $oper[$key] '$value'";
                        continue;
                    }
                    $sql = $sql . " AND $key $oper[$key] '$value'";
                }
            }
        }
        if (!empty($orderAttr))
        {
            $sql = $sql . " ORDER BY $orderAttr $orderMode";
        }

        $query = $pdo->prepare($sql);
        $query->execute();
        dbCheckError($query);
        return $query->fetchAll();
    }

?>
