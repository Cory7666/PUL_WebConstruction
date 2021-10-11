<?php
    session_start();

    if (isset($_REQUEST['type']) && $_REQUEST['type'] == "logout") { logout_user(); exit(0); }
    if (!$_REQUEST['password'] || !$_REQUEST['username']) return 1; // Завершить работу скрипта, если переметры не были переданы
    
    include("__sessions_and_cookies__.php");
    include("__db__.php");

    // Нормализация Логина и хэширование Пароля
    $user       = trim($_REQUEST["username"]);
    $passwd_md5 = hash("md5", trim($_REQUEST["password"]));
    $query_type = trim($_REQUEST['type']);
    
    session_start();

    try
    {
        /* === Подключение к базе данных === */
        $dbh = new PDO('mysql:host=localhost;dbname=proj_db', 'alex', '2467');
        
        /* === Определение типа запроса === */
        switch ($query_type)
        {
            case "reg": /* Регистрация нового пользователя */
                echo '<h1>Регистрация нового пользователя</h1>';

                if (!db_check_user($dbh, $user, $passwd_md5))
                {
                    echo "УДАЧА!<br />";
                    db_add_user($dbh, $user, $passwd_md5);
                    session_activate_user($user, $passwd_md5);
                }
                else
                    echo "ПОТРАЧЕНО!<br />";

                break;
            


            case "login": /* Попытка входа на сайт */
                echo '<h1>Попытка входа</h1>';

                if (db_check_user($dbh, $user, $passwd_md5))
                {
                    echo "УДАЧА!<br />";
                    session_activate_user($user, $passwd_md5);
                }
                else
                    echo "ПОТРАЧЕНО!<br />";
                
                break;
            
            

            case "logout": /* Разлогинить пользователя */
                logout_user();
                break;



            default: /* Неверный тип запроса */
                echo '<h1>Неверный тип запроса</h1>';
                break;
        }
    }
    catch (PDOException $e)
    {
        print "<br />Ошибка PDO: ".$e->getMessage()."<br />";
    }

    echo "<h1>Здравствуйте, ".$_SESSION["username"]."</h1>";

    echo "<a href=\"/\">Вернуться к форме</a>";