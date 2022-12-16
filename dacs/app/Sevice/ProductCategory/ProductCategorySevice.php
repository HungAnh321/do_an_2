<?php

namespace App\Sevice\ProductCategory;

use App\Repositories\ProductCategory\ProductCategoryRepositoryInterface;
use App\Sevice\BaseSevice;

class ProductCategorySevice extends BaseSevice implements ProductCategorySeviceInterface
{
    public $repository;
    public function __construct(ProductCategoryRepositoryInterface $productCategoryRepository)
    {
        $this->repository = $productCategoryRepository;
    }

}
