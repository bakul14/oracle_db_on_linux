<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

$conn = oci_connect($db_shema_login, $db_shema_pass, $db);
if (!$conn) {
    throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
}

// Получение данных из формы
$input_name = $_POST['name'];
$input_value = $_POST['value'];

// SQL-запрос для добавления сотрудника
$sql = "INSERT INTO comp (comp_name, comp_value) VALUES (:input_name, :input_value)";
$stmt = oci_parse($conn, $sql);

// Привязка параметров
oci_bind_by_name($stmt, ':input_name', $input_name);
oci_bind_by_name($stmt, ':input_value', $input_value);

// Выполнение запроса
if (oci_execute($stmt)) {
    header('Location: show.php');
    exit();
} else {
    $e = oci_error($stmt);
    echo "Ошибка добавления компонента: " . $e['message'];
}

// Освобождение ресурсов
oci_free_statement($stmt);
oci_close($conn);
?>