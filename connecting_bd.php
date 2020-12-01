<?php
session_start();
$host = 'localhost';
$database = 'test_rgsu';
$user = 'root';
$password = '';

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

?>