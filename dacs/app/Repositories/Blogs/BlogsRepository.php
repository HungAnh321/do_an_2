<?php

namespace App\Repositories\Blogs;

use App\Models\Blog;
use App\Repositories\BaseRepositories;

class BlogsRepository extends BaseRepositories implements BlogsRepositoryInterface
{

    public function getModel()
    {
        return Blog::class;
    }
    public function getLatestBlogs($limit=6){
        return $this->model->orderBy('id', 'desc')->limit($limit)->get();
    }
}
