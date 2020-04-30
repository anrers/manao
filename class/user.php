<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/class/db.php';
define('SOL', 'sol');
class User
{
    public static function register($name, $email, $password, $login) {
        
        $password1 = SOL.md5($password);
        
        $nXML = simplexml_load_file('base.xml');
        $newСhild = $nXML ->addChild("user");
        //Добавление параметров записи
        $newСhild->addChild("login", "$login");
        $newСhild->addChild("password", "$password1");
        $newСhild->addChild("email", "$email");
        $newСhild->addChild("name", "$name");
        file_put_contents ('base.xml', $nXML->asXML());
      
        $status = array(
    	'status' => 'ok',
        ); 
        echo json_encode($status);
        return json_encode($status);
        
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
     * Сравниваем пароли
     */
    public static function checkConfirmPassword($confirm_password, $password) {
        if ($password === $confirm_password) {
            return true;
        }
        return false;
    }
    /**
     * Проверяет логин: не меньше, чем 2 символа
     */
    public static function checkLoginLen($login) {
    if (strlen($name) >= 3) {
        return true;
    }
    return false;
    }
    
    /**
     * Проверяет пароль: не меньше, чем 6 символов
     */
    public static function checkPassword($password) {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    
    /**
     * Проверяет email
     */
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    /**
     * Проверяет занят ли email
     */
    public static function checkEmailExists($email) {
        
        $db = Db::getConnection();
        
        while ($db->read()) {
            if($db->nodeType == XMLReader::ELEMENT && $db->localName == 'email') {
                $db->read();
                if ($db->value == $email) {
                    return true;
                }
            }
        }
        return false;
    }
    /**
     * Проверяет занят ли login
     */
     public static function checkloginExists($login) {
        
        $db = Db::getConnection();
        
        while ($db->read()) {
            if($db->nodeType == XMLReader::ELEMENT && $db->localName == 'login') {
                $db->read();
                if ($db->value == $login) {
                    return true;
                }
            }
        }
        return false;
    }
    /**
     * Проверяет логин и пароль пользователя
     */
    public static function checkUser($login, $password) {
        
        $db = simplexml_load_file("base.xml");
        
        foreach ($db->user as $user) {
            
            $loginCheck = $user->login->__toString();
            $passwordCheck = $user->password->__toString();
            $password1 = SOL.md5($password);
            if ($loginCheck == $login and $passwordCheck == $password1) {
                return true;
            }                               
        }
        return false;
    }
    /**
     * Проверяет существует ли login
     */
    public static function checkLogin($login) {
        
        $db = Db::getConnection();
        
        while ($db->read()) {
            if($db->nodeType == XMLReader::ELEMENT && $db->localName == 'login') {
                $db->read();
                if ($db->value == $login) {
                    return true;
                }
            }
        }
        return false;
    }
    /**
     * Возвращает имя пользователя
     */
        public static function getUserName($login) {
        
        $db = simplexml_load_file("base.xml");
        
        foreach ($db->user as $user) {

            if ($user->login == $login) {
                $name = $user->name->__toString();
                
                return $name;
            }      
                                       
        }
        return false;
    }
    /**
     * Авторизирует пользователя
     */
    public static function userAuth($login) {
        $_SESSION['auth'] = $login;
        $_SESSION['name'] = User::getUserName($login);
        setcookie("auth", 'y');
    }
}
