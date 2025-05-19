<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>АСУ изготовления радиопередатчика - Главная страница</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            position: relative; /* Позволяет позиционировать элементы внутри body */
        }

        .sidebar {
            width: 200px;
            background-color: #007bff;
            padding: 15px;
            color: white;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }

        .sidebar button:hover {
            background-color: #004494;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .action-buttons {
            margin-top: 20px;
        }

        .action-buttons button {
            padding: 10px 15px;
            margin-right: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .action-buttons button:hover {
            background-color: #218838;
        }

        /* Стили для кнопки "Выход" */
        .logout-button {
            position: absolute; /* Позиционирование относительно родителя */
            top: 20px; /* Отступ сверху */
            right: 20px; /* Отступ справа */
            padding: 10px 15px;
            background-color: #dc3545; /* Красный цвет */
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #c82333; /* Темнее при наведении */
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h3>Администратор</h3>
        <button onclick="alert('Открытие таблицы Заказы...')">Заказы</button>
        <button onclick="alert('Открытие таблицы Документы...')">Документы</button>
        <button onclick="alert('Открытие таблицы Устройства...')">Устройства</button>
        <button onclick="alert('Открытие таблицы Операции...')">Операции</button>
        <button onclick="alert('Открытие таблицы Работники...')">Работники</button>
        <button onclick="alert('Открытие таблицы Компоненты...')">Компоненты</button>
        <button onclick="alert('Открытие таблицы Расходные материалы...')">Расходные материалы</button>
    </div>

    <div class="content">
        <h2>Сотрудники компании</h2>

        <form action="/auth/logout.php" method="post" style="display:inline;">
            <button type="submit" class="logout-button">Выход</button>
        </form>

        <!-- Кнопки для внесения и извлечения данных -->
        <div class="action-buttons">
            <button onclick="alert('Извлечение данных...')">Пригласить</button>
            <button onclick="alert('Извлечение данных...')">Уволить</button>
        </div>

        <?php

        try {
            $db_shema_login = 'MISHA';
            $db_shema_pass = 'MISHA';
            $db_sid = 'FREE';
            $ip = dns_get_record('sql_server.g', DNS_A)[0]['ip'];
            $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$ip)(PORT=1521))(CONNECT_DATA=(SID=$db_sid)))";
            $conn = oci_connect($db_shema_login, $db_shema_pass, $db);
            if (!$conn) {
                throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
            }
            // SQL-запрос для получения данных
            $sql = "SELECT user_job_id, user_firstname, user_secondname, user_thirdname, user_post FROM users";
            $stmt = oci_parse($conn, $sql);
            oci_execute($stmt);


            echo "<table border='1'>
                <tr>
                    <th>Работа</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Должность</th>
                </tr>";

        // Вывод данных в таблицу
        while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['USER_JOB_ID']) . "</td>";
            echo "<td>" . htmlspecialchars($row['USER_FIRSTNAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['USER_SECONDNAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['USER_THIRDNAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['USER_POST']) . "</td>";
            echo "</tr>";
        }

        // Закрытие таблицы
        echo "</table>";

            oci_free_statement($stmt);
            oci_close($conn);

        } catch (Exception $e) {
            echo 'Ошибка: ' . htmlentities($e->getMessage(), ENT_QUOTES, 'UTF-8') . '<br>';
            exit();
        }
        ?>

        <!-- CSS для чередующихся строк -->
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #007bff;
                color: white;
            }

            /* Чередующиеся строки таблицы */
            tbody tr:nth-child(even) {
                background-color: #c5c0c0;
                /* Светло-серый для четных строк */
            }

            tbody tr:nth-child(odd) {
                background-color: #ffffff;
                /* Белый для нечетных строк */
            }
        </style>

    </div>

</body>

</html>