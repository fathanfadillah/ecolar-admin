<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = "category";
        $categories = Category::all();

        return view("pages.categories.index", compact("categories", "page"));
    }

    // public function getProductByCategory($id)
    // {
    //     $page = "product";
    //     $products = Product::where("category_id", $id)->get();
    //     return view("pages.products.index", compact("products", "page"));
    // }

    // public function getProductSortBy($sortBy)
    // {
    //     $page = "product";
    //     $products = Product::orderBy($sortBy, "desc")->get();
    //     return view("pages.products.index", compact("products", "page"));
    // }

    // public function getProductSearch(Request $request)
    // {
    //     $search = $request->search;
    //     $page = "product";
    //     $products = Product::where("name", "LIKE", "%" . $search . "%")->get();
    //     return view("pages.products.index", compact("products", "page"));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = "categories";
        return view("pages.categories.create", compact("page"));
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
            'name' => 'required|max:100'
        ]);

        $categories = new Category();
        $categories->name = $request->name;
        $categories->save();

        return redirect()
            ->route("category/index")
            ->with("success", "Category created successfully.");
    }

    public function show($id)
    {
        $page = "categories";
        $categories = Category::findOrFail($id);
        return view("pages.categories.show", compact("categories", "page"));
    }

    public function edit(Category $category)
    {
        $page = "categories";
        $categories = Category::findOrFail($id);
        return view("pages.categories.edit", compact("categories"));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|max:100',
            
        ]);

        $categories = Category::findOrFail($request->id);

        $categories->update([
            'name' => $request->name
        ]);

        return redirect()
            ->route("category/index")
            ->with("success", "Category updated successfully");
    }

    public function destroy(Category $category, $id)
    {
        $categories = new Category();
        $categories->id = $request->id;
        
        $categories->delete();

        return redirect()
            ->route("category/index")
            ->with("success", "Category deleted successfully");
    }
}
