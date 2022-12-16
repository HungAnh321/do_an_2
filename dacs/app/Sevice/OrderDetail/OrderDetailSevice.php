<?php

namespace App\Sevice\OrderDetail;

use App\Repositories\OrderDetail\OrderDetailRepositoryInterface;
use App\Sevice\BaseSevice;

class OrderDetailSevice extends BaseSevice implements OrderDetailSeviceInterface
{
    public $repository;

    public function __construct(OrderDetailRepositoryInterface $orderDetailRepository)
    {
        $this->repository = $orderDetailRepository;
    }
}
