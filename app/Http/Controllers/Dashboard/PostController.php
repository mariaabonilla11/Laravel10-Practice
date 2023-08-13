<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\PutPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return redirect(”/post/create”);

        // dd(Category::find(1)->posts);
        $posts = Post::paginate(2);
        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        #$categories = Category::get();
        $categories = Category::pluck('id', 'title');
        
        echo view('dashboard.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
        #dd($request->all);
        #Post::create($data);
        #dd($request->all());
        $validated = $request->validate(StorePostRequest::myRules());
        
        #$validated = Validator::make($request->all(), StorePostRequest::myRules());
        #dd($validated->fails());
        #dd($validated->errors());   

        $data = array_merge($request->all(), ['image' => '']);
        #dd($data);
        #dd($request->validated()['slug']);


        Post::create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view("dashboard.post.show", compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id', 'title');
        echo view('dashboard.post.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutPostRequest $request, Post $post)
    {
        
        //
        $data = $request->validated();
        if (isset($data['image'])){

            $data['image'] = $filename = time().".".$data['image']->extension();
            // dd($request->validated()['image']); UploadedFile
            //dd($request->validated()['image']->getClientOriginalName()); // nombre con letras
            $request->image->move(public_path("image"), $filename);
        }   
        #dd($request->validated()); aqui se puede validar en el request
        $post->update($data);
        $request->session()->flash('status',"Registro actualizado.");
        return to_route("post.index")->with('status',"Registro actualizado.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        //echo "Destroy";
        $post->delete();
        return to_route("post.index");
    }
}