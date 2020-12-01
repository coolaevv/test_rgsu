<?php

session_start();
require_once 'connecting_bd.php';

$sql = "DELETE FROM `users`";
mysqli_query($link, $sql);
mysqli_close($link);

session_destroy();
header("Location: login.php");

?>