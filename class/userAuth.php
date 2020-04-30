<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/class/user.php';
class UserAuth
{

    public function actionAuth()
    {
        
        $password = '';
        $result = false;
        
        if (isset($_POST['login'])) {

            $password = $_POST['password'];
            $login = $_POST['login'];
            $errors = false;
            
            if (!User::checkLogin($login)) {
               $errors[] = 'Такого пользователя не существует!';
               echo json_encode($errors);
               return true;
            }  

            if (!User::checkUser($login, $password)) {
               $errors[] = 'Пароль не верен';
            }         
            
            if ($errors == false) {
                User::userAuth($login);
                $status = array(
                'status' => 'auth',
                'name' => User::getUserName($login),
                ); 
                echo json_encode($status);
            } else echo json_encode($errors);

        }

        return true;
    }

}