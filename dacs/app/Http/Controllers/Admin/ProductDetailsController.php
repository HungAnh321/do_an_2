<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductDetail;
use App\Sevice\Product\ProductSeviceInterface;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    private $productSevice;

    public function __construct(ProductSeviceInterface $productSevice)
    {
        $this->productSevice = $productSevice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {

        $product = $this->productSevice->find($product_id);

        $productDetails = $product->productDetails;

        return view('admin.product.details.index', compact('product', 'productDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        $product = $this->productSevice->find($product_id);

        return view('admin.product.details.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $product_id)
    {
        $data = $request->all();

        ProductDetail::create($data);

        $this->updateQty($product_id);

        return redirect('admin/product/'.$product_id.'/details');

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
    public function edit($product_id, $product_detail_id)
    {
        $product = $this->productSevice->find($product_id);
        $productDetails = ProductDetail::find($product_detail_id);

        return view('admin.product.details.edit', compact('product', 'productDetails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id, $product_detail_id)
    {
        $data = $request->all();

        ProductDetail::find($product_detail_id)->update($data);

        $this->updateQty($product_id);

        return redirect('admin/product/'.$product_id.'/details');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id, $product_detail_id)
    {
        ProductDetail::find($product_detail_id)->delete();

        return redirect('admin/product/'.$product_id.'/details');
    }
    public function updateQty($product_id){
        $product = $this->productSevice->find($product_id);

        $productDetails = $product->productDetails;

        $totalQty = array_sum(array_column($productDetails->toArray(), 'qty'));

        $this->productSevice->update(['qty' => $totalQty], $product_id);
    }
}
