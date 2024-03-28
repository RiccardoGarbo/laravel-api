@extends('layouts.app')
@section('title', 'Project Details')
@section('content')
<div class="card">
    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
    <div class="card-body">
        <h5 class="card-title">{{$project->title}}</h5>      
        <span>{{$project->type->label}}</span>
        @forelse ($project->technologies as $technology)
        <span class="badge text-bg-{{$technology->color}}">{{$technology->label}}</span>
            
        @empty
            
        @endforelse
        <p class="card-text">{{$project->content}}</p>
        <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Go to projects</a>

       </div>
   </div>
@endsection