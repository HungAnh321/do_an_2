<?php

namespace App\Sevice\Product;

use App\Sevice\SeviceInterface;

interface ProductSeviceInterface extends SeviceInterface
{
    public function getRelateProducts($products, $limit=4);
    public function getFeaturedProducs();
    public function getProductOnIndex($request);
    public function getProductsByCategory($categoryName, $request);
}
