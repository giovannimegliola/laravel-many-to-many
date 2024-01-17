@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>{{$technology->name}}</h1>
        <h3>Project List</h3>

        <ul>
            @forelse ($technology->projects as $project)
                <li> {{$project->title}}</li>
            @empty
                <li>No projects</li>
            @endforelse
        </ul>

    </section>
@endsection
