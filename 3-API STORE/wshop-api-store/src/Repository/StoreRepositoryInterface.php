<?php

namespace App\Repository;

interface StoreRepositoryInterface
{
    public function findAll(array $params = []): array;

    public function find(int $id): ?array;

    public function create(array $data): int;

    public function update(int $id, array $data): void;

    public function delete(int $id): void;
}