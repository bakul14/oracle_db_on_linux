<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


ob_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Доступ только через POST');
    }

    $conn = oci_connect($db_shema_login, $db_shema_pass, $db);
    if (!$conn) {
        throw new Exception('Ошибка подключения: ' . oci_error()['message']);
    }

    if (empty($_POST['name']) || empty($_POST['value']) || empty($_POST['device_id'])) {
        throw new Exception('Все поля обязательны');
    }

    $name = trim($_POST['name']);
    $value = trim($_POST['value']);
    $device_id = (int) $_POST['device_id'];

    $check_sql = "SELECT 1 FROM device WHERE device_id = :device_id";
    $check_stmt = oci_parse($conn, $check_sql);
    oci_bind_by_name($check_stmt, ':device_id', $device_id);
    oci_execute($check_stmt);

    if (!oci_fetch($check_stmt)) {
        throw new Exception("Устройство не найдено");
    }

    $sql = "INSERT INTO comp (comp_name, comp_value, comp_device_id) 
            VALUES (:name, :value, :device_id)";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':name', $name);
    oci_bind_by_name($stmt, ':value', $value);
    oci_bind_by_name($stmt, ':device_id', $device_id);

    if (!oci_execute($stmt)) {
        $e = oci_error($stmt);
        throw new Exception("Ошибка SQL: " . $e['message']);
    }


    ob_end_clean(); // Очистка буфера
    header('Location: show.php');
    exit();

} catch (Exception $e) {
    ob_end_clean(); // Очистка буфера
    die("Ошибка: " . htmlspecialchars($e->getMessage()));
} finally {
    ob_end_clean();
    if (isset($stmt))
        oci_free_statement($stmt);
    if (isset($check_stmt))
        oci_free_statement($check_stmt);
    if ($conn)
        oci_close($conn);
}
?>