@extends('layouts.app')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Create Category</h3>

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('categories.update',[$categories->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" class="form-control" value="{{$categories->title}}" name="title" id="exampleInputEmail1" placeholder=".....">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Description</label>
                    <input type="text" class="form-control" value="{{$categories->description}}" name="description" id="exampleInputPassword1"
                        placeholder=".....">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="image" class="form-control-file" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            
                        </div>
                        <img height="80" width="80" src="{{asset('uploads/categories/'. $categories->image)}}">

                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" value="1" {{$categories->status==1? 'checked' : ''}} name="status" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Status</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
