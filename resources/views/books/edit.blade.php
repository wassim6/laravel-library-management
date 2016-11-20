@extends('master')

@section('content')
    <h1 class="text-center">{{ $title }}</h1>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('books.update', $book->id) }}" method="post">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="PUT">
                <input type="hidden" name="id" value="{{ $book->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Category Name" value="{{ $book->name }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="description" >{{ $book->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ ($book->category->id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@stop