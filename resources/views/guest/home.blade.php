@extends('layouts.app')
@section('content')

<header>
    <h1 class="text-center">Projects</h1>
</header>
<main class="container">
<div class="row">
     @foreach ($projects as $project )       
     <div class="col-6">
         <div class="card">
             <img src="{{ asset('storage/' . $project->image) }}" class="{{$project->title}}" alt="...">
             <div class="card-body">
                 <h5 class="card-title">{{$project->title}}</h5>
                 <p class="card-text">{{$project->content}}</p>
                 <div class="d-flex justify-content-between">
                    <a href="{{route('admin.projects.show' , $project)}}" class="btn btn-primary">Details</a>
                    @auth
                    
                    <form action="{{route('admin.projects.destroy', $project)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input class="btn btn-danger" type="submit" value="Delete">
                    </form>
                    @endauth
                </div> 
                </div>
            </div>
        </div>
        @endforeach
@endsection