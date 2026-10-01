<?php
namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private ?PDO $pdo = null;

    private function __construct()
    {
        $config = require ROOT_PATH . '/config/database.php';
        $default = $config['default'];
        $connConfig = $config['connections'][$default] ?? $config['connections']['sqlite'];

        try {
            if ($default === 'sqlite') {
                $dbPath = $connConfig['database'];
                $dir = dirname($dbPath);
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
                $isNew = !file_exists($dbPath) || filesize($dbPath) === 0;
                $this->pdo = new PDO("sqlite:" . $dbPath);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                $this->pdo->exec("PRAGMA foreign_keys = ON;");

                if ($isNew) {
                    $this->bootstrapSqlite();
                }
            } else {
                $dsn = "mysql:host={$connConfig['host']};port={$connConfig['port']};dbname={$connConfig['database']};charset={$connConfig['charset']}";
                $this->pdo = new PDO($dsn, $connConfig['username'], $connConfig['password'], $connConfig['options'] ?? []);
            }
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->pdo;
    }

    public function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function fetch(string $sql, array $params = []): ?array
    {
        $result = $this->query($sql, $params)->fetch();
        return $result ?: null;
    }

    public function insert(string $table, array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $this->query($sql, $data);
        return (int)$this->pdo->lastInsertId();
    }

    public function update(string $table, array $data, string $where, array $whereParams = []): int
    {
        $fields = [];
        foreach ($data as $col => $val) {
            $fields[] = "{$col} = :update_{$col}";
        }
        $sql = "UPDATE {$table} SET " . implode(', ', $fields) . " WHERE {$where}";
        
        $params = [];
        foreach ($data as $col => $val) {
            $params["update_{$col}"] = $val;
        }
        $params = array_merge($params, $whereParams);
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    public function delete(string $table, string $where, array $params = []): int
    {
        $sql = "DELETE FROM {$table} WHERE {$where}";
        $stmt = $this->query($sql, $params);
        return $stmt->rowCount();
    }

    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }

    private function bootstrapSqlite(): void
    {
        $schemaPath = ROOT_PATH . '/database/schema.sql';
        $seedPath = ROOT_PATH . '/database/seed.sql';
        
        if (file_exists($schemaPath)) {
            $sql = file_get_contents($schemaPath);
            $this->pdo->exec($sql);
        }
        if (file_exists($seedPath)) {
            $sql = file_get_contents($seedPath);
            $this->pdo->exec($sql);
        }
    }
}
