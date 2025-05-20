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

    <title>Добавить компонент</title>
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
            width: 500px; /* Ширина модального окна */
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
        <a href="/adm_int/components/show.php"><button>Компоненты</button></a>
        <a href="/adm_int/devices/show.php"><button>Устройства</button></a>
        <a href="/adm_int/jobs/show.php"><button>Операции</button></a>
        <a href="/adm_int/tp/show.php"><button>Техпроцесс</button></a>
        <a href="/adm_int/users/show.php"><button>Пользователи</button></a>
    </div>

    <div class="content">
        <h2>Компоненты</h2>

        <form action="/auth/logout.php" method="post" style="display:inline;">
            <button type="submit" class="logout-button">Выход</button>
        </form>

        <!-- Кнопки для внесения и извлечения данных -->
        <div class="action-buttons">
            <button onclick="modalAddComponent()">Добавить компонент</button>
            <button onclick="modalDeleteComponent()">Удалить компонент</button>
        </div>
        <!-- Модальное окно для добавления компонента-->
        <div id="modalAddComponent" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Добавить компонент</h2>
                <form action="add.php" method="post">
                    <input type="text" id="name" name="name" placeholder="Наименование, например, конденсатор электролитический" required>
                    <input type="text" id="value" name="value" placeholder="Номинал, например, 10 uF 50 V" required>
                    <input type="submit" value="Добавить">
                </form>
            </div>
        </div>
        <!-- Модальное окно для добавления компонента-->
        <div id="modalDeleteComponent" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Удалить компонент</h2>
                <form action="delete.php" method="post">
                    <input type="text" id="id" name="id" placeholder="Идентификатор компонента" required>
                    <input type="submit" value="Удалить">
                </form>
            </div>
        </div>

        <script>
        function modalAddComponent() {
            document.getElementById("modalAddComponent").style.display = "block";
        }
        function modalDeleteComponent() {
            document.getElementById("modalDeleteComponent").style.display = "block";
        }
        function closeModal() {
            document.getElementById("modalAddComponent").style.display = "none";
            document.getElementById("modalDeleteComponent").style.display = "none";
        }
        </script>

        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
        try {
            $conn = oci_connect($db_shema_login, $db_shema_pass, $db);
            if (!$conn) {
                throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
            }
            // SQL-запрос для получения компонентов
            $sql = "SELECT comp_id, comp_name, comp_value FROM comp ORDER BY comp_id DESC";
            $stmt = oci_parse($conn, $sql);
            oci_execute($stmt);

            echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Наименование</th>
                    <th>Номинал</th>
                </tr>";

        while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['COMP_ID']) . "</td>";
            echo "<td>" . htmlspecialchars($row['COMP_NAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['COMP_VALUE']) . "</td>";
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