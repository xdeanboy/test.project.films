<?php

namespace Test\Services\Db;

use Test\Exceptions\DbException;

class Db
{
    private static $instance;
    private $pdo;

    public function __construct()
    {
        try {
            $options = require __DIR__ . '/../../Settings/DbSetting.php';

            $this->pdo = new \PDO(
                'mysql:host=' . $options['host'] . ';dbname=' . $options['dbname'],
                $options['user'],
                $options['password']);

            $this->pdo->exec('SET NAMES UTF8');
        } catch (\PDOException $e) {
            throw new DbException('Помилка підключення до БД: ' . $e->getMessage());
        }
    }

    /**
     * @param string $sql
     * @param $params
     * @param string $className
     * @return array|null
     */
    public function query(string $sql, $params = [], string $className = 'stdClass'): ?array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if ($result === null) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    /**
     * @return static
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return int
     */
    public function getLastInsertId(): int
    {
        return $this->pdo->lastInsertId();
    }
}