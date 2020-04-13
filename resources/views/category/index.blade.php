@extends('layouts.app')

@section('content')
 <div class="d-flex justify-content-end m-2">  
    <a href="/categories/new" class="btn btn-success">Add Categories</a>
 
  </div>
    
        <div class="card card-default">
          <div class="card-header">
            Categories
          </div>

          <div class="card-body">

         <table class="table">
           <thead>
             <th>Name</th>
             <th>Posts</th>
          
            
           
           </thead>
           <tbody>
           @foreach($categories as $category)
             <tr>
                 <td>
                 {{ $category->name }}
                    
                 </td>
                 <td>
                 {{$category->posts->count()}}

                 </td>
                 <td>
                 
                 <a href="/category/show/{{$category->id}}"><img src="https://img.icons8.com/cute-clipart/26/000000/edit.png"/></a>
                  <a  href="/category/delete/{{$category->id}}"><img src="https://img.icons8.com/flat_round/26/000000/delete-sign.png"/></a>
                        
                 
                 </td>
               
             </tr>
             @endforeach
              
                         
               
              
           
           </tbody>

         </table>
    



            <ul class="list-group">
             
            </ul>
          </div>
     
    </div>
 

@endsection