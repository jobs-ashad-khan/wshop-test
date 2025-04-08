<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StoreController
{
    const STORES = [
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

    public function list(): Response
    {
        return new JsonResponse(["stores" => self::STORES]);
    }

    public function read(int $id): Response
    {
        $store = array_find(self::STORES, function ($store) use ($id) { return $store['id'] == $id; });

        return new JsonResponse(["store" => $store]);
    }
}