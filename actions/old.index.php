<?php

    // Включение модулей
    include("__sessions_and_cookies__.php");
    include("__db__.php");

    /*** Начало выполнения программы ***/

    /* Выход, если не был передан тип запроса */
    if (!isset($_REQUEST["type"]) || $_REQUEST["type"] == "")
    {
        echo "Не был передан тип запроса.<br />";
        echo "Вернуться на <a href=\"/\">ГЛАВНУЮ СТРАНИЦУ</a>.";
        return 1;
    }


    
    /* Запуск сессии */
    session_start();

    /* Выполнить действие, если необходимо Разлогиниться */
    if ($_REQUEST["type"] == "logout")
    {
        logout_user();
        echo "Выход выполнен.<br />";
        echo "Вернуться на <a href=\"/\">ГЛАВНУЮ СТРАНИЦУ</a>.";
        return 0;
    }

    /* Проверка  наличия Логина и Пароля */
    if ( (!isset($_REQUEST["username"]) || $_REQUEST["username"] == "") || (!isset($_REQUEST["password"]) || $_REQUEST["password"] == "") )
    {
        echo "Не передан Логин или Пароль.<br />";
        echo "Вернуться на <a href=\"/\">ГЛАВНУЮ СТРАНИЦУ</a>.";
        return 2;
    }

    /* Нормализация полученных данных и хэширование Пароля */
    $user            = trim($_REQUEST["username"]);
    $passwd_md5      = hash("md5", trim($_REQUEST["password"]));
    $user_name       = trim($_REQUEST["user_name"]);
    $user_surname    = trim($_REQUEST["user_surname"]);
    $user_patronymic = trim($_REQUEST["user_patronymic"]);
    $user_email      = trim($_REQUEST["user_email"]);
    $user_phone_num  = trim($_REQUEST["user_phone_num"]);
    $query_type      = trim($_REQUEST['type']);

    try
    {
        /* Подключение к базе данных */
        $dbh = new PDO('mysql:host=localhost;dbname=proj_db', 'alex', '2467');

        /* Обработка типа запроса */
        switch ($query_type)
        {
            case "reg":
                echo 'Регистрация нового пользователя.<br />';
                if (!db_check_user($dbh, $user, $passwd_md5))
                {
                    echo "УДАЧА!<br />";
                    db_add_user($dbh, $user, $passwd_md5, $user_name, $user_surname, $user_patronymic, $user_email, $user_phone_num);
                    session_activate_user($user, $passwd_md5);
                }
                else
                    echo "ПОТРАЧЕНО!<br />";
                break;
            
            case "login":
                echo "Попытка входа.<br />";
                if (db_check_user($dbh, $user, $passwd_md5))
                {
                    echo "УДАЧА!<br />";
                    session_activate_user($user, $passwd_md5);
                }
                else
                    echo "ПОТРАЧЕНО!<br />";
                break;

            default:
                echo "Неверный тип запроса.";
                break;
        }
    }
    catch (PDOException $e)
    {
        print "<br />Ошибка PDO: ".$e->getMessage()."<br />";
    }

    echo "Вернуться на <a href=\"/\">ГЛАВНУЮ СТРАНИЦУ</a>.";
?>