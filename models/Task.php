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

}