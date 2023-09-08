@extends('layouts.page')

@section("title", isset($data) ? "Edit post ID {$data->id}" : "Add new Entry")

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ isset($data) ? "Edit post ID {$data->id}" : "Add new Entry" }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route("permissions.index") }}">Permissions</a></li>
          <li class="breadcrumb-item active">{{ isset($data) ? "Edit post ID {$data->id}" : "Add new Entry" }}</li>
        </ol>
      </div>
    </div>
</div>
@stop

@section("content")
<div class="container-fluid">
    <form action="@if(isset($data)) {{ route('permissions.update', $data->id) }} @else {{ route('permissions.store') }} @endif" method="POST">
        @csrf
        @if (isset($data))
            @method("PUT")
        @endif
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Permission name</label>
                            <input type="text" class="form-control @error('name') border-red-500 @enderror" name="name" id="name" @if(old('name')) value="{{ old('name') }}" @elseif(isset($data)) value="{{ $data->name }}" @endif>
                        </div>
                        @error('name')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                        <div class="form-group">
                            <label>Roles for Permission:</label>
                            @if (isset($roles))
                            @foreach ($roles as $key => $value)
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" name="roles[]" type="checkbox" id="customCheckbox{{$key}}" @if(old('roles')) @foreach(old('roles') as $val) @if($val == $value->id) checked @endif @endforeach @elseif(isset($data)) @foreach($data->roles as $val) @if($val->name == $value->name) checked @endif @endforeach @endif value="{{ $value->id }}">
                                <label for="customCheckbox{{$key}}" class="custom-control-label">{{ $value->name }}</label>
                            </div>
                            @endforeach
                            @endif
                        </div>
                        @error('roles')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </form>
</div>
@endsection
