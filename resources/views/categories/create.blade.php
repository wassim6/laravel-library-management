@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $title }}</div>
                    <div class="panel-body">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        {{ Form::open(['route' => 'categories.store', 'files' => true]) }}
                        <div class="form-group">
                            <label for="">Name</label>
                            {{ Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Product Name']) }}
                        </div>
                        <div class="form-group">
                            <label for="">Picture</label>
                            {{ Form::file('picture', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop