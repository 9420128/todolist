<?php

function connect(string $query): array|PDOStatement
{
    try {

        $pdo = new PDO("mysql:host=localhost;dbname=strugigkru_todo;charset=utf8", 'strugigkru_todo', 'xX123456');

        $pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

        return $pdo->query($query);

    }
    catch (PDOException $i){

        return ['message' => 'Ошибка подключения к базе данных', 'type' => 'error'];

    }

}