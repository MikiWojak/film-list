<?php

require_once 'config.php';

class Database {
    private static $instance = null;
    // Store the PDO connection object
    private $conn;
    
    // @TODO Get from .env
    private $host;
    private $port;
    private $database;
    private $username;
    private $password;

    private function __construct()
    {
        $this->host = HOST;
        $this->port = PORT;
        $this->database = DATABASE;
        $this->username = USERNAME;
        $this->password = PASSWORD;
        
        // @TODO Try to restore
        // Automatically connect when instance is created
        // $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function connect()
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

            // @TODO Is it correct?
            return $this->conn;
        }
        catch(PDOException $e) {
            // @TODO Show error page
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Close the database connection
    public function disconnect() {
        $this->conn = null; 
    }

    // @TODO What about these functions?
    // private function __clone() {}
    // private function __wakeup() {}
}
