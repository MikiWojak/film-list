<?php

class Database {
    private static $instance = null;
    // Store the PDO connection object
    private $conn;
    
    // @TODO Get from .env
    private $username;
    private $password;
    private $host;
    private $port;
    private $database;

    private function __construct()
    {
        $this->username = "docker";
        $this->password = "docker";
        $this->host = "db";
        $this->port = "5432";
        $this->database = "db";
        
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
