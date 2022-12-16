<?php

namespace App\Sevice\Order;

use App\Sevice\SeviceInterface;

interface OrderSeviceInterface extends SeviceInterface
{
    public function getOrderByUserId($userId);
}
