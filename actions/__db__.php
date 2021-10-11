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
    function db_add_user (PDO $dbh, string $username, string $password)
    {
        return $dbh->exec("INSERT INTO `login_info` (`username`, `passwd_md5`) VALUE ('$username', '$password')");
    }
?>