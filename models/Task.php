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

    public static function getTasksFromFile($path) {

        //эти пометки ставит пользователь в файле перед каждой соответствующей строкой
        //задания разделяются пустой строкой
        //формат дедлайна строгий: year-month-day hh:mm:ss

        $patternTask = 'Task: ';
        $patternDescription = 'Description: ';
        $patternDeadline = 'Deadline: ';

        $tasks = array();
        $fp = fopen($path, 'r');

        if ($fp) {

            $i=0;

            //формирование массива с заданиями
            while (!feof($fp)) {
                $task_name = false;
                $description = false;
                $deadline = false;

                //если найдена в строке пометка, 
                //остается только текст после нее (значение) до конца строки 
                //и записывается в массив под соответствующим ключем

                $str = fgets($fp, 999);
                if (preg_match("/" . $patternTask . "/",$str)) {
                    $task_name = str_replace($patternTask, "", stristr($str, $patternTask));
                }

                $str = fgets($fp, 999);
                if (preg_match("/" . $patternDescription . "/",$str)) {
                    $description = str_replace($patternDescription, "", stristr($str, $patternDescription));
                }

                $str = fgets($fp, 999);
                if (preg_match("/" . $patternDeadline . "/",$str)) {
                    $deadline = str_replace($patternDeadline, "", stristr($str, $patternDeadline));
                }

                //значение task_name обязательно, остальные - нет
                if ($task_name) {
                    $tasks[$i] = array('task_name' => $task_name);
                    if ($description) {
                        $tasks[$i]['description'] = $description;
                    }
                    if ($deadline) {
                        $tasks[$i]['deadline'] = $deadline;
                    }
                }

                //считывание пустой строки между заданиями
                $str = fgets($fp, 999);

                $i++;
            }
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

}