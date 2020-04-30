<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/class/user.php';
class UserController
{

    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';
        $result = false;
        
        if (isset($_POST['login'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $login = $_POST['login'];
            $errors = false;
            
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            
            if (!User::checkLoginLen($login)) {
                $errors[] = 'Логин не должен быть короче 3-х символов';
            }
            
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }
            
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            if (!User::checkConfirmPassword($confirm_password, $password)) {
                $errors[] = 'Пароль не совпадает';
            }
            
            if (User::checkEmailExists($email)) {
                $errors[] = 'Такой email уже используется';
            }
            
           if (User::checkLoginExists($login)) {
               $errors[] = 'Такой login уже используется';
            }           
            if ($errors == false) {
                $result = User::register($name, $email, $password, $login);
            } else echo json_encode($errors);

        }

        return true;
    }

}