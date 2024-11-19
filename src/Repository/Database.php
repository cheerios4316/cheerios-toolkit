<?php
namespace Src\Repository;

use PDO;

class Database
{
    protected static ?PDO $connection = null;

    public function connect()
    {
        $host = $_SERVER['DB_HOST'];
        $dbname = $_SERVER['DB_NAME'];
        $dbuser = $_SERVER['DB_USER'];
        $dbpassword = $_SERVER['DB_PASSWORD'];

        $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
        self::$connection = new PDO($dsn, $dbuser, $dbpassword);
        self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $sql, array $bindparams = []) {
        if(!self::$connection) {
            $this->connect();
        }

        $query = self::$connection->prepare($sql);
        
        foreach($bindparams as $key=>$val) {
            $query->bindParam(':' . $key, $val);
        }

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}