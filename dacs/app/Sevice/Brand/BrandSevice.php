<?php

namespace App\Sevice\Brand;

use App\Repositories\Brand\BrandRepositoryInterface;
use App\Sevice\BaseSevice;

class BrandSevice extends BaseSevice implements BrandSeviceInterface
{
    public $repository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->repository = $brandRepository;
    }
}
