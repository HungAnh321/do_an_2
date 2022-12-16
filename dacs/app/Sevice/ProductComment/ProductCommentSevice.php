<?php

namespace App\Sevice\ProductComment;

use App\Repositories\ProductComment\ProductCommentRepositoryInterface;
use App\Sevice\BaseSevice;

class ProductCommentSevice extends BaseSevice implements ProductCommentSeviceInterface
{
    public $repository;

    public function __construct(ProductCommentRepositoryInterface $productCommentRepository)
    {
        $this->repository = $productCommentRepository;
    }

}
