<?php

namespace App\Http\Controllers\Font;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Sevice\Brand\BrandSeviceInterface;
use App\Sevice\Product\ProductSeviceInterface;
use App\Sevice\ProductCategory\ProductCategorySeviceInterface;
use App\Sevice\ProductComment\ProductCommentSeviceInterface;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $productSevice;
    private $productCommentSevice;
    private $productCategorySevice;
    private $brandSevice;
    public function __construct(ProductSeviceInterface $productSevice,
                                ProductCommentSeviceInterface $productCommentSevice,
                                ProductCategorySeviceInterface $productCategorySevice,
                                BrandSeviceInterface $brandSevice)
    {
        $this->productSevice = $productSevice;
        $this->productCommentSevice = $productCommentSevice;
        $this->productCategorySevice = $productCategorySevice;
        $this->brandSevice = $brandSevice;
    }

    public function show($id){

        $category = $this->productCategorySevice->all();

        $brands  = $this->brandSevice->all();

        $products = $this->productSevice->find($id);
        $relateProducts = $this->productSevice->getRelateProducts($products);

        return view('front.shop.show', compact('products', 'relateProducts', 'category', 'brands'));
    }
    public function postComment(Request $request){
        $this->productCommentSevice->create($request->all());
        return redirect()->back();
    }
    public function index(Request $request){

        $category = $this->productCategorySevice->all();

        $brands  = $this->brandSevice->all();

        $products = $this->productSevice->getProductOnIndex($request);

        return view('front.shop.index', compact('products', 'category', 'brands'));
    }
    public function category($categoryName, Request $request){
        $category = $this->productCategorySevice->all();

        $brands  = $this->brandSevice->all();

        $products = $this->productSevice->getProductsByCategory($categoryName, $request);

        return view('front.shop.index', compact('products', 'category', 'brands'));
    }
    public function man(Request $request){

        $category = $this->productCategorySevice->all();

        $brands  = $this->brandSevice->all();

        $products = $this->productSevice->getProductOnIndex($request);

        $featuredProducts = $this->productSevice->getFeaturedProducs();


        return view('front.shop.man-index', compact(  'category', 'brands', 'featuredProducts', 'products'));
    }
    public function woman(Request $request){

        $category = $this->productCategorySevice->all();

        $brands  = $this->brandSevice->all();

        $featuredProducts = $this->productSevice->getFeaturedProducs();

        $products = $this->productSevice->getProductOnIndex($request);

        return view('front.shop.woman-index', compact('category', 'brands', 'featuredProducts', 'products'));
    }
}
