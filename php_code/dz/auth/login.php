<?php
session_start();

require 'auth.php';

$db_shema_login = 'MISHA';
$db_shema_pass = 'MISHA';
$db_sid = 'FREE';

$admin_login = 'MISHA';
$admin_password = 'MISHA';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if ($input_username === $admin_login && $input_password === $admin_password) {
        $_SESSION['username'] = $input_username;
        $_SESSION['role'] = 'admin';
        header('Location: /adm_int/index.php');
        exit();
    } else {
        try {
            $ip = dns_get_record('sql_server.g', DNS_A)[0]['ip'];
            $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$ip)(PORT=1521))(CONNECT_DATA=(SID=$db_sid)))";
            $conn = oci_connect($db_shema_login, $db_shema_pass, $db);
            if (!$conn) {
                throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
            }
            // Подготовленный запрос для проверки кредов
            $sql = "SELECT * FROM users WHERE user_id = :username AND user_ph = :password";
            $stmt = oci_parse($conn, $sql);

            oci_bind_by_name($stmt, ':username', $input_username);
            oci_bind_by_name($stmt, ':password', $input_password);

            oci_execute($stmt);

            if (oci_fetch_array($stmt, OCI_ASSOC)) {
                header('Location: /user_int/index.php');
            } else {
                echo "Неверный логин или пароль.";
            }

            oci_free_statement($stmt);
            oci_close($conn);

        } catch (Exception $e) {
            echo 'Ошибка: ' . htmlentities($e->getMessage(), ENT_QUOTES, 'UTF-8') . '<br>';
            exit();
        }
    }
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
            padding: 20px;
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
            width: 300px;
            /* Ширина формы */
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
            width: calc(100% - 20px);
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

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Автоматизированная система управления
            для изготовления радиопередатчика
        </h1>
        <p>Добро пожаловать! Пожалуйста, войдите в систему.</p>
    </div>

    <div class="login-container">
        <h2>Авторизация</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Войти</button>

            <?php if ($error_message): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

        </form>
    </div>

</body>

</html>