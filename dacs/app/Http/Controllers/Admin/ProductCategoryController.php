<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sevice\ProductCategory\ProductCategorySeviceInterface;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    private $productCategorySevice;

    public function __construct(ProductCategorySeviceInterface $productCategorySevice)
    {
        $this->productCategorySevice = $productCategorySevice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $productcategory = $this->productCategorySevice->searchAndPaginate('name', $request->get('search'));

        return view('admin.category.index', compact('productcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
        $this->productCategorySevice->create($data);

        return redirect('admin/category');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productcategory = $this->productCategorySevice->find($id);

        return view('admin.category.edit', compact('productcategory'));
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
        $this->productCategorySevice->update($data, $id);

        return redirect('admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productCategorySevice->delete($id);

        return redirect('admin/category');
    }
}
