<?php
namespace App\Core;

abstract class Model
{
    protected static string $table;
    protected static string $primaryKey = 'id';

    public static function getDb(): Database
    {
        return Database::getInstance();
    }

    public static function all(string $orderBy = 'id DESC', ?int $limit = null): array
    {
        $sql = "SELECT * FROM " . static::$table . " ORDER BY " . $orderBy;
        if ($limit !== null) {
            $sql .= " LIMIT " . (int)$limit;
        }
        return static::getDb()->fetchAll($sql);
    }

    public static function find($id): ?array
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE " . static::$primaryKey . " = :id LIMIT 1";
        return static::getDb()->fetch($sql, ['id' => $id]);
    }

    public static function where(string $column, $value, string $orderBy = 'id DESC'): array
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE {$column} = :val ORDER BY " . $orderBy;
        return static::getDb()->fetchAll($sql, ['val' => $value]);
    }

    public static function firstWhere(string $column, $value): ?array
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE {$column} = :val LIMIT 1";
        return static::getDb()->fetch($sql, ['val' => $value]);
    }

    public static function create(array $data): int
    {
        $data['created_at'] = $data['created_at'] ?? date('Y-m-d H:i:s');
        $data['updated_at'] = $data['updated_at'] ?? date('Y-m-d H:i:s');
        return static::getDb()->insert(static::$table, $data);
    }

    public static function update($id, array $data): int
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return static::getDb()->update(
            static::$table,
            $data,
            static::$primaryKey . " = :target_id",
            ['target_id' => $id]
        );
    }

    public static function delete($id): int
    {
        return static::getDb()->delete(
            static::$table,
            static::$primaryKey . " = :target_id",
            ['target_id' => $id]
        );
    }

    public static function count(string $where = '1=1', array $params = []): int
    {
        $sql = "SELECT COUNT(*) as total FROM " . static::$table . " WHERE " . $where;
        $res = static::getDb()->fetch($sql, $params);
        return (int)($res['total'] ?? 0);
    }
}
