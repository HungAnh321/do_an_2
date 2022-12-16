<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\BaseRepositories;
use http\Env\Request;

class ProductRepository extends BaseRepositories implements ProductRepositoryInterface
{

    public function getModel()
    {
        return Product::class;
    }
    public function getRelateProducts($products, $limit=4){
        return $this->model->where('product_category_id', $products->product_category_id)
            ->where('tag', $products->tag)
            ->limit($limit)
            ->get();
    }
    public function getFeaturedProductsByCategory(int $categoryId){
        return $this->model->where('featured', true)->where('product_category_id', $categoryId)->get();
    }
    public function getSales($limit=4){
        return $this->model->where('discount', '!=', null)->limit($limit)->get();
    }
    public function getNewProducts($limit=4){
        return $this->model->orderByDesc('id')->limit($limit)->get();
    }
    public function getProductOnIndex($request){
        $perPage = $request->show ?? 6;
        $sortBy = $request->sort_by ?? 'latest';

        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);

        $priceMin = $request->price_min;
        $priceMax = $request->price_max;

        $priceMin = str_replace('','', $priceMin);
        $priceMax = str_replace('','', $priceMax);

        $color = $request->color;



        $search = $request->search ?? '';

        $products = $this->model->where('name', 'like' , '%'. $search . '%');


        $products = $brand_ids != null ? $products->whereIn('brand_id', $brand_ids) : $products;

        $size = $request->size;
        $products = $size != null
            ? $products->whereHas('productDetails', function ($query) use ($size){
                return $query->where('size', $size)->where('qty', '>', 0);
            })
            : $products;

        $products = ($priceMin != null && $priceMax != null) ? $products->whereBetween('price', [$priceMin,$priceMax]) : $products;

        $products = $color != null ? $products->whereHas('productDetails', function ($query) use ($color){
            return $query->where('color', $color)->where('qty', '>', 0);
        }) : $products;

//        $products = $this->sortAndPagination($products, $request);
        switch ($sortBy){
            case 'latest':
                $products = $products->orderBy('id');
                break;
            case 'oldest':
                $products = $products->orderByDesc('id');
                break;
            case 'name_acs':
                $products = $products->orderBy('name');
                break;
            case 'name_dec':
                $products = $products->orderByDesc('name');
                break;
            case 'price_acs':
                $products = $products->orderBy('price');
                break;
            case 'price_dec':
                $products = $products->orderByDesc('price');
                break;
            default:
                $products = $products->orderBy('id');
        }


        $products = $products->paginate($perPage);

        $products->appends(['sort_by'=> $sortBy, 'show' => $perPage]);



        return $products;
    }
    public function getProductsByCategory($categoryName, $request){
        $perPage = $request->show ?? 6;
        $sortBy = $request->sort_by ?? 'latest';

        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);

        $priceMin = $request->price_min;
        $priceMax = $request->price_max;

        $color = $request->color;

        $size = $request->size;


        $priceMin = str_replace('','', $priceMin);
        $priceMax = str_replace('','', $priceMax);

        $products = ProductCategory::where('name', $categoryName)->first()->product->toQuery();


        $products = $brand_ids != null ? $products->whereIn('brand_id', $brand_ids) : $products;

        $products = $size != null
            ? $products->whereHas('productDetails', function ($query) use ($size){
                return $query->where('size', $size)->where('qty', '>', 0);
            })
            : $products;

        $products = ($priceMin != null && $priceMax != null) ? $products->whereBetween('price', [$priceMin,$priceMax]) : $products;

        $products = $color != null ? $products->whereHas('productDetails', function ($query) use ($color){
            return $query->where('color', $color)->where('qty', '>', 0);
        }) : $products;

//        $products = $this->sortAndPagination($products, $request);
        switch ($sortBy){
            case 'latest':
                $products = $products->orderBy('id');
                break;
            case 'oldest':
                $products = $products->orderByDesc('id');
                break;
            case 'name_acs':
                $products = $products->orderBy('name');
                break;
            case 'name_dec':
                $products = $products->orderByDesc('name');
                break;
            case 'price_acs':
                $products = $products->orderBy('price');
                break;
            case 'price_dec':
                $products = $products->orderByDesc('price');
                break;
            default:
                $products = $products->orderBy('id');
        }


        $products = $products->paginate($perPage);

        $products->appends(['sort_by'=> $sortBy, 'show' => $perPage]);



        return $products;
    }
//    private function sortAndPagination($products, Request $request){
//        $perPage = $request->show ?? 3;
//        $sortBy = $request->sort_by ?? 'latest';
//
//        switch ($sortBy){
//            case 'latest':
//                $products = $products->orderBy('id');
//                break;
//            case 'oldest':
//                $products = $products->orderByDesc('id');
//                break;
//            case 'name_acs':
//                $products = $products->orderBy('name');
//                break;
//            case 'name_dec':
//                $products = $products->orderByDesc('name');
//                break;
//            case 'price_acs':
//                $products = $products->orderBy('price');
//                break;
//            case 'price_dec':
//                $products = $products->orderByDesc('price');
//                break;
//            default:
//                $products = $products->orderBy('id');
//        }
//
//
//        $products = $products->paginate($perPage);
//
//        $products->appends(['sort_by'=> $sortBy, 'show' => $perPage]);
//
//        return $products;
//    }
//    private function filter($products, Request $request){
//        //Brand:
//        $brands = $request->brand ?? [];
//        $brand_ids = array_keys($brands);
//        $products = $brand_ids != null ? $products->whereIn('brand_ids', $brand_ids) : $products;
//
//        return $products;
//    }
}
