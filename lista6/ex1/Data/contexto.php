<?php

class Connection
{
    private static $conn;

    public function getConn()
    {
        if (self::$conn == null)
            self::$conn = new PDO('mysql: host=localhost; dbname=cursos;', 'root', '');

        return self::$conn;
    }
}
