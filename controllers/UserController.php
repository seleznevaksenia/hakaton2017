<?php

class UserController
{

    public function actionRegister()
    {

        $name = '';
        $password = '';
        $passwordRepeat = '';
        $role = '';
        $result = false;
        if (isset($_SESSION['user'])) {
            header("Location:/cabinet");
            return true;
        } else {
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $passwordRepeat = $_POST['passwordRepeat'];
                $password = $_POST['password'];
                $role = $_POST['role'];
                $errors = false;
                if (!User::checkName($name)) {
                    $errors[] = 'Имя не должно быть короче 2-х символов';
                }

                if (!User::checkPassword($password)) {
                    $errors[] = 'Пароль не должен быть короче 6-ти символов';
                }

                if (User::checkNameExists($name)) {
                    $errors[] = 'Такое имя уже используется';
                }
                if (!User::checkpasswordRepeat($password, $passwordRepeat)) {
                    $errors[] = 'Пароли не совпадают';
                }
                if ($errors == false) {
                    $result = User::register($name, $password, $role);
                    if ($result) {
                        header("Location:/user/login");
                    }

                }

            }
        }


        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionLogin()
    {
        $name = '';
        $password = '';
        if (isset($_SESSION['user'])) {
            header("Location:/cabinet");
            return true;
        } else {


            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $password = $_POST['password'];
                $errors = false;

                if (!User::checkName($name)) {
                    $errors[] = 'Неправильный логин';
                }

                if (!User::checkPassword($password)) {
                    $errors[] = 'Пароль не должен быть короче 6-ти символов';
                }

                $user = User::checkUserData($name, $password);

                if ($user['id'] == false) {
                    $errors[] = 'Неправильные данные для входа на сайт';
                } else {

                    User::auth($user);
                    header("Location:/cabinet");
                }

            }
            require_once(ROOT . '/views/user/login.php');
            return true;
        }
    }

    public function actionLogout()
    {
        unset($_SESSION['role']);
        unset($_SESSION['user']);


        header("Location:/");
    }
}


