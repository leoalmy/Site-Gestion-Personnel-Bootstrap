<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

class M_generique
{
    private $cnx;

    public function connexion($profile = 'data')
    {
        try {
            $host = $_ENV["DB_" . strtoupper($profile) . "_HOST"];
            $dbname = $_ENV["DB_" . strtoupper($profile) . "_NAME"];
            $user = $_ENV["DB_" . strtoupper($profile) . "_USER"];
            $pass = $_ENV["DB_" . strtoupper($profile) . "_PASS"];
            $charset = $_ENV["DB_" . strtoupper($profile) . "_CHARSET"] ?? 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $this->cnx = new \PDO($dsn, $user, $pass, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (\PDOException $e) {
            // Re-throw or return error to controller
            error_log("Erreur de connexion à la base de données : " . $e->getMessage());

            require __DIR__ . '/../vues/errors/500.php';
            exit;
        }
    }

    public function getCnx($profile = 'data')
    {
        if ($this->cnx === null) {
            $this->connexion($profile);
        }
        return $this->cnx;
    }

    public function deconnexion()
    {
        $this->cnx = null;
    }
}
