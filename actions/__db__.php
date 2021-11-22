<?php
    /* Проверить, существует ли пользователь с данным Логином в БД. */
    function db_has_username (PDO $dbh, string $username)
    {
        return (
            0 < $dbh->query(
                "SELECT * FROM `login_info` WHERE `username`='$username'"
            )->rowCount()
        );
    }



    /*
        Проверить, существует ли пользователь с данным Логином и с данным
        Паролем в БД.
    */
    function db_check_user (PDO $dbh, string $username, string $password)
    {
        return (
            0 < $dbh->query(
                "SELECT * FROM `login_info` WHERE `username`='$username' AND `passwd_md5`='$password'"
            )->rowCount()
        );
    }



    /* Добавить нового пользователя в БД. */
    function db_add_user (
        PDO $dbh,
        string $username, string $password,
        string $user_name, string $user_surname, string $user_patronymic,
        string $user_email, string $user_phone_num
    )
    {
        return (
            $dbh->exec("INSERT INTO `login_info` (`username`, `passwd_md5`) VALUE ('$username', '$password')") &&
            $dbh->exec("INSERT INTO `users_info` (`id`, `username`, `user_name`, `user_surname`, `user_patronymic`, `user_email`, `user_phone_num`) VALUES (NULL, '$username', '$user_name', '$user_surname', '$user_patronymic', '$user_email', '$user_phone_num')")
        );
    }



    /* Получить информацию о пользователе */
    function db_get_user_info (PDO $dbh, string $username)
    {
        return $dbh->query("SELECT * FROM `users_info` WHERE (`username`='$username')")->fetch(pdo::FETCH_LAZY);
    }
?>