<?php

class DirectorController
{
	public function actionAddFromFile()
	{
		User::checkDirector();

		//пока что захардкордженный путь
		$path = '\tasks.txt';
		$tasks = Task::getTasksFromFile(ROOT.'\tasks.txt');

		print_r($tasks);
		echo '<br>';

		if (Task::addTasks($tasks)) {
			echo 'Задания добавлены';
		} else {
			echo 'Ошибка добавления данных в базу';
		}

		require_once(ROOT . '/views/director/add_file.php');
		return true;
	}

	public function actionCreateTask()
    {
    	User::checkDirector();

        if (isset($_POST['submit'])) {
            $task['task_name'] = $_POST['task_name'];
            $task['description'] = $_POST['description'];
            $task['deadline'] = $_POST['deadline'];

            $errors = false;

            if (!isset($task['task_name']) || empty($task['task_name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                $id = Task::addTask($task);
                header("Location: /director/");
            }
        }

        require_once(ROOT . '/views/director/add_form.php');
		return true;
    }
}