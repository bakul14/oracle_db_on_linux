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

        <table>
            <thead>
                <tr>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Должность</th>
                    <th>Телефон</th>
                    <th>Идентификатор работы</th>
                    <th>Контакт</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Иванов</td>
                    <td>Иван</td>
                    <td>Иванович</td>
                    <td>Менеджер</td>
                    <td>+7 (999) 123-45-67</td>
                    <td>001</td>
                    <td>ivanov@example.com</td>
                </tr>
                <tr>
                    <td>Петров</td>
                    <td>Петр</td>
                    <td>Петрович</td>
                    <td>Инженер</td>
                    <td>+7 (999) 234-56-78</td>
                    <td>002</td>
                    <td>petrov@example.com</td>
                </tr>
                <tr>
                    <td>Сидоров</td>
                    <td>Сидор</td>
                    <td>Сидорович</td>
                    <td>Техник</td>
                    <td>+7 (999) 345-67-89</td>
                    <td>003</td>
                    <td>sidorov@example.com</td>
                </tr>
                <tr>
                    <td>Сергеев</td>
                    <td>Сергей</td>
                    <td>Сергеевич</td>
                    <td>Монтажник</td>
                    <td>+7 (999) 345-67-89</td>
                    <td>004</td>
                    <td>sergeev@example.com</td>
                </tr>
            </tbody>
        </table>

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