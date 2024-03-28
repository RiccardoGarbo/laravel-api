@extends('layouts.app')


@section('title', 'Projects')

@section('content')

<header class="container">
    <div class="d-flex justify-content-between align-items-center">
    <h1 class="text-center">Projects</h1>
    <a class="btn btn-success text-align-center" href="{{route('admin.projects.create')}}">Create new project!</a>
</div>
</header>
<main class="container">

    <table class="table ">
        <thead>
            <tr>
                <th scope="col">Title</th>    
                <th scope="col">Type</th>              
                <th scope="col">Technology</th>              
                <th scope="col">Description</th>              
                <th scope="col">Image</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th>Console</th>
            </tr>
        </thead>
        @foreach ($projects as $project )       
        <tbody>
          <tr>
            <th scope="row">{{$project->title}}</th>
            <td>{{$project->content}}</td>
            <td> 
              @forelse ($project->technologies as $technology)
              <span class="badge text-bg-{{$technology->color}}">{{$technology->label}}</span>  
              @empty
                Nessuna
              @endforelse
            </td>
            <td>{{$project->content}}</td>
            <td>{{ asset('storage/' . $project->image) }}</td>
            <td>{{$project->created_at}}</td>
            <td>{{$project->updated_at}}</td>
            <td>
            <div class="d-flex gap-2"> 
              <a href="{{route('admin.projects.show' , $project)}}" class="btn btn-primary">Details</a>
              <a class="btn btn-warning" href="{{route('admin.projects.edit', $project)}}">Edit</a>
              <form id="delete-form" action="{{route('admin.projects.destroy', $project)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <input class="btn btn-danger" type="submit" value="Delete">
                  </form>
              </div>
            </td>
         </tr>
        </tbody>
        @endforeach
      </table>
</main>

@endsection
@section('scripts')
<script>

const deleteForm = document.getElementById('delete-form');
deleteForm.addEventListener('submit', e => {
e.preventDefault();

const confirmation = confirm('Vuoi eliminare questo progetto?');
if(confirmation ) deleteForm.submit();


});


</script>

@endsection
