<?php
namespace Src\Repository;

class Connection
{
    protected static string $host = 'localhost';
    protected static string $dbname = $_SERVER['db_name'];
}