<?php

namespace App\Http\Controllers\Font;

use App\Http\Controllers\Controller;
use App\Sevice\Blogs\BlogsSeviceInterface;
use App\Sevice\Product\ProductSeviceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $productSevice;
    private $blogsSevice;
    public function __construct(ProductSeviceInterface $productSevice, BlogsSeviceInterface $blogsSevice)
    {
        $this->productSevice = $productSevice;
        $this->blogsSevice = $blogsSevice;
    }

    public function index(){

        $featuredProducts = $this->productSevice->getFeaturedProducs();

        $blogs = $this->blogsSevice->getLatestBlogs();

        return view('front.index', compact('featuredProducts', 'blogs'));
    }
    public function blogs(){
        $blogs = $this->blogsSevice->getLatestBlogs();


        return view('front.blogs.blogs', compact( 'blogs'));
    }
    public function blog_details($id){

        $blog_details = $this->blogsSevice->find($id);

        $blog = $this->blogsSevice->getLatestBlogs($blog_details);

        return view('front.blogs.blog-details', compact('blog', 'blog_details'));
    }
}
