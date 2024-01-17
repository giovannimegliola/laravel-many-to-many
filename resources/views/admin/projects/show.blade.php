@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>{{$project->title}}</h1>

        @if($project->category_id)
                <div class="mb-3">
                    <h4>Category</h4>
                    <a class="badge text-bg-secondary text-decoration-none" href="{{route('admin.categories.show', $project->category->slug)}}">{{$project->category->name}}</a>
                </div>
        @endif

        <p class="mt-4">{{$project->body}}</p>

        <img src="{{ asset('storage/' . $project->image)}}" alt="{{$project->title}}" class="w-50 my-3">

        @if (count($project->technologies) > 0)
        <div class="mb-3">
            <h4>Technologies</h4>
            @foreach ($project->technologies as $technology)
            <a class="badge rounded-pill text-bg-success text-decoration-none" href="{{route('admin.technologies.show', $technology->slug)}}">{{$technology->name}}</a>
            @endforeach
        </div>
        @endif

        <div class="my-3">
            <a href="{{route('admin.projects.edit', $project->slug)}}" class="btn btn-primary me-2"><i class="fa-solid fa-pen"></i> Edit Project</i></a>
        </div>

    </section>
@endsection
