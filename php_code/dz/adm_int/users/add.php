<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

$conn = oci_connect($db_shema_login, $db_shema_pass, $db);
if (!$conn) {
    throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
}

// Получение данных из формы
$firstname = $_POST['firstname'];
$secondname = $_POST['secondname'];
$thirdname = $_POST['thirdname'];
$post = $_POST['post'];
$role = $_POST['role'];
$login = $_POST['login'];
$password = $_POST['password'];

// SQL-запрос для добавления сотрудника
$sql = "INSERT INTO users (us_firstname, us_secondname, us_thirdname, us_post, us_role, us_login, us_pass) VALUES (:firstname, :secondname, :thirdname, :post, :role, :login, :password)";
$stmt = oci_parse($conn, $sql);

// Привязка параметров
oci_bind_by_name($stmt, ':firstname', $firstname);
oci_bind_by_name($stmt, ':secondname', $secondname);
oci_bind_by_name($stmt, ':thirdname', $thirdname);
oci_bind_by_name($stmt, ':post', $post);
oci_bind_by_name($stmt, ':role', $role);
oci_bind_by_name($stmt, ':login', $login);
oci_bind_by_name($stmt, ':password', $password);

// Выполнение запроса
if (oci_execute($stmt)) {
    header('Location: show.php');
    exit();
} else {
    $e = oci_error($stmt);
    echo "Ошибка добавления сотрудника: " . $e['message'];
}

// Освобождение ресурсов
oci_free_statement($stmt);
oci_close($conn);
?>