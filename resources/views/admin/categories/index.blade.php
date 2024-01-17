@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Categories List</h1>

        <a href="{{route('admin.categories.create')}}" class="btn btn-primary my-3"><i class="fa-solid fa-plus"></i> Create new Category</a>

        <div>
            <table class="table table-striped border">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-end px-5 ">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td class="d-flex justify-content-end">
                                <a href="{{route('admin.categories.show', $category->slug)}}" class="btn btn-primary me-2"><i class="fa-solid fa-eye"></i></a>

                                <a href="{{route('admin.categories.edit', $category->slug)}}" class="btn btn-secondary me-2"><i class="fa-solid fa-pen"></i></a>

                                <form action="{{route('admin.categories.destroy', $category->slug)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="cancel-button btn btn-danger" data-item-name="{{$category->name}}"><i class="fa-solid fa-trash"></i></button>
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
