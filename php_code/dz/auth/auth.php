<?php

function isAuthenticated()
{
    return isset($_SESSION['username']);
}

function isAdmin()
{
    return isset($_SESSION['admin']);
}

function isUser()
{
    return isset($_SESSION['user']);
}

?>