<?php

namespace App\Repositories\Blogs;

use App\Repositories\RepositoriesInterface;

interface BlogsRepositoryInterface extends RepositoriesInterface
{
    public function getLatestBlogs($limit=6);
}
