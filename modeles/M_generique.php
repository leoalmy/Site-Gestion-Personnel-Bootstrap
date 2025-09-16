<?php
require __DIR__ . '/../vendor/autoload.php'; // corrected path

use Dotenv\Dotenv;

class M_generique
{
    private $cnx;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/..'); // load from project root
        $dotenv->load();
    }

    public function GetCnx()
    {
        return $this->cnx;
    }

    public function Connexion()
    {
        $host = $_ENV['DB_HOST'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
        $charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        try {
            $this->cnx = new \PDO($dsn, $user, $pass, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public function Deconnexion()
    {
        $this->cnx = null;
    }
}
