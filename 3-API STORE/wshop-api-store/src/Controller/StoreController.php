<?php

namespace App\Controller;

use App\Framework\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreController
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

    #[Route(path: '/stores', name: 'list_stores', methods: ['GET'])]
    public function list(): Response
    {
        return new JsonResponse(["stores" => $this->stores]);
    }

    #[Route(path: '/stores', name: 'create_store', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $store = [];

        $data = json_decode($request->getContent(), true);
        if (isset($data["name"])) {
            $store["name"] = $data["name"];
        }

        if (isset($data["city"])) {
            $store["city"] = $data["city"];
        }

        if (empty($store)) {
            return new JsonResponse(["message" => "Cannot add new store."], Response::HTTP_BAD_REQUEST);
        }

        $maxId = max(array_column($this->stores, "id"));
        $store["id"] = $maxId + 1;

        $this->stores[] = $store;

        return new JsonResponse(["store" => $store], Response::HTTP_CREATED);
    }

    #[Route(path: '/stores/{id}', name: 'read_store', methods: ['GET'])]
    public function read(int $id): Response
    {
        $store = array_find($this->stores, function ($store) use ($id) { return $store['id'] == $id; });

        return new JsonResponse(["store" => $store]);
    }

    #[Route(path: '/stores/{id}', name: 'update_store', methods: ['PUT', 'PATH'])]
    public function update(int $id, Request $request): Response
    {
        $store = array_find($this->stores, function ($store) use ($id) { return $store['id'] == $id; });
        if (!$store) {
            return new JsonResponse(["message" => "Store not found"], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        if (isset($data["name"])) {
            $store["name"] = $data["name"];
        }

        if (isset($data["city"])) {
            $store["city"] = $data["city"];
        }

        return new JsonResponse(["store" => $store]);
    }

    #[Route(path: '/stores/{id}', name: 'delete_store', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $storeKey = array_find_key($this->stores, function ($store) use ($id) { return $store['id'] == $id; });
        unset($this->stores[$storeKey]);
        $this->stores = array_values($this->stores);

        return new JsonResponse([]);
    }
}