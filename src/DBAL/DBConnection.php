<?php

namespace Sheepdev\DBAL;

use PDO;

class DBConnection
{
    private string $driver = 'mysql';
    private string $dsn;
    private string $user;
    private string $password;
    public ?PDO $pdo = null;

    public static ?DBConnection $_instance = null;

    public static function getInstance(): DBConnection
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DBConnection();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        $this->dsn = $this->buildDsn();
        $this->pdo = new PDO($this->dsn, $this->user, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function buildDsn(): string
    {
        $this->user = env('DB_USER', '');
        $this->password = env('DB_PASSWORD', '');
        $params = [
            'host=' . env('DB_HOST', 'localhost'),
            'port=' . env('DB_PORT', '3306'),
            'dbname=' . env('DB_NAME', 'demo')
        ];
        return $this->driver . ':' . implode(';', $params);
    }
}