@extends('master')

@section('content')
    <h1 class="text-center">{{ $title }}</h1>

    <div class="form-group">
        <a href="{{ route('books.create') }}" class="btn btn-primary">New Book</a>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Category</th>
            <th>Slug</th>
            <th>Description</th>
            <th></th>
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
                    <td>-</td>
                @endif
                <td>{{ $book->slug }}</td>
                <td>{{ $book->description }}</td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-pencil"></i></a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="post" class="form-delete">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $books->links() }}
@stop

@section('scripts')
    <script>
        $(function () {
            $('.form-delete').submit(function (e) {
                if (!confirm('Message X!!')) {
                    e.preventDefault();
                }
            })
        })
    </script>
@stop