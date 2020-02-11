<?php
session_start();
if (!$_SESSION['admin']) { Header("Location: index.php"); exit; }

?>

<a href="news.php">Управление новостями</a><br />
<a href="logout.php">Выйти</a><br />