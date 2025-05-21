<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Операции</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            position: relative;
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

        .logout-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 15px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 500px;
            border-radius: 5px;
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

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h3>Работник</h3>
        <a href="/user_int/components/show.php"><button>Компоненты</button></a>
        <a href="/user_int/devices/show.php"><button>Устройства</button></a>
        <a href="/user_int/jobs/show.php"><button>Операции</button></a>
        <a href="/user_int/tp/show.php"><button>Техпроцесс</button></a>
    </div>

    <div class="content">
        <h2>Операции</h2>

        <form action="/auth/logout.php" method="post" style="display:inline;">
            <button type="submit" class="logout-button">Выход</button>
        </form>

        <!-- Форма выбора устройства -->
        <form method="GET" id="deviceForm" class="action-buttons">
            <select name="device_id" onchange="this.form.submit()">
                <option value="">Выберите связку (Техпроцесс - Устройство)</option>
                <?php
                require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
                $conn = oci_connect($db_shema_login, $db_shema_pass, $db);
                $selected_device = $_GET['device_id'] ?? null;

                if ($conn) {
                    $stmt = oci_parse(
                        $conn,
                        "SELECT t.tp_id, d.device_id, d.device_name 
                         FROM technology t
                         JOIN device d ON t.tp_device_id = d.device_id"
                    );
                    oci_execute($stmt);

                    while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        $selected = $selected_device == $row['DEVICE_ID'] ? 'selected' : '';
                        echo '<option value="' . $row['DEVICE_ID'] . '" ' . $selected . '>'
                            . 'TP' . $row['TP_ID'] . ' - '
                            . htmlspecialchars($row['DEVICE_NAME'])
                            . '</option>';
                    }
                    oci_free_statement($stmt);
                }
                ?>
            </select>

            <button type="button" onclick="modalAddComponent()">Добавить операцию</button>
            <button type="button" onclick="modalDeleteComponent()">Удалить операцию</button>
        </form>

        <!-- Таблица операций -->
        <?php
        if ($conn && $selected_device) {
            try {
            $sql = "SELECT j.job_id, 
                        j.job_name,
                        c.comp_name || ' ' || c.comp_value as component_info,
                        t.tp_name, 
                        u.us_firstname||' '||u.us_secondname as user_name
                    FROM job j
                    JOIN comp c ON j.job_comp_id = c.comp_id
                    JOIN technology t ON j.job_tech_id = t.tp_id
                    JOIN users u ON j.job_us_id = u.us_id
                    WHERE c.comp_device_id = :device_id
                    ORDER BY j.job_id DESC";

                $stmt = oci_parse($conn, $sql);
                oci_bind_by_name($stmt, ':device_id', $selected_device);
                oci_execute($stmt);

                echo "<table>
                        <tr>
                            <th>ID</th>
                            <th>Название операции</th>
                            <th>Компонент</th>
                            <th>Техпроцесс</th>
                            <th>Ответственный</th>
                        </tr>";

                while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['JOB_ID']) . "</td>
                            <td>" . htmlspecialchars($row['JOB_NAME']) . "</td>
                            <td>" . htmlspecialchars($row['COMPONENT_INFO']) . "</td>
                            <td>" . htmlspecialchars($row['TP_NAME']) . "</td>
                            <td>" . htmlspecialchars($row['USER_NAME']) . "</td>
                        </tr>";
                }
                echo "</table>";

                oci_free_statement($stmt);
            } catch (Exception $e) {
                echo '<p style="color: red;">Ошибка загрузки данных: ' . htmlspecialchars($e->getMessage()) . '</p>';
            }
        } elseif ($conn) {
            echo '<p>Выберите связку из списка для просмотра операций</p>';
        }
        ?>

        <!-- Модальное окно добавления -->
        <div id="modalAddComponent" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Добавить операцию</h2>
                <form action="add.php" method="post">
                    <input type="hidden" name="device_id" value="<?= $selected_device ?>">

                    <?php if ($selected_device): ?>
                        <!-- Компоненты -->
                        <select name="comp_id" required>
                            <?php
                            $stmt = oci_parse(
                                $conn,
                                "SELECT comp_id, comp_name 
                             FROM comp 
                             WHERE comp_device_id = :device_id"
                            );
                            oci_bind_by_name($stmt, ':device_id', $selected_device);
                            oci_execute($stmt);

                            while ($comp = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                echo '<option value="' . $comp['COMP_ID'] . '">'
                                    . htmlspecialchars($comp['COMP_NAME'])
                                    . '</option>';
                            }
                            oci_free_statement($stmt);
                            ?>
                        </select>

                        <!-- Техпроцессы -->
                        <select name="tech_id" required>
                            <?php
                            $stmt = oci_parse(
                                $conn,
                                "SELECT tp_id, tp_name 
                             FROM technology 
                             WHERE tp_device_id = :device_id"
                            );
                            oci_bind_by_name($stmt, ':device_id', $selected_device);
                            oci_execute($stmt);

                            while ($tech = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                echo '<option value="' . $tech['TP_ID'] . '">'
                                    . htmlspecialchars($tech['TP_NAME'])
                                    . '</option>';
                            }
                            oci_free_statement($stmt);
                            ?>
                        </select>
                    <?php endif; ?>

                    <!-- Пользователи -->
                    <select name="user_id" required>
                        <?php
                        $stmt = oci_parse($conn, "SELECT us_id, us_firstname, us_secondname FROM users");
                        oci_execute($stmt);

                        while ($user = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
                            echo '<option value="' . $user['US_ID'] . '">'
                                . htmlspecialchars($user['US_FIRSTNAME'] . ' ' . $user['US_SECONDNAME'])
                                . '</option>';
                        }
                        oci_free_statement($stmt);
                        ?>
                    </select>
                    <input type="text" name="job_name" required placeholder="Введите название операции"
                        style="margin-top: 10px; padding: 8px; width: 100%;">
                    <input type="submit" value="Добавить" style="margin-top: 10px;">
                </form>
            </div>
        </div>

        <script>
            function modalAddComponent() {
                document.getElementById("modalAddComponent").style.display = "block";
            }

            function modalDeleteComponent() {
                // Реализация удаления при необходимости
            }

            function closeModal() {
                document.getElementById("modalAddComponent").style.display = "none";
            }

            // Закрытие модального окна при клике вне его
            window.onclick = function (event) {
                if (event.target.className === 'modal') {
                    event.target.style.display = "none";
                }
            }
        </script>

    </div>
</body>

</html>