<?php

namespace App\Sevice\Blogs;

use App\Repositories\Blogs\BlogsRepositoryInterface;
use App\Sevice\BaseSevice;

class BlogsSevice extends BaseSevice implements BlogsSeviceInterface
{
    public $repository;

    public function __construct(BlogsRepositoryInterface $blogsRepository)
    {
        $this->repository = $blogsRepository;
    }

    public function getLatestBlogs($limit = 6)
    {
        return $this->repository->getLatestBlogs($limit);
    }
}
