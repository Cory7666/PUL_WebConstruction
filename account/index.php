<?php
include("../actions/__sessions_and_cookies__.php");
include("../actions/__db__.php");


session_start();
$dbh = new PDO('mysql:host=localhost;dbname=proj_db', 'alex', '2467');


if (!isset($_SESSION["username"]))
{    
    if (isset($_COOKIE["username"]) && isset($_COOKIE["password"]) && db_check_user($dbh, $_COOKIE["username"], $_COOKIE["password"]))
    {
        activate_user($_COOKIE["username"], $_COOKIE["password"]);
    }
    else
    {
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
                echo file_get_contents("__forms__.html");
            }
            else
            // Пользователь авторизован
            {
                $user_info = db_get_user_info($dbh, $_SESSION["username"]);

                echo "<p>Логин: ".$user_info["username"]."</p>";
                echo "<p>Фамилия: ".$user_info["user_name"]."</p>";
                echo "<p>Имя: ".$user_info["user_surname"]."</p>";
                echo "<p>Отчество: ".$user_info["user_patronymic"]."</p>";
                echo "<p>E-mail: ".$user_info["user_email"].
                    (($user_info["user_email"] != "") ?
                        "<a href=\"mailto:".$user_info["user_email"]."\">Отправить тестовое сообщение</a>" :
                        ""
                    )."</p>";
                echo "<p>Номер телефона: ".$user_info["user_phone_num"]."<a href=\"tel:+".$user_info["user_phone_num"]."\">Проверить доступность</a></p>";
        ?>
        
        <form action="/actions/" method="get">
            <input name="type" type="hidden" value="logout" placeholder="Тип запроса" />
            <input type="submit" value="Выйти">
        </form>
        
        <?php } ?>
    </div>

    <?php echo file_get_contents("../__patterns__/__footer__.html"); ?>
</body>

</html>