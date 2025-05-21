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
        <h3>Работник</h3>
        <a href="/user_int/components/show.php"><button>Компоненты</button></a>
        <a href="/user_int/devices/show.php"><button>Устройства</button></a>
        <a href="/user_int/jobs/show.php"><button>Операции</button></a>
        <a href="/user_int/tp/show.php"><button>Техпроцесс</button></a>
    </div>

    <div class="content">
        <h2>АСУ изготовления радиопередатчика. РАБОТНИК</h2>
        <form action="/auth/logout.php" method="post" style="display:inline;">
            <button type="submit" class="logout-button">Выход</button>
        </form>
    </div>

</body>

</html>