<?php
// app/Views/layout/header.php
// Переменная $title должна быть задана до require этого файла

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="/css/framework.css"><!-- 
        Здесь можно подключить ваш Tabler CSS или другой фронтенд-фреймворк -->
</head>
<body>
<div class="container">
