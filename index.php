<?php
    session_start();
    try
    {
        $dbh = new PDO('mysql:host=localhost;dbname=proj_db', 'alex', '2467');
    }
    catch (PDOException $e)
    {
        print "<br />Ошибка PDO: ".$e->getMessage()."<br />";
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/" />
    <title>Главная страница</title>
</head>
<body>
    <h1>Здравствуйте, <?php if ($_SESSION["is_authorized"]) echo $_SESSION["username"]; else echo "Гость"; ?>!</h1>

    <form action="actions/" method="get">
        <input type="text" name="username" placeholder="Имя пользователя" />
        <input type="password" name="password" placeholder="Пароль" />

        <br />
        <br />
        <br />

        <label for="type_choice_1">Зарегистрировать нового</label>
        <input id="type_choice_1" type="radio" name="type" value="reg" />
        <br />
        <label for="type_choice_2">Войти как старый</label>
        <input id="type_choice_2" type="radio" name="type" value="login" />
        <br />
        <label for="type_choice_3">Выйти</label>
        <input id="type_choice_3" type="radio" name="type" value="logout" />

        <br />
        <br />
        <br />

        <input type="submit" />
    </form>
</body>
</html>