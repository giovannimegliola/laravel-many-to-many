@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Create new Project</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('admin.projects.store')}}" enctype="multipart/form-data" method="POST">
            @csrf

            <div class="mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
                    required maxlength="200" minlength="3" value="{{old('title')}}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id">Select Category</label>
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                     <option value="">Select a category</option>
                     @foreach ($categories as $category)
                     <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }} </option>
                     @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="body">Body</label>
                <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" cols="30" rows="10">
                    {{old('body')}}
                </textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div class="form-group">
                    <h6>Select Technologies</h6>
                    @foreach ($technologies as $technology)
                    <div class="form-check @error('technologies') is-invalid @enderror">
                        <input type="checkbox" class="form-check-input" name="technologies[]" value="{{$technology->id}}" {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }} >
                        <label class="form-check-label">
                            {{$technology->name}}
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="me-3">
                <img id="uploadPreview" width="100" src="https://via.placeholder.com/300x200" >
            </div>

            <div class="mb-3">
                <label for="image">Image</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" value="{{old('image')}}">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-secondary ">Reset</button>

        </form>
    </section>
@endsection
