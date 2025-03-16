<?php
class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            self::$connection = new mysqli('localhost', 'root', '', 'gestion_club');

            if (self::$connection->connect_error) {
                die("Erreur de connexion à la base de données : " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}