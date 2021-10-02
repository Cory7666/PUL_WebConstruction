<?php
    if (!$_GET['password'] || !$_GET['username']) return 1;

    $DB = array("Cory7666" => "123");

    echo "Введено имя пользователя: ".$_GET['username']."<br />";
    echo "Введён пароль:            ".$_GET['password']."<br />";
    if ($DB[$_GET['username']] == $_GET['password'])
        echo "Пользователь существует.";
    else
        echo "Пользователь не существует.";
    echo "<br />";

    echo "<a href=\"/\">Вернуться к форме</a><br />";

    try
    {
        $dbh = new PDO('mysql:host=localhost;dbname=proj_db', 'alex', '2467');
        echo "<br />Успешное подключение к базе данных!<br />";
        
        
    }
    catch (PDOException $e)
    {
        print "<br />Ошибка!: ".$e->getMessage()."<br />";
    }

    $str = "Apple";
    echo "Хэш пароля: ".hash("md5", $_GET["password"]).".";