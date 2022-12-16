<?php

namespace App\Sevice\Order;

use App\Models\OrderDetail;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Sevice\BaseSevice;

class OrderSevice extends BaseSevice implements OrderSeviceInterface
{
    public $repository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->repository = $orderRepository;
    }

    public function getOrderByUserId($userId)
    {
        return $this->repository->getOrderByUserId($userId);
    }
}
