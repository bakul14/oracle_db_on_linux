<?php

$db_shema_login = 'MISHA';
$db_shema_pass = 'MISHA';
$db_sid = 'FREE';
$ip = dns_get_record('sql_server.g', DNS_A)[0]['ip'];
$db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$ip)(PORT=1521))(CONNECT_DATA=(SID=$db_sid)))";
$conn = oci_connect($db_shema_login, $db_shema_pass, $db);
if (!$conn) {
    throw new Exception('Ошибка подключения к Oracle: ' . oci_error()['message']);
}

// Получение данных из формы
$jobtype = $_POST['jobtype'];
$firstname = $_POST['firstname'];
$secondname = $_POST['secondname'];
$thirdname = $_POST['thirdname'];
$post = $_POST['post'];
$login = $_POST['login'];
$password = $_POST['password'];

// SQL-запрос для добавления сотрудника
$sql = "INSERT INTO users (user_job_id, user_id, user_firstname, user_secondname, user_thirdname, user_post, user_login, user_password) VALUES (1, NULL, :firstname, :secondname, :thirdname, :post, :login, :password)";
$stmt = oci_parse($conn, $sql);

// Привязка параметров
oci_bind_by_name($stmt, ':firstname', $firstname);
oci_bind_by_name($stmt, ':secondname', $secondname);
oci_bind_by_name($stmt, ':thirdname', $thirdname);
oci_bind_by_name($stmt, ':post', $post);
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