<?php

require_once '../helpers/DbHelpers.php';

if($_SERVER["REQUEST_METHOD"] == "POST" && is_array($_POST)){

    $dbHelpers = new DbHelpers();

    foreach ($_POST as $i => $item) {

        $_POST[$i] = trim($item);

    }

    if(!count($_POST)) {

        $_POST = json_decode(file_get_contents('php://input'), true);

    }

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

        echo json_encode($data);

        return true;

    }

}