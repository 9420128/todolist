<?php

//require_once 'DbConnect.php';

class DbHelpers
{

    protected $pdo = null;

    public function connect(){

        try {

            $this->pdo = new PDO("mysql:host=localhost;dbname=strugigkru_todo;charset=utf8", 'strugigkru_todo', 'xX123456');

        }
        catch (PDOException $i){

            return ['message' => 'Ошибка подключения к базе данных', 'type' => 'error'];

        }
    }

    public function get($table = 'todo_list', $set = []): bool|array
    {

        $limit = !empty($set['limit']) ? 'LIMIT ' . $set['limit'] : '';

        $sql = "SELECT * FROM $table $limit";

        $this->connect();

        $this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

        $connect = $this->pdo->query($sql);

        if(!empty($connect)){

            $res = [];

            while($row = $connect->fetch()){
                $res[] = $row;
            }


            $this->pdo = $connect = null;

            return ['data' => $res];

        }

        return false;

    }

    public function add(string $table, array $post): array
    {

        [$key, $value] = $this->_postToStringAdd($post);

        $sql = "INSERT INTO $table ($key) VALUES ($value)";

        $this->connect();

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $count = $this->pdo->exec($sql);

        if($count > 0){

            return [...$this->get(), 'message' => 'Данные добавлены в список', 'type' => 'success'];

        }

        return ['message' => 'Ошибка добавления данных', 'type' => 'error'];

    }

    public function edit(string $table, array $data): array
    {

        $execStr = $this->_postToStringSet($data[0]);

        $this->connect();

        $sql = "UPDATE $table SET $execStr WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        foreach ($data[0] as $key => $item){

            $stmt->bindValue(":$key", $item);

        }

        if($stmt->execute()){

            return [...$this->get(), 'message' => 'Данные обновлены', 'type' => 'success'];

        }

        return ['message' => 'Ошибка обновления данных', 'type' => 'error'];

    }

    public function delete(string $table, array $data): array
    {

        $this->connect();

        $idStr = implode(', ', $data);

//        return [$data];

        $sql = "DELETE FROM $table WHERE id in ($idStr)";

        $count = $this->pdo->exec($sql);

        if($count > 0){

            return [...$this->get(), 'message' => 'Данные удалены', 'type' => 'success'];

        }

        return ['message' => 'Ошибка удаления данных', 'type' => 'error'];

    }

    /* helpers function */

    protected function _postToStringAdd(array $post): array
    {

        $key = $value = '';

        foreach ($post as $k => $item) {

            if(!empty($item)) {

                $key .= $k . ', ';
                $value .= "'" . $item . "', ";

            }

        }

        $key = substr($key,0,-2);
        $value = substr($value,0,-2);

        return [$key, $value];
    }

    protected function _postToStringSet(array $data): string
    {

        $execStr = '';

        foreach ($data as $key => $item) {

            if($key !== 'id') {

                $execStr .= $key . '= :' . $key . ', ';

            }

        }

        /* $execStr return id = :id, statuses = :statuses, name = :name */

        return substr($execStr,0,-2);

    }

}