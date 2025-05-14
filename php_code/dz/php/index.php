<?php
echo '<br>';

try {
    $ip = dns_get_record('sql_server.g', DNS_A)[0]['ip'];
    $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=tcp)(HOST=$ip)(PORT=1521))(CONNECT_DATA=(SERVER=DEDICATED)(SERVICE_NAME=FREEPDB1)))";
    $conn = oci_connect('root', 'root', $db);
    if ($conn) {
        echo 'Успешно подключено к Oracle. <br>';

    } else {
        throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
    }

} catch (Exception $e) {
    echo 'Ошибка: ' . htmlentities($e->getMessage(), ENT_QUOTES, 'UTF-8') . '<br>';
}

// Закрываем соединение
if (isset($conn)) {
    oci_close($conn);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>АСУ - Форма авторизации</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px; /* Добавлено немного отступов */
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            width: calc(100% - 30px);
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        .login-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* Ширина формы */
            margin: 20px auto;
            position: relative;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: calc(100%);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Автоматизированная система управления (АСУ) 
        для изготовления радиопередатчика
    </h1>
    <p>Добро пожаловать! Пожалуйста, войдите в систему.</p>
</div>

<div class="login-container">
    <h2>Авторизация</h2>
    <form action="/login" method="POST">
        <div class="form-group">
            <label for="username">Имя пользователя:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Войти</button>
    </form>
</div>

</body>
</html>
