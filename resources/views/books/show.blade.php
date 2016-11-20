@extends('master')

@section('content')
    <h1 class="text-center">{{ $title }}</h1>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $book->name  }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $book->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    <option value="{{ $book->category->id }}">{{ $book->category->name }}</option>
                </select>
            </div>
            <div class="form-group">
                <a href="{{ route('books.index') }}" class="btn btn-primary">Return to list</a>
            </div>
        </div>
    </div>
@stop