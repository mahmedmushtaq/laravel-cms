@extends('layouts.app')

@section('content')
<div class="container">
    
            <div class="card">
                <div class="card-header">Add Category</div>

                <div class="card-body">

            
            @include("partial.errors")
                  

                  <form action="/categories/create" method="POST">
                  @csrf
                  
                  <div >
                  <input type="text" name="name" class="form-control" placeholder="Category Name"/>

                  </div>
                  <br/>
                  <div>
                  <Button type="submit" class="btn btn-primary small">Add Category</Button>
                  </div>
                   
                  </form>

                </div>
            </div>
        </div>
  
@endsection
