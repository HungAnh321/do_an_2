<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoriesInterface;

interface ProductRepositoryInterface extends RepositoriesInterface
{
    public function getRelateProducts($products, $limit=4);
    public function getFeaturedProductsByCategory(int $categoryId);
    public function getProductOnIndex($request);
    public function getProductsByCategory($categoryName, $request);
    public function getNewProducts($limit=4);
    public function getSales($limit=4);
}
