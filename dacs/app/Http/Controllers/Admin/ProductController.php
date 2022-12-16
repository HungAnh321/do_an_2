<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sevice\Brand\BrandSeviceInterface;
use App\Sevice\Product\ProductSeviceInterface;
use App\Sevice\ProductCategory\ProductCategorySeviceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productSevice;
    private $productCategorySevice;
    private $brandSevice;

    public function __construct(ProductSeviceInterface $productSevice, ProductCategorySeviceInterface $productCategorySevice,
                                BrandSeviceInterface $brandSevice)
    {
        $this->productSevice = $productSevice;
        $this->productCategorySevice = $productCategorySevice;
        $this->brandSevice = $brandSevice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->productSevice->searchAndPaginate('name', $request->get('search'));
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $brands = $this->brandSevice->all();
        $productCategory = $this->productCategorySevice->all();

        return view('admin.product.create', compact('brands', 'productCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['qty'] = 0;
        $product = $this->productSevice->create($data);

        return redirect('admin/product/'.$product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $product = $this->productSevice->find($id);

        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productSevice->find($id);

        $brands = $this->brandSevice->all();
        $productCategory = $this->productCategorySevice->all();

        return view('admin.product.edit', compact('product', 'brands', 'productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->productSevice->update($data, $id);

        return redirect('admin/product/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productSevice->delete($id);

        return redirect('admin/product');
    }
}
