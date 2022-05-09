<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view("pages.products.index", compact("products"));
    }

    public function getProductByCategory($id)
    {
        $page = "product";
        $products = Product::where("category_id", $id)->get();
        return view("pages.products.index", compact("products", "page"));
    }

    public function getProductSortBy($sortBy)
    {
        $page = "product";
        $products = Product::orderBy($sortBy, "desc")->get();
        return view("pages.products.index", compact("products", "page"));
    }

    public function getProductSearch(Request $request)
    {
        $search = $request->search;
        $page = "product";
        $products = Product::where("name", "LIKE", "%" . $search . "%")->get();
        return view("pages.products.index", compact("products", "page"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("pages.products.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|numeric',
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'photo' => 'nullable|max:255',
            'link' => 'nullable|max:255'
        ]);

        $products = new Product();
        $products->category_id = $request->category_id;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->photo = $request->photo;
        $products->link = $request->link;
        $products->save();

        return redirect()
            ->route("product.index")
            ->with("success", "Product created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = "product";
        $products = Product::findOrFail($id);
        return view("pages.products.show", compact("products", "page"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view("pages.products.edit", compact("product"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'id' => 'required|number',
            'category_id' => 'required|number',
            'name' => 'required|max:100',
            'price' => 'required|number',
            'photo' => 'nullable|max:255',
            'link' => 'nullable|max:255'
        ]);

        $products = new Product();
        $products->id = $request->id;
        $products->category_id = $request->category_id;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->photo = $request->photo;
        $products->link = $request->link;
        $products->update();

        // $request->validate([
        //     "name" => "required",
        //     "detail" => "required",
        // ]);

        // $product->update($request->all());

        return redirect()
            ->route("products.index")
            ->with("success", "Product updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $id)
    {
        $products = new Product();
        $products->id = $request->id;
        
        $products->delete();

        // $product->delete();
        return redirect()
            ->route("products.index")
            ->with("success", "Product deleted successfully");
    }
}
