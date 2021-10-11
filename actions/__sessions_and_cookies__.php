<?php

    /* Установить установки по умолчанию для _SESSION */
    function session_drop_settings (string $default_username="Гость")
    {
        $_SESSION["is_authorized"] = 0;
        $_SESSION["username"] = $default_username;
        $_SESSION["password"] = "undefined";
    }



    /* Установить пользователя в сессии как авторизованного. */
    function session_activate_user (string $username, string $password)
    {
        $_SESSION["is_authorized"] = 1;
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
    }



    /* Разлогинить пользователя */
    function logout_user()
    {
        session_drop_settings();
    }
?>