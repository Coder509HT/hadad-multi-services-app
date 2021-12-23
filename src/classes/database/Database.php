<?php

namespace App\database;

use PDO;
use PDOException;

/**
 * Database class
 */
class Database
{
    private ?string $hostName;
    private ?string $dbName;
    private ?string $user;
    private ?string $password;

    private ?string $dsn;
    private ?PDO $connection;

    function __construct()
    {
        $this->hostName = "localhost";
        $this->dbName = "hadad_multi_services_db";
        $this->user = "root";
        $this->password = "";
    }

    public function getConnection()
    {
        try {
            $this->dsn = "mysql:host=" . $this->hostName . ";dbname=" . $this->dbName;
            $this->connection = new PDO($this->dsn, $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->connection;
        } catch (PDOException $e) {
            die("Error : " . $e->getMessage());
        }
    }
}
