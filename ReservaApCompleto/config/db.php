<?php
class DatabaseConfig {
    private static $pdo;

    public static function getConnection() {
        if (!self::$pdo) {
            try {
                $host = "localhost";
                $dbname = "reservaap";
                $user = "root";
                $pass = "";

                self::$pdo = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Erro no banco de dados: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>