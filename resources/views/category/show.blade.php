@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Category</div>

                <div class="card-body">

                @if($errors->any())
                <div class="alert alert-danger">
                 <ul class="list-group">
                   @foreach($errors->all() as $error)
                     <li class="list-group-item">{{$error}}</li>
                   @endforeach   
                   </ul>
                   </div>
                @endif
                  

                  <form action="/category/edit/{{$category->id}}" method="POST">
                  @csrf
                  
                  <div >
                  <input type="text" name="name" class="form-control" value="{{$category->name}}" placeholder="Category Name"/>

                  </div>
                  <br/>
                  <div>
                  <Button type="submit" class="btn btn-primary small">Update Category</Button>
                  </div>
                   
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection