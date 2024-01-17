@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Projects List</h1>

        <a href="{{route('admin.projects.create')}}" class="btn btn-primary my-3"><i class="fa-solid fa-plus"></i> Create new Project</a>

        <div>
            <table class="table table-striped border">

                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="text-end px-5 ">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{$project->title}}</td>
                            <td class="d-flex justify-content-end">
                                <a href="{{route('admin.projects.show', $project->slug)}}" class="btn btn-primary me-2"><i class="fa-solid fa-eye"></i></a>

                                <a href="{{route('admin.projects.edit', $project->slug)}}" class="btn btn-secondary me-2"><i class="fa-solid fa-pen"></i></a>

                                <form action="{{route('admin.projects.destroy', $project->slug)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cancel-button btn btn-danger" data-item-title="{{$project->title}}"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        @include('profile/partials.modal_delete')
    </section>
@endsection
