<?php

namespace App\Factory;

use PDO;
use PDOException;

class PDOFactory extends PDO
{
    private static $_connexion;

    private string $host = "db";
    private string $dbName = "data";
    private string $userName = "root";
    private string $password = "root";

    private function __construct()
    {
        try {
            parent::__construct("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->userName, $this->password);

            //$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getMySqlPDO()
    {
        if (self::$_connexion == null) {
            self::$_connexion = new self();
        }
        return self::$_connexion;
    }


}
