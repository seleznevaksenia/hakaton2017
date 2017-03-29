<?php

class Task
{

    public static function getTasks(){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT * FROM task ORDER BY id_task ASC');
        $tasks = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $tasks[$i]['id_task'] = $row['id_task'];
            $tasks[$i]['task_name'] = $row['task_name'];
            $tasks[$i]['description'] = $row['description'];
            $tasks[$i]['user_id'] = $row['user_id'];
            $tasks[$i]['deadline'] = $row['deadline'];
            $tasks[$i]['complete'] = $row['complete'];
            $i++;

        }
        return $tasks;
    }
    public static function getTasksByUser($userid){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM task WHERE user_id = :userid ORDER BY id_task ASC';
        $result = $db->prepare($sql);
        $result->bindParam(':userid', $userid, PDO::PARAM_INT);
        $result->execute();

        $userTasks = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $userTasks[$i]['id_task'] = $row['id_task'];
            $userTasks[$i]['task_name'] = $row['task_name'];
            $userTasks[$i]['description'] = $row['description'];
            $userTasks[$i]['deadline'] = $row['deadline'];
            $userTasks[$i]['complete'] = $row['complete'];
            $i++;

        }
        return $userTasks;
    }
    public static function getTasksById($id){
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $sql = 'SELECT * FROM task WHERE id_task = :id_task';
        $result = $db->prepare($sql);
        $result->bindParam(':id_task', $id, PDO::PARAM_INT);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }
    public static function deleteTaskById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM task WHERE id_task = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    public static function updateTaskById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE task
            SET 
                task_name = :task_name, 
                description = :description, 
                user_id = :user_id, 
                deadline = :deadline, 
                complete = :complete
                
            WHERE id_task = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':task_name', $options['task_name'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':deadline', $options['deadline'], PDO::PARAM_STR);
        $result->bindParam(':complete', $options['complete'], PDO::PARAM_INT);



        return $result->execute();
    }

    public static function updateTaskByIdComplete($id, $complete)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE task
            SET 
                complete = :complete
                
            WHERE id_task = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':complete', $complete, PDO::PARAM_INT);



        return $result->execute();
    }

    public static function getTasksFromFile($path) {

        //эти пометки ставит пользователь в файле перед каждой соответствующей строкой
        //задания разделяются пустой строкой (несколькими)
        //между пунктами одного задания не могут находиться пустые строки
        //формат дедлайна строгий: year-month-day hh:mm:ss
        $patternTask = 'Task: ';
        $patternDescription = 'Description: ';
        $patternDeadline = 'Deadline: ';

        $tasks = array();
        $fp = fopen($path, 'r');

        if ($fp) {

            $i=0;

            //считать возможные пустые строки в начале файла
            do {
                $str = fgets($fp, 999);
            } while (empty(trim($str)) && !feof($fp));

            //формирование массива с заданиями
            do {
                $task_name = false;
                $description = false;
                $deadline = false;

                //считывать до пустой строки (до конца задания)
                do {
                    //если найдена в строке пометка, 
                    //остается только текст после нее (значение) до конца строки 
                    //и записывается под соответствующим ключем
                    if (preg_match("/" . $patternTask . "/",$str)) {
                        $task_name = str_replace($patternTask, "", stristr($str, $patternTask));
                    } else {
                        if (preg_match("/" . $patternDescription . "/",$str)) {
                            $description = str_replace($patternDescription, "", stristr($str, $patternDescription));
                        } else {
                            if (preg_match("/" . $patternDeadline . "/",$str)) {
                                $deadline = str_replace($patternDeadline, "", stristr($str, $patternDeadline));
                            }
                        }
                    }
                    $str = fgets($fp, 999);
                } while (!empty(trim($str)));

                //значение task_name обязательно, остальные - нет
                if ($task_name) {
                    $tasks[$i] = array('task_name' => $task_name);

                    if ($description) {
                        $tasks[$i]['description'] = $description;
                    }
                    if ($deadline) {
                        $tasks[$i]['deadline'] = $deadline;
                    }
                    $i++;
                }
            } while (!feof($fp));
        }

        fclose($fp);
        return $tasks;
    }


    public static function addTasks($tasks) {
        $db = Db::getConnection();

        //используется принцип подготовленных значений чтобы избежать sql-инъекций

        //формирование строки с подготовленными значения для insert
        $valuesArray = [];

        foreach ($tasks as $key => $item) {
            $valuesArray[] = '(:task_name'.$key.',:description'.$key.',:deadline'.$key.')';
        }
        if (!empty($valuesArray)) {
            $valuesForQuery = implode(',', $valuesArray);

            //формирование запроса
            $sql = 'INSERT INTO `task` (`task_name`, `description`, `deadline`) '
            . 'VALUES ' . $valuesForQuery;
        }
        
        $result = $db->prepare($sql);

        //заполнение подготовленных значений
        foreach ($tasks as $key => $item) {
            $result->bindParam(':task_name'.$key, $item['task_name'], PDO::PARAM_STR);
            $result->bindParam(':description'.$key, $item['description'], PDO::PARAM_STR);
            $result->bindParam(':deadline'.$key, $item['deadline'], PDO::PARAM_STR);
        }

        //$numberInsertedTasks = 0;
        
        if ($result->execute()) {
            return true;
        } else {
            return false;
        }

        //не работает
        //но хочется вывести количество добавленных заданий
        //$numberInsertedTasks = $db->rowCount();
        //return $numberInsertedTasks;
    }

    public static function addTask($task) {
        $db = Db::getConnection();

        $sql = 'INSERT INTO `task` (`task_name`, `description`, `deadline`) '
            . 'VALUES (:task_name, :description, :deadline)';
        $result = $db->prepare($sql);
        
        $result->bindParam(':task_name', $task['task_name'], PDO::PARAM_STR);
        $result->bindParam(':description', $task['description'], PDO::PARAM_STR);
        $result->bindParam(':deadline', $task['deadline'], PDO::PARAM_STR);  

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
    }

}