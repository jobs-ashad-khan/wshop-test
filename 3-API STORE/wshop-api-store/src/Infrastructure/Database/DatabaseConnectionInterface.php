<?php

namespace App\Infrastructure\Database;

interface DatabaseConnectionInterface
{
    public function query(string $sql, array $params = []): array;

    public function execute(string $sql, array $params = []): void;

    public function lastInsertId(): int;
}