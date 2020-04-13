<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    //
    public function new(){
        return view("category.add");
    }

    public function categories(){
        return view("category.index")->with("categories",Category::all());
    }

    public function create(CreateCategoryRequest $request){
     
         Category::create([
             'name'=>$request->name
         ]);

        session()->flash("success","Category created successfully");

        return redirect("/categories");


    }

    public function edit(UpdateCategoryRequest $request,Category $category){
        
        
        $category->update([
            'name'=>$request->name
        ]);

        session()->flash("success","Category updated successfully");
        return redirect("/categories");


        
    }

    public function show(Category $category){
        
        return view("category.show")->with("category",$category);


        
    }

    public function delete(Category $category){
         

        $category->delete();
        session()->flash("success","Category deleted successfully");
        return redirect("/categories");


        
    }
}
