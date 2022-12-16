<?php

namespace App\Sevice\User;

use App\Repositories\User\UserRepositoryInterface;
use App\Sevice\BaseSevice;

class UserSevice extends BaseSevice implements UserSeviceInterface
{
    public $repository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->repository = $userRepository;
    }

}
