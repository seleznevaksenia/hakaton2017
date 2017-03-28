<?php

class DirectorController
{
	public function actionAddFromFile()
	{
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

		return true;
	}
}