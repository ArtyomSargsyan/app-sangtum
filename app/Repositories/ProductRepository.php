<?php

namespace App\Repositories;


use App\Models\Product;
class ProductRepository
{
    /**
     * @param string $name
     * @param string $description
     * @param int $price
     * @param int $userId
     * @return string
     */
    public function store(string $name, string $description, int $price, int $userId): string
    {

        return Product::create([
            "name" => $name,
            "description" => $description,
            "price" => $price,
           // "userId" => $userId
        ]);
    }


}
