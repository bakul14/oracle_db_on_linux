<?php
    $db_shema_login = 'MISHA';
    $db_shema_pass = 'MISHA';
    $db_sid = 'FREE';
    $ip = dns_get_record('sql_server.g', DNS_A)[0]['ip'];
    $db = "(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=$ip)(PORT=1521))(CONNECT_DATA=(SID=$db_sid)))";
?>
