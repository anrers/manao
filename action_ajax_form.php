<?php
if (isset($_POST["name"]) && isset($_POST["login"]) ) { 

    require $_SERVER['DOCUMENT_ROOT'].'/class/userController.php';
    $user = new UserController();
    $user->actionRegister();
   	// Формируем массив для JSON ответа
 
}

?>