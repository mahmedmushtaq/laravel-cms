<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\posts\CreatePostRequest;
use App\Http\Requests\posts\UpdatePostRequest;

use App\Post;
use App\Tag;
use App\Category;

class PostController extends Controller
{

    

 

    public function __construct()
    {
    $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("posts.index")->with("posts",Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        return view("posts.create")->with("categories",Category::all())->withTags(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        //

        // dd($request->tags);
      

       
        $image = $request->image->store('posts');
        
       $post =  Post::create([
            'title' => $request->title,
            'description' =>$request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at'=>$request->published_at,
            'category_id'=>$request->category,
            'user_id' => auth()->user()->id
          
             
          ]);

          if ($request->tags) {
            $post->tags()->attach($request->tags);
          }

       


            // flash message
        session()->flash('success', 'Post created successfully.');
        // redirect user

        return redirect(route('posts.index'));
      
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
    public function edit(Post $post)
    {
        //
        return view("posts.create")->withPost($post)->withCategories(Category::all())->withTags(Tag::all());;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //

        $data = $request->only(['title','description','content','published_at','category']);

        if($request->hasFile('image')){

            $image = $request->image->store('posts');
            // delete old one
            $post->deleteImage();
  
            $data['image'] = $image;
        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        
        // update attributes
        $post->update($data);

        // flash message
        session()->flash('success', 'Post updated successfully.');

        // redirect user
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::withTrashed()->where("id",$id)->first();

        if(!$post->trashed())
           $post->delete();
        else {
            $post->deleteImage();
            $post->forceDelete();
        }

        session()->flash("success","Post trashed successfully");

        

        return redirect(route("posts.index"));


    }


/**
     * Recover trashed posts.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //

        // $post->delete();
        // session()->flash("success","Post trashed successfully");

       $posts =  Post::onlyTrashed()->get();

        return view('posts.index')->withPosts($posts);


    }

    public function restore($id){
   
        $post = Post::withTrashed()->where("id",$id)->first();
        $post->restore();
        session()->flash("success","Post restored successfully");
        return redirect()->back();
    }
}
