@extends('master')

@section('content')
    <h1 class="text-center">{{ $title }}</h1>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Slug</th>
            <th>Description</th>
            <th>Remove from favorite</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->name }}</td>
                @if($book->category)
                    <td>{{ $book->category->name }}</td>
                @else
                @endif
                <td>{{ $book->slug }}</td>
                <td>{{ $book->description }}</td>
                <td>
                    <a href="{{ route('removefavorite', $book->id) }}" class="btn btn-xs btn-default">
                        <i class="glyphicon glyphicon-trash" style="color:red;" ></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop

@section('scripts')

@stop