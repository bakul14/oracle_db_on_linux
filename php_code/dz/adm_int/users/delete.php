<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

$conn = oci_connect($db_shema_login, $db_shema_pass, $db);
if (!$conn) {
    throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
}

// Получение данных из формы
$user_id = $_POST['id'];

// SQL-запрос для добавления сотрудника
$sql = "DELETE FROM users WHERE us_id=:user_id";
$stmt = oci_parse($conn, $sql);

// Привязка параметров
oci_bind_by_name($stmt, ':user_id', $user_id);

// Выполнение запроса
if (oci_execute($stmt)) {
    header('Location: show.php');
    exit();
} else {
    $e = oci_error($stmt);
    echo "Ошибка удаления сотрудника: " . $e['message'];
}
ob_end_clean();
// Освобождение ресурсов
oci_free_statement($stmt);
oci_close($conn);
?>