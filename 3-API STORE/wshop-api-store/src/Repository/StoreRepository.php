<?php

namespace App\Repository;

use App\Infrastructure\Database\DatabaseConnectionInterface;

class StoreRepository implements StoreRepositoryInterface
{
    private DatabaseConnectionInterface $connection;

    public function __construct(DatabaseConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM store";
        return $this->connection->query($sql);
    }

    public function find(int $id): ?array
    {
        $sql = 'SELECT * FROM store WHERE id = :id';
        $result = $this->connection->query($sql, ['id' => $id]);
        return $result[0] ?? null;
    }

    public function create(array $data): int
    {
        $sql = 'INSERT INTO store (name, address, zipcode, city) VALUES (:name, :address, :zipcode, :city)';

        $this->connection->execute(
            $sql,
            [
                'name' => $data['name'],
                'address' => $data['address'],
                'zipcode' => $data['zipcode'],
                'city' => $data['city'],
            ]
        );

        return $this->connection->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $params = ['id' => $id];
        foreach ($data as $key => $value) {
            if (!in_array($key, ['name', 'address', 'zipcode', 'city'])) {
                continue;
            }

            $params[$key] = $value;
        }

        $set = array_map(function ($key) {
            return "{$key} = :{$key}";
        }, array_keys($params));

        $this->connection->execute(
            'UPDATE store SET ' . implode(', ', $set) . ' WHERE id = :id',
            $params
        );
    }

    public function delete(int $id): void
    {
        $this->connection->execute(
            'DELETE FROM store WHERE id = :id',
            ['id' => $id]
        );
    }
}