<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\PutCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return redirect(”/category/create”);

        // dd(Category::find(1)->categories);
        $categories = Category::paginate(2);
        return view('dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        #$categories = Category::get();
        $category = new Category();
        echo view('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {

        Category::create($request->validated());
        return to_route("category.index")->with('status', "Registro creado.");
    }

    /**
     * Display the specified resource.
     */
    
    public function show(Category $category)
    {
        //
        return view("dashboard.category.show", compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories = Category::pluck('id', 'title');
        echo view('dashboard.category.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutCategoryRequest $request, Category $category)
    {
    
        #dd($request->validated()); aqui se puede validar en el request
        $category->update($request->validated());
        return to_route("category.index")->with('status',"Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
        //echo "Destroy";
        $category->delete();
        return to_route("category.index")->with('status',"Registro eliminado.");
    }
}