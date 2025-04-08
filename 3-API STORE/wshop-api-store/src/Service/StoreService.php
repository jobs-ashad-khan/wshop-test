<?php

namespace App\Service;

use App\Exception\ApiInvalidDataException;
use App\Exception\ApiNotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreService
{
    private array $stores = [
        [
            "id" => 1,
            "name" => "Auchan",
            "city" => "Paris"
        ],
        [
            "id" => 2,
            "name" => "Carrefour",
            "city" => "Marseille"
        ],
        [
            "id" => 3,
            "name" => "Leclerc",
            "city" => "Lyon"
        ]
    ];


    /**
     * @throws ApiNotFoundException
     */
    public function getStoreById(int $id): array
    {
        $store = array_find($this->stores, function ($store) use ($id) { return $store['id'] == $id; });
        if (!$store) {
            throw new ApiNotFoundException("Store not found");
        }

        return $store;
    }

    public function getStores(): array
    {
        return $this->stores;
    }

    /**
     * @throws ApiInvalidDataException
     */
    public function createStore(array $data): array
    {
        if (!isset($data['name']) || !isset($data['city'])) {
            throw new ApiInvalidDataException("Name and city are required");
        }

        $store["name"] = $data["name"];
        $store["city"] = $data["city"];

        $maxId = max(array_column($this->stores, "id"));
        $store = ["id" => $maxId+1, ...$store];

        return $store;
    }

    /**
     * @throws ApiNotFoundException
     */
    public function updateStore(int $id, array $data): array
    {
        $store = $this->getStoreById($id);

        if (isset($data["name"])) {
            $store["name"] = $data["name"];
        }

        if (isset($data["city"])) {
            $store["city"] = $data["city"];
        }

        return $store;
    }

    public function deleteStore(int $id): void
    {
        $storeKey = array_find_key($this->stores, function ($store) use ($id) { return $store['id'] == $id; });
        unset($this->stores[$storeKey]);
        $this->stores = array_values($this->stores);
    }
}