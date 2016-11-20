@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $title }}</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <a href="{{ route('categories.create') }}" class="btn btn-primary">New Category</a>
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Picture</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $c)
                                <tr>
                                    <td>{{ $c->id }}</td>
                                    <td>{{ $c->name }} </td>
                                    <td><img src="../uploads/categories/{{ $c->picture }}" alt="{{ $c->name }}" style="height: 60px; width: auto;"></td>
                                    <td>
                                        <a href="{{ route('categories.edit', $c->id) }}" class="btn btn-default btn-xs">Edit</a>
                                        {{ Form::open(['route' => ['categories.destroy', $c->id], 'class' => 'form-delete', 'method' => 'DELETE']) }}
                                        <button class="btn btn-xs btn-danger">Delete</button>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    <script>
        $(function(){
            $('.form-delete').submit(function(e){
                if(!confirm('Are you sure to delete this item?')){
                    e.preventDefault();
                }
            });
        })
    </script>
@stop