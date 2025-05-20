<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

$conn = oci_connect($db_shema_login, $db_shema_pass, $db);
if (!$conn) {
    throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
}

// Получение данных из формы
$comp_id = $_POST['id'];

// SQL-запрос для добавления сотрудника
$sql = "DELETE FROM comp WHERE comp_id=:comp_id";
$stmt = oci_parse($conn, $sql);

// Привязка параметров
oci_bind_by_name($stmt, ':comp_id', $comp_id);

// Выполнение запроса
if (oci_execute($stmt)) {
    header('Location: show.php');
    exit();
} else {
    $e = oci_error($stmt);
    echo "Ошибка удаления компонента: " . $e['message'];
}

// Освобождение ресурсов
oci_free_statement($stmt);
oci_close($conn);
?>