<?php

class DbHelpers
{

    protected $pdo = null;

    protected string $dsn;
    protected string $username;
    protected string $password;

    /**
     * Конструктор класса DbHelpers.
     * @param string $dsn - строка подключения к базе данных.
     * @param string $username - имя пользователя базы данных.
     * @param string $password - пароль пользователя базы данных.
     */
    public function __construct(string $dsn, string $username, string $password)
    {

        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;

    }

    /**
     * Устанавливает соединение с базой данных.
     * @return array|null - возвращает массив с информацией об ошибке или null в случае успешного подключения.
     */
    public function connect()
    {

        try {

            $this->pdo = new PDO($this->dsn, $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

        }
        catch (PDOException $i){

            return ['message' => 'Ошибка подключения к базе данных', 'type' => 'error'];

        }

    }

    /**
     * Извлекает данные из указанной таблицы.
     * @param string $table - имя таблицы.
     * @param array $set - дополнительные параметры, например, 'limit' для ограничения количества записей.
     * @return bool|array - возвращает ассоциативный массив с данными, либо false в случае ошибки.
     */
    public function get(string $table = 'todo_list', array $set = []): bool|array
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

    /**
     * add - Добавляет новую запись в указанную таблицу.
     * edit - Изменяет запись.
     * delete - Удаляет запись.
     * @param string $table - имя таблицы.
     * @param array $post - ассоциативный массив с данными для добавления.
     * @return array - возвращает массив с результатом операции.
     */
    public function add(string $table, array $post): array
    {

        [$key, $value] = $this->_convertPostToSQLStrings($post);

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

        $execStr = $this->_postToSqlUpdateString($data[0]);

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

        $sql = "DELETE FROM $table WHERE id in ($idStr)";

        $count = $this->pdo->exec($sql);

        if($count > 0){

            return [...$this->get(), 'message' => 'Данные удалены', 'type' => 'success'];

        }

        return ['message' => 'Ошибка удаления данных', 'type' => 'error'];

    }

    /**
     * helpers functions
     *
     * Преобразует данные из ассоциативного массива в строки для использования в SQL-запросах.
     *
     * @param array $post - ассоциативный массив с данными.
     *
     * @return array - возвращает массив с ключами 'keys' и 'values'.
     */
    protected function _convertPostToSQLStrings(array $post): array
    {
        $keys = $values = '';

        foreach ($post as $key => $value) {

            if (!empty($value)) {
                $keys .= $key . ', ';
                $values .= "'" . $this->_escapeString($value) . "', ";
            }

        }

        $keys = rtrim($keys, ', ');
        $values = rtrim($values, ', ');

        return ['keys' => $keys, 'values' => $values];
    }

    protected function _escapeString(string $input): string|int
    {
        // Здесь можно экранировать специальные символы
        // Для обеспечения безопасности и избежания SQL-инъекций

        return $input;

    }

    protected function _postToSqlUpdateString(array $data): string
    {
        $setClauses = [];

        foreach ($data as $key => $value) {
            if ($key !== 'id') {
                $setClauses[] = $key . ' = :' . $key;
            }
        }

        return implode(', ', $setClauses);
    }

}