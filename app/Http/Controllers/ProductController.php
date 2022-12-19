<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantPrice;
use App\Models\Variant;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::paginate(5);
        $variants = Variant::with(['productVariants' => function($query){
            $query->groupBy('variant');
        }])->groupBy('title')->get();

        return view('products.index')->with(['products' => $products, 'variants' => $variants]);
    }

    public function create()
    {
        $variants = Variant::all();
        return view('products.create', compact('variants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $variants = Variant::all();
        return view('products.edit', compact('variants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function productSearch(Request $request){
        $title                          = $request->title;
        $variant                        = $request->variant;
        $productPriceForm               = $request->price_from;
        $productPriceTo                 = $request->price_to;
        $productDate                    = $request->date;

        $products   = Product::whereHas('productVariantPrices', function ($query) use ($productPriceForm, $productPriceTo){
                $query->whereBetween('product_variant_prices.price',[$productPriceForm, $productPriceTo]);
            })
            ->when($title, function($query, $title) {
                $query->where('title', 'LIKE', '%'.$title.'%');
            })
            ->when($productDate, function ($query, $productDate){
                $query->where('created_at', '<=' ,$productDate );
            })
            ->paginate(5);

        $variants = Variant::with('productVariants')->get();

        return view('products.index', [
            'products' => $products,
            'variants' => $variants
        ]);
    }
}
