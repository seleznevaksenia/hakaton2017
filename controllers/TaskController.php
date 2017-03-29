<?php

/**
 * Контроллер AdminProductController
 * Управление товарами в админпанели
 */
class TaskController
{

    /**
     * Action для страницы "Управление товарами"
     */
    public function actionIndex($id)
    {

        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);
        if (!empty($user)) {
            $task = Task::getTasksById($id);
        } else {
            header("Location: /");
        }

        // Подключаем вид
        require_once(ROOT . '/views/task/index.php');
        return true;
    }


    /**
     * Action для страницы "Редактировать товар"
     */
    public function actionUpdate($id)
    {
        // Проверка доступа
        //   self::checkAdmin();


        $task = Task::getTasksById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['task_name'] = $_POST['task_name'];
            $options['description'] = $_POST['description'];
            $options['deadline'] = $_POST['deadline'];
            $options['user_id'] = $_POST['user_id'];
            $options['complete'] = $_POST['complete'];

            // Сохраняем изменения
            Task::updateTaskById($id, $options);


            // Перенаправляем пользователя
            header("Location: /cabinet/index");
        }

        // Подключаем вид
        require_once(ROOT . '/views/task/update.php');
        return true;
    }

    public function actionUpdatetask()
    {
        // Проверка доступа
        //   self::checkAdmin();

        // Обработка формы
        if (isset($_POST['id'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $complete = $_POST['complete'];
            $id = $_POST['id'];

            // Сохраняем изменения
            Task::updateTaskByIdComplete($id, $complete);


            // Перенаправляем пользователя
 //           header("Location: /cabinet/index");
        }

        return true;
    }
    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        //   self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем
            Task::deleteTaskById($id);

            // Перенаправляем пользователя
            header("Location: /cabinet/index");
        }

        // Подключаем вид
        require_once(ROOT . '/views/task/delete.php');
        return true;
    }

}
