<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "product";   
        $products = Product::all();
        return view("pages.products.index", compact("products", "page"));
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
        $page = "product";   
        $categories = Category::all();
        return view("pages.products.create", compact("categories", "page"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = "product";   
        $validated = $request->validate([
            'category_id' => 'required|numeric',
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'photo' => 'nullable|max:255|image|mimes:jpg,png,jpeg',
            'link' => 'nullable|max:255'
        ]);

        $products = new Product();
        $products->category_id = $request->category_id;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->photo = $request->photo;
        $products->link = $request->link;

        
        if($request->hasFile('photo')){
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filenameSimpan = $filename.'_'.time().'.png';
            $products->photo = $filenameSimpan;
            $request->file('photo')->storeAs('images', $filenameSimpan, 'public');
        }
        
        $products->save();

        $products = Product::all();
        return redirect()
            ->route("product/index")
            ->with("success", "Product deleted successfully");
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view("pages.products.show", compact("product", "page", "categories"));
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
            'id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'name' => 'required|max:100',
            'price' => 'required|numeric',
            'photo' => 'nullable|max:255',
            'link' => 'nullable|max:255'
        ]);

        $products = Product::findOrFail($request->id);
        $products->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price, 
            'photo' => $request->photo,
            'link' => $request->link
        ]);

        if($request->hasFile('photo')){
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filenameSimpan = $filename.'_'.time().'.png';
            $products->photo = $filenameSimpan;
            $request->file('photo')->storeAs('images', $filenameSimpan, 'public');
        }

        if(File::exists(public_path('images/'.$products->photo))){
            File::delete(public_path('images/'.$products->photo));
        }
       
       return redirect()
            ->route("product/index")
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
        $page = "product";      
        $products = Product::findOrFail($id);

        if(File::exists(public_path('images/'.$products->photo))){
            File::delete(public_path('images/'.$products->photo));
        }
        
        $products->delete();
        
        $products = Product::all();
        
        return redirect()
            ->route("product/index")
            ->with("success", "Product deleted successfully");
    }
}
