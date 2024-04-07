<?php

require_once "config.php";

class Database {
    private static $instance = null;
    private $conn; // Store the PDO connection object
    
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
        $this->port = "5432"; // Added port field
        $this->database = "db";
        
        $this->connect(); // Automatically connect when instance is created
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    private function connect()
    {
        try {
            $this->conn = new PDO(
                "pgsql:host=$this->host;port=$this->port;dbname=$this->database", // Updated connection string
                $this->username,
                $this->password,
                ["sslmode"  => "prefer"] // Not necessary, will leave it
            );

            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            // @TODO Show error page
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function disconnect() {
        $this->conn = null; // Close the database connection
    }

    private function __clone() {}
    private function __wakeup() {}
}
