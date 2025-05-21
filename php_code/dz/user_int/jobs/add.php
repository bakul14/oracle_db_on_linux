<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

$conn = oci_connect($db_shema_login, $db_shema_pass, $db);
if (!$conn) {
    throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
}

// SQL-запрос для добавления задачи
$sql = "INSERT INTO job (job_comp_id, job_tech_id, job_us_id, job_name)
          VALUES (:job_comp_id, :job_tech_id, :job_us_id, :job_name)";
$stmt = oci_parse($conn, $sql);

oci_bind_by_name($stmt, ':job_comp_id', $_POST['comp_id']);
oci_bind_by_name($stmt, ':job_tech_id', $_POST['tech_id']);
oci_bind_by_name($stmt, ':job_us_id', $_POST['user_id']);
oci_bind_by_name($stmt, ':job_name', $_POST['job_name']);

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