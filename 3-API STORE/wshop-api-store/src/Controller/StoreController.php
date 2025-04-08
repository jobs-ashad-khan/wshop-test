<?php

namespace App\Controller;

use App\Exception\ApiInvalidDataException;
use App\Exception\ApiNotFoundException;
use App\Framework\Attribute\Route;
use App\Service\StoreService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StoreController
{
    private StoreService $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    #[Route(path: '/stores', name: 'list_stores', methods: ['GET'])]
    public function list(): Response
    {
        $stores = $this->storeService->getStores();
        return new JsonResponse(["stores" => $stores]);
    }

    /**
     * @throws ApiInvalidDataException
     */
    #[Route(path: '/stores', name: 'create_store', methods: ['POST'])]
    public function create(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $store = $this->storeService->createStore($data);

        return new JsonResponse(["store" => $store], Response::HTTP_CREATED);
    }

    /**
     * @throws ApiNotFoundException
     */
    #[Route(path: '/stores/{id}', name: 'read_store', methods: ['GET'])]
    public function read(int $id): Response
    {
        $store = $this->storeService->getStoreById($id);

        return new JsonResponse(["store" => $store]);
    }

    /**
     * @throws ApiNotFoundException
     */
    #[Route(path: '/stores/{id}', name: 'update_store', methods: ['PUT', 'PATH'])]
    public function update(int $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $store = $this->storeService->updateStore($id, $data);

        return new JsonResponse(["store" => $store]);
    }

    #[Route(path: '/stores/{id}', name: 'delete_store', methods: ['DELETE'])]
    public function delete(int $id): Response
    {
        $this->storeService->deleteStore($id);

        return new JsonResponse([]);
    }
}