<?php

class DirectorController
{
    public function actionAddFromFile()
    {
        User::checkDirector();
        $result = '';

        if (isset($_POST['submit'])) {

            $pathToFile = $_SERVER['DOCUMENT_ROOT'] . 'data.txt';

            if (is_uploaded_file($_FILES["userfile"]["tmp_name"])) {
                move_uploaded_file($_FILES["userfile"]["tmp_name"], $pathToFile);
            }

            $tasks = Task::getTasksFromFile($pathToFile);

            unlink($pathToFile);

            if (!empty($tasks)) {
                if (Task::addTasks($tasks)) {
                    $result = 'Задания добавлены!';
                } else {
                    $result = 'Ошибка в добавлении данных';
                }
            } else {
                $result = 'Ошибка в чтении данных из файла';
            }
        }

        require_once(ROOT . '/views/director/add_file.php');
        return true;
    }

    public function actionCreateTask()
    {
        User::checkDirector();
        $result = '';

        if (isset($_POST['submit'])) {
            $task['task_name'] = $_POST['task_name'];
            $task['description'] = $_POST['description'];
            $task['deadline'] = $_POST['deadline'];

            $errors = false;

            if (!isset($task['task_name']) || empty($task['task_name'])) {
                $errors[] = 'Заполните поля';
            }

            //замена возможной пустой строки на null
            if (empty($task['description'])) {
                $task['description'] = null;
            }
            if (empty($task['deadline'])) {
                $task['deadline'] = null;
            }

            if ($errors == false) {
                if (Task::addTask($task)) {
                    $result = 'Задание добавлено!';
                } else {
                    $result = 'Ошибка в добавлении данных';
                }
            }
        }

        require_once(ROOT . '/views/director/add_form.php');
        return true;
    }
}