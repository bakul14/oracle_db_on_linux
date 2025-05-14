<?php

require 'auth.php';

// Проверка на авторизацию
if (!isAuthenticated()) {
    header('Location: login.php'); // Перенаправление на страницу входа
    exit();
}
?>