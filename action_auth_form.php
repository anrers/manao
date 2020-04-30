<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/class/userAuth.php';
if (isset($_POST["login"]) ) { 

    $user = new UserAuth();
    $user->actionAuth();
   	// Формируем массив для JSON ответа
 
}