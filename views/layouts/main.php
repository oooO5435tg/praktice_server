<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pop it MVC</title>
</head>
<body>
<header>
    <nav style="background-color: #D9D9D9; height: 80px; display: flex; align-items: center; justify-content: space-around">
        <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>
        <a href="<?= app()->route->getUrl('/employer_list') ?>">Список сотрудников</a>
        <a href="<?= app()->route->getUrl('/add_department') ?>">Добавить кафедру</a>
        <a href="<?= app()->route->getUrl('/add_position') ?>">Добавить должность</a>
        <a href="<?= app()->route->getUrl('/add_discipline') ?>">Добавить дисциплину</a>
        <a href="<?= app()->route->getUrl('/add_deanery') ?>">Добавить деканата</a>
        <a href="<?= app()->route->getUrl('/add_employer') ?>">Добавить сотрудников</a>
        <?php
        if (!app()->auth::check()):
            ?>
            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
<!--            <a href="--><?php //= app()->route->getUrl('/signup') ?><!--">Регистрация</a>-->
        <?php
        else:
            ?>
            <a href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->surname ?>)</a>
        <?php
        endif;
        ?>
    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>

</body>
</html>

<style>
    body{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    nav a{
        text-decoration: none;
        color: black;
    }
</style>