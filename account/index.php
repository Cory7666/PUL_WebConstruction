<?php
include("actions/__sessions_and_cookies__.php");

session_start();

if (!isset($_SESSION["username"]))
    session_drop_settings();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>

    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/lib/css/main.css" />
</head>

<body>
    <?php echo file_get_contents("../__patterns__/__header__.html"); ?>

    <div id="content" class="container-md">
        <h1>ЛИЧНЫЙ КАБИНЕТ</h1>
        <?php if ($_SESSION['is_authorized']) { ?>

            <p>Вы вошли на <?php echo $_SESSION['username']; ?>.</p>
            <p>Хэш вашего пароля: <?php echo $_SESSION['password']; ?>.</p>

        <?php } else { ?>

            <p>Вы вошли на <?php echo $_SESSION['username']; ?>.</p>

        <?php } ?>
    </div>

    <?php echo file_get_contents("../__patterns__/__footer__.html"); ?>
</body>

</html>