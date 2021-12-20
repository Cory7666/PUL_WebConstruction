<?php

    // Включение модулей
    include("__sessions_and_cookies__.php");
    include("__db__.php");

    /*** Начало выполнения программы ***/

//    echo "Получен запрос. Обработка...<br />";

    try
    {
        /* Преобразование запроса в нормализированный вид */
        $username        = trim($_REQUEST["username"]);
        $passwd_md5      = hash("md5", trim($_REQUEST["password"]));
        $user_name       = trim($_REQUEST["user_name"]);
        $user_surname    = trim($_REQUEST["user_surname"]);
        $user_patronymic = trim($_REQUEST["user_patronymic"]);
        $user_email      = trim($_REQUEST["user_email"]);
        $user_phone_num  = trim($_REQUEST["user_phone_num"]);
        $query_type      = trim($_REQUEST['type']);

        /* Запуск сессии и Подключение к БД через PDO */
        session_start();
        $dbh = new PDO('mysql:host=localhost;dbname=proj_db', 'alex', '2467');

        /* Обработка запроса */
        switch ($query_type)
        {
            // Попытка зарегистрироваться
            case "reg":
//                echo "Попытка зарегистрироваться.<br />";

                /* Проверить наличие минимально нужных данных */
                if (!isset($_REQUEST["username"])       || ($_REQUEST["username"] == "")       ||
                    !isset($_REQUEST["password"])       || ($_REQUEST["password"] == "")       ||
                    !isset($_REQUEST["user_name"])      || ($_REQUEST["user_name"] == "")      ||
                    !isset($_REQUEST["user_surname"])   || ($_REQUEST["user_surname"] == "")   ||
                    !isset($_REQUEST["user_phone_num"]) || ($_REQUEST["user_phone_num"] == "")
                ) throw new Exception("Кое-каких данных для регистрации не достаёт");

                /* Проверить существованиу пользователя в БД перед добавлением */
                if (db_has_username($dbh, $username)) throw new Exception("Пользователь уже существует. Нет необходимости регистрировать нового");

                /* Добавить пользователя в БД и активировать его */
                db_add_user($dbh, $username, $passwd_md5, $user_name, $user_surname, $user_patronymic, $user_email, $user_phone_num);
                activate_user($username, $passwd_md5);

//                echo "УДАЧА!<br />";

                header('Location: /account/');
                break;

            // Попытка залогиниться
            case "login":
//                echo "Попытка залогиниться.<br />";

                /* Проверить наличие необходимых данных */
                if (!isset($_REQUEST["username"]) || !isset($_REQUEST["password"])) throw new Exception("Не получены Имя пользователя или Пароль");

                /* Проверить существованиу пользователя с переданными данными */
                if (!db_check_user($dbh, $username, $passwd_md5)) throw new Exception("Введены неверный Логин или Пароль или пользователь не зарегистрирован");

                /* Логин пользователя в системе */
                activate_user($username, $passwd_md5);
                
//                echo "УДАЧА!<br />";

                header('Location: /account/?errcode=0');
                break;
            
            // Попытка разлогиниться
            case "logout":
//                echo "Попытка разлогиниться.<br />";

                if (isset($_SESSION["is_authorized"]) && $_SESSION["is_authorized"])
                // Пользователь был авторизован в системе. Выход
                {
                    logout_user();
//                    echo "УДАЧА!<br />";
                }
                else
                // Пользователь не был авторизован
                {
                    throw new Exception("Пользователь не был авторизован в системе. Не от куда выходить");
                }

                header('Location: /account/');
                break;
            
            // Неверный запрос
            default:
                throw new Exception("Неверный тип запроса <".$query_type.">");
                break;
        }

        print "Перейти в <a href=\"/account/\">ЛИЧНЫЙ КАБИНЕТ</a>.<br />";
    }
    // Ошибка PDO
    catch (PDOException $e)
    {
        header('Location: /account/?errcode=1');
        print "Ошибка PDO: ".$e->getMessage()."<br />";
        print "Вернуться на <a href=\"/account/\">СТРАНИЦУ РЕГИСТРАЦИИ</a>.<br />";
    }
    // Исключение, выброшенное во время попытки регистрации/авторизации пользователя
    catch (Exception $e)
    {
        header('Location: /account/?errcode=2');
        print "Ошибка: ".$e->getMessage()."<br />";
        print "Вернуться на <a href=\"/account/\">СТРАНИЦУ РЕГИСТРАЦИИ</a>.<br />";
    }
    finally
    {
        print "Вернуться на <a href=\"/\">ГЛАВНУЮ СТРАНИЦУ</a>.<br />";
    }
?>