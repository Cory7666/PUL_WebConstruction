<?php
include("actions/__sessions_and_cookies__.php");

session_start();

if (!isset($_SESSION["username"]))
    session_drop_settings();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ореон</title>

    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/lib/css/main.css" />
</head>

<body>
    <?php echo file_get_contents("./__patterns__/__header__.html"); ?>
    
    <div id="content" class="container-md">
        <div id="welcome">
            <h1>Здравствуйте, <?php echo $_SESSION["username"]; ?>!</h1>
        </div>
        <div id="actions">
            <p>Выполнить действие:</p>
            <ul>
            <?php
            if (!$_SESSION["is_authorized"]) {
            ?>

               <li><a href="/register/">Зарегистрироваться</a></li>
               <li><a href="/login/">Войти</a></li>

            <?php
            } else {
            ?>

                <li><a href="/actions/?type=logout">Выйти</a></li>

            <?php
            }
            ?>
            </ul>
        </div>
    </div>
    
    <?php echo file_get_contents("./__patterns__/__footer__.html"); ?>
</body>

</html>