@extends('layouts.app')

@section('content')
 <div class="d-flex justify-content-end m-2">  
    <a href="{{route('posts.create')}}"  class="btn btn-success">Add Posts</a>
 
  </div>
    
        <div class="card card-default">
          <div class="card-header">
            Posts
          </div>

          <div class="card-body">

         <table class="table">
         <thead>
         
         <th>Image</th>
         <th>Title</th>
         <th>Category</th>
         </thead>
            
            @foreach($posts as $post) 
            <tr>
             
           
              <td><img width="50" height="50" src="{{asset('/storage/'. $post->image)}}" alt=""></td>
 
              <td>{{$post->title}}</td>
              <td>{{$post->category->name}}</td>
              @if(!$post->trashed())
              <td><a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">Edit</a></td>
              @else
              <td><a href="{{route('restore-post',$post->id)}}" class="btn btn-info btn-sm"> Restore</a></td>
              @endif
              <td>
              
              <form action="{{route('posts.destroy',$post->id)}}" method="POST">
              @csrf
              @method("DELETE")
              <Button type="submit" class="btn btn-danger btn-sm">
              @if(!$post->trashed())
                 Trash
              @else Delete
              @endif
              
              </Button>

              </form>
              
              
              
              
              
              </td>
              
              </tr>  
            @endforeach    
                

         </table>
    



            <ul class="list-group">
             
            </ul>
          </div>
     
    </div>
 

@endsection