<?php
namespace tomtroc\utils;

/**
 * Database connection singleton using PDO for SQLite
 */
class Database {
    private static $instance = null;
    private $pdo;

    private function __construct($dbFile) {
        try {
            $dsn = 'sqlite:' . $dbFile;
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_CLASS,
                //https://stackoverflow.com/questions/134099/are-pdo-prepared-statements-sufficient-to-prevent-sql-injection/12202218#12202218
                \PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->pdo = new \PDO($dsn, null, null, $options);
            // enable foreign key constraints
            $this->pdo->exec("PRAGMA foreign_keys = ON;");
        } catch (\PDOException $e) {
            echo "Error: " . $e->getMessage();
            exit;
        }
    }

    /**
     * Get Database instance (singleton)
     */
    public static function getInstance($dbFile): Database {
        if (is_null(self::$instance)) {
            self::$instance = new Database($dbFile);
        }
        return self::$instance;
    }

    /**
     * Get PDO instance
     */
    public function getPDO(): \PDO {
        return $this->pdo;
    }

    // avoid clone method to prevent cloning of the instance
    private function __clone() {}

    // avoid unserializing the instance
    private function __wakeup() {}
}