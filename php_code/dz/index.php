<?php

require 'auth/auth.php';

if (!isAuthenticated()) {
    header('Location: auth/index.php');
    exit();
}
?>
