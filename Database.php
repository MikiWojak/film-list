<?php

require_once 'config.php';

class Database {
    private static $instance = null;
    private $conn;
    
    private $host;
    private $port;
    private $database;
    private $username;
    private $password;

    private function __construct()
    {
        $this->conn = null;

        $this->host = HOST;
        $this->port = PORT;
        $this->database = DATABASE;
        $this->username = USERNAME;
        $this->password = PASSWORD;
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function connect(): void
    {
        try {
            // Connection string
            $this->conn = new PDO(
                "pgsql:host=$this->host;port=$this->port;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode"  => "prefer"] // Not necessary, leave it anyway
            );

            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            ob_start();
            include 'public/views/error.php';;
            $output = ob_get_clean();

            die($output);
        }
    }

    public function getConnection(): PDO {
        return $this->conn;
    }

    public function disconnect(): void {
        $this->conn = null; 
    }
}
