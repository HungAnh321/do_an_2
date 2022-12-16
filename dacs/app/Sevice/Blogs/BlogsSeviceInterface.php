<?php

namespace App\Sevice\Blogs;

use App\Sevice\SeviceInterface;

interface BlogsSeviceInterface extends SeviceInterface
{
    public function getLatestBlogs($limit = 6);
}
