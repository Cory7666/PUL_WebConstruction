<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в личный кабинет</title>

    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap-reboot.min.css" />
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/lib/css/main.css" />
</head>

<body>
    <?php echo file_get_contents("../__patterns__/__header__.html"); ?>

    <div id="content" class="container-md">
        <form id="loginForm" action="/actions" method="get">
            <input type="hidden" name="type" value="login" />
            <div>
                <label for="field_username">Логин</label>
                <input name="username" id="field_username" type="text" placeholder="Логин" />
            </div>
            <div>
                <label for="field_password">Пароль</label>
                <input name="password" id="field_password" type="password" placeholder="Пароль" />
            </div>
            <div>
                <input type="submit" value="Войти" />
            </div>
        </form>
    </div>

    <?php echo file_get_contents("../__patterns__/__footer__.html"); ?>
</body>

</html>