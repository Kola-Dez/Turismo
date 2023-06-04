<?php
session_start();

// Проверка наличия сессии пользователя
if ($_SESSION['name'] === 'admin') {
    header('Location: admin.php');
    exit;
}else{
    header('Location: /');
    exit;
}
// Вывод приветствия аутентифицированного пользователя

