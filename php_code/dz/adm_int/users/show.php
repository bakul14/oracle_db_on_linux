<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <title>Добавить сотрудника</title>
    <style>
        /* Стили для модального окна */
        .modal {
            display: none; /* Скрыто по умолчанию */
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0); 
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 300px; /* Ширина модального окна */
            border-radius: 5px; /* Закругленные углы */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Стили для формы */
        form {
            display: flex;
            flex-direction: column; /* Элементы в столбик */
        }

        input[type="text"], input[type="submit"] {
            margin-bottom: 10px; /* Отступ между полями */
            padding: 10px; /* Внутренний отступ */
            border: 1px solid #ccc; /* Рамка */
            border-radius: 4px; /* Закругленные углы */
            font-size: 14px; /* Размер шрифта */
        }

        input[type="submit"] {
            background-color: #4CAF50; /* Цвет кнопки */
            color: white; /* Цвет текста кнопки */
            border: none; /* Убираем рамку */
            cursor: pointer; /* Указатель при наведении */
        }

        input[type="submit"]:hover {
            background-color: #45a049; /* Цвет кнопки при наведении */
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h3>Администратор</h3>
        <a href="/adm_int/orders/show.php"><button>Заказы</button></a>
        <a href="/adm_int/docs/show.php"><button>Документы</button></a>
        <a href="/adm_int/devices/show.php"><button>Устройства</button></a>
        <a href="/adm_int/issue/show.php"><button>Операции</button></a>
        <a href="/adm_int/users/show.php"><button>Работники</button></a>
        <a href="/adm_int/detali/show.php"><button>Компоненты</button></a>
        <a href="/adm_int/raws/show.php"><button>Расходные материалы</button></a>
    </div>

    <div class="content">
        <h2>Сотрудники компании</h2>

        <form action="/auth/logout.php" method="post" style="display:inline;">
            <button type="submit" class="logout-button">Выход</button>
        </form>

        <!-- Кнопки для внесения и извлечения данных -->
        <div class="action-buttons">
            <button onclick="modalAddUser()">Пригласить</button>
            <button onclick="modalDeleteUser()">Уволить</button>
        </div>
        <!-- Модальное окно для добавления сотрудника-->
        <div id="modalAddUser" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Добавить сотрудника</h2>
                <form action="add.php" method="post">
                    <input type="text" id="firstname" name="firstname" placeholder="Имя" required>
                    <input type="text" id="secondname" name="secondname" placeholder="Фамилия" required>
                    <input type="text" id="thirdname" name="thirdname" placeholder="Отчество">
                    <input type="text" id="post" name="post" placeholder="Должность" required>
                    <input type="text" id="role" name="role" placeholder="Роль" required>
                    <input type="text" id="login" name="login" placeholder="Логин">
                    <input type="text" id="password" name="password" placeholder="Пароль" required>
                    <input type="submit" value="Добавить">
                </form>
            </div>
        </div>
        <!-- Модальное окно для добавления сотрудника-->
        <div id="modalDeleteUser" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Удалить сотрудника</h2>
                <form action="delete.php" method="post">
                    <input type="text" id="id" name="id" placeholder="Идентификатор сотрудника" required>
                    <input type="submit" value="Удалить">
                </form>
            </div>
        </div>

        <script>
        function modalAddUser() {
            document.getElementById("modalAddUser").style.display = "block";
        }
        function modalDeleteUser() {
            document.getElementById("modalDeleteUser").style.display = "block";
        }
        function closeModal() {
            document.getElementById("modalAddUser").style.display = "none";
            document.getElementById("modalDeleteUser").style.display = "none";
        }
        </script>


        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
        try {
            $conn = oci_connect($db_shema_login, $db_shema_pass, $db);
            if (!$conn) {
                throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
            }
            // SQL-запрос для получения данны
            $sql = "SELECT us_id, us_firstname, us_secondname, us_thirdname, us_post, us_role FROM users";
            $stmt = oci_parse($conn, $sql);
            oci_execute($stmt);

            echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Фамилия</th>
                    <th>Отчество</th>
                    <th>Должность</th>
                    <th>Роль</th>
                </tr>";

        while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['US_ID']) . "</td>";
            echo "<td>" . htmlspecialchars($row['US_FIRSTNAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['US_SECONDNAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['US_THIRDNAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['US_POST']) . "</td>";
            echo "<td>" . htmlspecialchars($row['US_ROLE']) . "</td>";
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