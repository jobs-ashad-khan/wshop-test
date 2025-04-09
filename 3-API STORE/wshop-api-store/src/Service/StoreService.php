<?php

namespace App\Service;

use App\Exception\ApiInvalidDataException;
use App\Exception\ApiNotFoundException;
use App\Repository\StoreRepository;
use App\Repository\StoreRepositoryInterface;

class StoreService
{
    private StoreRepositoryInterface $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    /**
     * @throws ApiNotFoundException
     */
    public function getStoreById(int $id): array
    {
        $store = $this->storeRepository->find($id);
        if (!$store) {
            throw new ApiNotFoundException("Store not found");
        }

        return $store;
    }

    public function getStores(array $params = []): array
    {
        return $this->storeRepository->findAll($params);
    }

    /**
     * @throws ApiInvalidDataException
     */
    public function createStore(array $data): array
    {
        if (!isset($data['name']) || !isset($data['address']) || !isset($data['zipcode']) || !isset($data['city'])) {
            throw new ApiInvalidDataException("Cannot create a store: name, address, zipcode and city are required");
        }

        $store["name"] = $data["name"];
        $store["address"] = $data["address"];
        $store["zipcode"] = $data["zipcode"];
        $store["city"] = $data["city"];

        $id = $this->storeRepository->create($store);

        $store = ["id" => $id, ...$store];

        return $store;
    }

    /**
     * @throws ApiNotFoundException
     * @throws ApiInvalidDataException
     */
    public function updateStore(int $id, array $data): array
    {
        if (!isset($data['name']) && !isset($data['address']) && !isset($data['zipcode']) && !isset($data['city'])) {
            throw new ApiInvalidDataException("Cannot update a store: name, address, zipcode or city are required");
        }

        $this->storeRepository->update($id, $data);
        return $this->getStoreById($id);
    }

    public function deleteStore(int $id): void
    {
        $this->storeRepository->delete($id);
    }
}