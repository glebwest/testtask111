<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Тестовый список задач</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo CSS . 'style.css' ?>">
</head>
<body>


<div class="feedback">
<h3>Успех!</h3>
<p>Задача успешно добавлена</p>
</div>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">

<a class="navbar-brand" href="/">Главная</a>
<?
if ($_SESSION['admin'])
{
    ?>
    <a class="navbar-brand" href="/logout">Выйти</a>
    <?php
}
else
{
    ?>
    <a class="navbar-brand" href="/login">Войти</a>
    <?php
}
?>
    </div>

</nav>


<div class="container">
    

