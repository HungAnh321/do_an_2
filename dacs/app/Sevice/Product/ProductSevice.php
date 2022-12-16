<?php

namespace App\Sevice\Product;

use App\Repositories\Product\ProductRepositoryInterface;
use App\Sevice\BaseSevice;

class ProductSevice extends BaseSevice implements ProductSeviceInterface
{
    public $repository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->repository = $productRepository;
    }
    public function find($id)
    {
        $products = $this->repository->find($id);

        $avgRating = 0;
        $sumRating = array_sum(array_column($products->productComments->toArray(), 'rating'));
        $countRating = count($products->productComments);
        if($countRating !=0){
            $avgRating = $sumRating / $countRating;
        }
        $products->avgRating = $avgRating;
        return $products;
    }
    public function getRelateProducts($products, $limit=4){
        return $this->repository->getRelateProducts($products, $limit);
    }
    public function getFeaturedProducs(){
        return[
            "men"=>$this->repository->getFeaturedProductsByCategory(1),
            "women"=>$this->repository->getFeaturedProductsByCategory(2),
            "new" => $this->repository->getNewProducts(),
            "kid" => $this->repository->getFeaturedProductsByCategory(3),
            "sale" => $this->repository->getSales(),
        ];

    }
    public function getProductOnIndex($request){
        return $this->repository->getProductOnIndex($request);
    }
    public function getProductsByCategory($categoryName, $request){
        return $this->repository->getProductsByCategory($categoryName, $request);
    }

}
