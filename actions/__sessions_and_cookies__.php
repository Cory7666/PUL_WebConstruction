<?php

    /* Установить установки по умолчанию для _SESSION */
    function session_drop_settings (string $default_username="Гость")
    {
        $_SESSION["is_authorized"] = false;
        $_SESSION["username"] = $default_username;
        $_SESSION["password"] = "undefined";

        setcookie("username", "", time() - 1, "/");
        setcookie("password", "", time() - 1, "/");
    }



    /* Установить пользователя в сессии как авторизованного. */
    function activate_user (string $username, string $password)
    {
        $_SESSION["is_authorized"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;

        setcookie("username", $username, time() + 60 * 60 * 24 * 31 * 366, "/");
        setcookie("password", $password, time() + 60 * 60 * 24 * 31 * 366, "/");
    }



    /* Разлогинить пользователя */
    function logout_user()
    {
        session_drop_settings();
    }
?>