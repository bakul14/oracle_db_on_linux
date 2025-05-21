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
            background-color: rgba(0,0,0,0.4);
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

        select, input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>

    <title>Техпроцессы</title>
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
        <h2>Технологические процессы</h2>

        <form action="/auth/logout.php" method="post" style="display:inline;">
            <button type="submit" class="logout-button">Выход</button>
        </form>

        <div class="action-buttons">
            <button onclick="modalAddTp()">Добавить техпроцесс</button>
            <button onclick="modalDeleteTp()">Удалить техпроцесс</button>
            <button onclick="modalExportTp()">Экспорт техпроцесса</button>
        </div>

        <!-- Модальное окно добавления -->
        <div id="modalAddTp" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Добавить техпроцесс</h2>
                <form action="add.php" method="post">
                    <select id="device_id" name="device_id" required>
                        <option value="">Выберите устройство</option>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
                        try {
                            $conn = oci_connect($db_shema_login, $db_shema_pass, $db);
                            if (!$conn) {
                                throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
                            }
                            
                            $sql = "SELECT device_id, device_name FROM device ORDER BY device_name";
                            $stmt = oci_parse($conn, $sql);
                            oci_execute($stmt);

                            while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
                                echo '<option value="' . $row['DEVICE_ID'] . '">' 
                                     . htmlspecialchars($row['DEVICE_NAME']) . '</option>';
                            }
                            
                            oci_free_statement($stmt);
                            oci_close($conn);
                            
                        } catch (Exception $e) {
                            echo '<option value="">Ошибка загрузки: ' . htmlspecialchars($e->getMessage()) . '</option>';
                        }
                        ?>
                    </select>

                    <input type="text" id="name" name="name" placeholder="Наименование техпроцесса" required>
                    <input type="submit" value="Добавить" class="btn-primary">
                </form>
            </div>
        </div>

        <!-- Модальное окно удаления -->
        <div id="modalDeleteTp" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Удалить техпроцесс</h2>
                <form action="delete.php" method="post">
                    <input type="text" id="id" name="id" placeholder="Идентификатор техпроцесса" required>
                    <input type="submit" value="Удалить" class="btn-primary">
                </form>
            </div>
        </div>

        <!-- Модальное окно экспорта -->
        <div id="modalExportTp" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Экспорт техпроцесса</h2>
                <form action="export.php" method="post" target="_blank">
                    <input type="number" name="tp_id" required 
                           placeholder="Введите ID техпроцесса">
                    <input type="submit" value="Экспорт в PDF" class="btn-primary">
                </form>
            </div>
        </div>

        <script>
            function modalAddTp() {
                document.getElementById("modalAddTp").style.display = "block";
            }

            function modalDeleteTp() {
                document.getElementById("modalDeleteTp").style.display = "block";
            }

            function modalExportTp() {
                document.getElementById("modalExportTp").style.display = "block";
            }

            function closeModal() {
                document.getElementById("modalAddTp").style.display = "none";
                document.getElementById("modalDeleteTp").style.display = "none";
                document.getElementById("modalExportTp").style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target.className === 'modal') {
                    event.target.style.display = "none";
                }
            }
        </script>

        <?php
        require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';
        try {
            $conn = oci_connect($db_shema_login, $db_shema_pass, $db);
            if (!$conn) {
                throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
            }
            
            $sql = "SELECT t.tp_id, 
                            t.tp_name,
                            d.device_name 
                     FROM technology t
                     JOIN device d ON t.tp_device_id = d.device_id
                     ORDER BY t.tp_id DESC";
            $stmt = oci_parse($conn, $sql);
            oci_execute($stmt);

            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Наименование</th>
                        <th>Для чего</th>
                    </tr>";

            while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['TP_ID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['TP_NAME']) . "</td>";
                echo "<td>" . htmlspecialchars($row['DEVICE_NAME']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            oci_free_statement($stmt);
            oci_close($conn);

        } catch (Exception $e) {
            echo '<div style="color: red;">Ошибка: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
        ?>
    </div>
</body>
</html>