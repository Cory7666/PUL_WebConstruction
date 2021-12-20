<?php
include("../actions/__sessions_and_cookies__.php");
include("../actions/__db__.php");


session_start();
$dbh = new PDO('mysql:host=localhost;dbname=proj_db', 'alex', '2467');


if (!isset($_SESSION["username"])) {
    if (isset($_COOKIE["username"]) && isset($_COOKIE["password"]) && db_check_user($dbh, $_COOKIE["username"], $_COOKIE["password"])) {
        activate_user($_COOKIE["username"], $_COOKIE["password"]);
    } else {
        session_drop_settings();
    }
}

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNT | Управление аккаунтом</title>

    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/lib/css/main.css" />
</head>

<body>
    <?php echo file_get_contents("../__patterns__/__header__.html"); ?>

    <div id="content" class="container-md">
        <h1>Управление аккаунтом</h1>
        <?php
        if (!$_SESSION["is_authorized"])
        // Пользователь не авторизован
        {
            if (isset($_GET["errcode"]) && $_GET["errcode"] == 2) {
        ?>
                <div class="alert alert-danger">
                    Ошибка регистрации. Скорее всего, такой пользователь существует, или вы ввели неверные данные.
                </div>
            <?php
            } else if (isset($_GET["errcode"]) && $_GET["errcode"] == 1) {
            ?>
                <div class="alert alert-danger">
                    Ошибка PDO. Обратитесь к администратору сервера.
                </div>
            <?php
            }
            echo file_get_contents("__forms__.html");
        } else
        // Пользователь авторизован
        {
            $user_info = db_get_user_info($dbh, $_SESSION["username"]);
            ?>
            <?php if (isset($_GET["errcode"]) && $_GET["errcode"] == 0) {
            ?>
                <div class="alert alert-success">
                    Успешная авторизация.
                </div>
            <?php
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Информация</th>
                        <th scope="col">Значение</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td scope="col">Логин</td>
                        <td scope="col"><?php echo $user_info["username"]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td scope="col">Фамилия</td>
                        <td scope="col"><?php echo $user_info["user_surname"]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td scope="col">Имя</td>
                        <td scope="col"><?php echo $user_info["user_name"]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td scope="col">Отчество</td>
                        <td scope="col"><?php echo $user_info["user_patronymic"]; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td scope="col">Email</td>
                        <td scope="col"><?php
                                        if ($user_info["user_email"]) {
                                            echo "<a href=\"mailto:" . $user_info["user_email"] . "\">" . $user_info["user_email"] . "</a>";
                                        } else {
                                            echo "Не указано";
                                        }
                                        ?></td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td scope="col">Номер телефона</td>
                        <td scope="col"><?php
                                        echo "<a href=\"tel:" . $user_info["user_phone_num"] . "\">+" . $user_info["user_phone_num"] . "</a>";
                                        ?></td>
                    </tr>
                </tbody>
            </table>

            <form action="/actions/" method="get">
                <input name="type" type="hidden" value="logout" placeholder="Тип запроса" />
                <input type="submit" value="Выйти">
            </form>

        <?php } ?>
    </div>

    <?php echo file_get_contents("../__patterns__/__footer__.html"); ?>
</body>

</html>