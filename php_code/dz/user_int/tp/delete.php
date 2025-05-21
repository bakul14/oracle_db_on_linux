<?php
// Включение буферизации вывода в самом начале
ob_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/common.php';

try {
    // Проверяем метод запроса
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Доступ только через POST-запрос');
    }

    // Проверяем наличие обязательного поля
    if (empty($_POST['id'])) {
        throw new Exception('ID компонента не указан');
    }

    // Приводим ID к числу
    $tp_id = (int) $_POST['id'];

    // Подключаемся к БД
    $conn = oci_connect($db_shema_login, $db_shema_pass, $db);
    if (!$conn) {
        throw new Exception('Ошибка подключения: ' . oci_error()['message']);
    }

    // Проверяем существование тп
    $check_sql = "SELECT 1 FROM technology WHERE tp_id = :tp_id";
    $check_stmt = oci_parse($conn, $check_sql);
    oci_bind_by_name($check_stmt, ':tp_id', $tp_id);
    oci_execute($check_stmt);

    if (!oci_fetch($check_stmt)) {
        throw new Exception("ТП с ID $tp_id не найден");
    }

    // Удаляем ктп
    $sql = "DELETE FROM technology WHERE tp_id = :tp_id";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':tp_id', $tp_id);

    if (!oci_execute($stmt)) {
        $e = oci_error($stmt);
        throw new Exception("Ошибка удаления: " . $e['message']);
    }

    // Успешный редирект
    ob_end_clean();
    header('Location: show.php');
    exit();

} catch (Exception $e) {
    // Обработка ошибки
    ob_end_clean();
    die("Ошибка: " . htmlspecialchars($e->getMessage()));
} finally {
    ob_end_clean();
    // Освобождаем ресурсы
    if (isset($stmt))
        oci_free_statement($stmt);
    if (isset($check_stmt))
        oci_free_statement($check_stmt);
    if ($conn)
        oci_close($conn);
}
?>