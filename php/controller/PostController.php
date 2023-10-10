<?php

require_once '../helpers/DbHelpers.php';

// Проверяем, что запрос пришел методом POST и данные являются массивом

if($_SERVER["REQUEST_METHOD"] == "POST" && is_array($_POST)){

    $dbHelpers = new DbHelpers('mysql:host=localhost;dbname=strugigkru_todo;charset=utf8', 'strugigkru_todo', 'xX123456');

    // Очищаем каждый элемент массива $_POST от лишних пробелов

    foreach ($_POST as $i => $item) {

        $_POST[$i] = trim($item);

    }

    // Если массив $_POST пуст, пытаемся прочитать данные из тела запроса в формате JSON

    if(!count($_POST)) {

        $_POST = json_decode(file_get_contents('php://input'), true);

    }

    // Если в массиве $_POST есть ключ 'actions'

    if (!empty($_POST['actions'])) {

        $data = [];

        switch ($_POST['actions']) {

            case 'add':

                $table = 'todo_list';

                unset($_POST['actions']);

                if(!empty($_POST['table'])){

                    $table = $_POST['table'];

                    unset($_POST['table']);

                }

                if(!empty($_POST['id'])){

                    $data = $dbHelpers->edit($table, [$_POST]);

                }
                else {

                    $data = $dbHelpers->add($table, $_POST);

                }

                break;

            case 'edit':

                $table = $_POST['table'] ?? 'todo_list';

                $data = $dbHelpers->edit($table, $_POST['data']);


                break;

            case 'delete':

                $table = $_POST['table'] ?? 'todo_list';

                $data = $dbHelpers->delete($table, $_POST['data']);


                break;

            default:

                $data = $dbHelpers->get();

        }

        // Возвращаем результат операции в формате JSON

        echo json_encode($data);

        // Завершаем выполнение скрипта

        return true;

    }

}