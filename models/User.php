<?php

class User
{
    public static function register($name,$password,$role) {
        
        $db = Db::getConnection();
        $password = md5($password);
        
        $sql = 'INSERT INTO user (name, password, role)'
                . 'VALUES (:name, :password, :role)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':role', $role, PDO::PARAM_STR);


        return $result->execute();
    }
    
    /**
     * Проверяет имя: не меньше, чем 2 символа
     */
    public static function checkName($name) {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }
    /**
     * Проверяет имя: не меньше, чем 6 символов
     */
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    public static function checkNameExists($name){
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM user WHERE name = :name';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();
        $count=$result->fetchColumn();
        return $count;
    }

    public static function checkPasswordRepeat($password,$passwordRepeat) {
        if ($password == $passwordRepeat) {
            return true;
        }
        return false;
    }
    

    public static function checkUserData($name,$password) {

        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE name = :name AND password = :password';
        $password = md5($password);
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        $user =  $result->fetch();

        if($user) {

            return $user;
        }
        return false;
    }

    public static function auth($user) {

        $_SESSION['user'] = $user['id'];
        $_SESSION['role'] = $user['role'];

    }
   public static function checkLogged(){
        if(isset($_SESSION['user']))
        {
            return $_SESSION['user'];
        }
        header("Location:/user/login");
    }
    public static function isGuest(){

       if(isset($_SESSION['user']))
        {
            return false;
        }
        return true;
    }
    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';
            $result = $db->prepare($sql);
            $result -> bindParam(':id',$id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result-> execute();
            return $result->fetch();
        }
    }

    public static function edit($id,$name,$password)
    {
            $db = Db::getConnection();

            $sql = "UPDATE user SET name = :name, password = :password WHERE id = :id";
            $result = $db->prepare($sql);
            $result -> bindParam(':name',$name, PDO::PARAM_STR);
            $result -> bindParam(':password',$password, PDO::PARAM_STR);
            $result -> bindParam(':id',$id, PDO::PARAM_INT);         //$result->setFetchMode(PDO::FETCH_ASSOC);
           return $result-> execute();
    }
}