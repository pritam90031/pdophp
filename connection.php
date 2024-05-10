<?php
include('config.php');

class Connection {
    function __construct() {
        // echo 'I am working';
        // echo $host;
    }
        
    public function connect() {
        $config =  new Config();
        // we can create a db connection and return an object
        try {
            $conn = new PDO("mysql:host=$config->host;dbname=$config->database", $config->username, $config->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conn;

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}

$connection = new Connection();
$connection = $connection->connect();
// Connection::HelloEarth();