@extends('layouts.page')

@section('title', isset($data) ? "Edit Admin" : "Add new Admin")

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{ isset($data) ? "Edit Admin" : "Add new Admin" }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route("dashboard") }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route("admins.index") }}">Admins</a></li>
            <li class="breadcrumb-item active">{{ isset($data) ? "Edit Admin " : "Add new Admin" }}</li>
        </ol>
      </div>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <form action="@if(isset($data)) {{ route('admins.update', $data->id) }} @else {{ route('admins.store') }} @endif" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($data))
        @method("PUT")
    @endif
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Admin data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
                <div class="form-group">
                    <label for="fullname">Fullname</label>
                    <input type="text" class="form-control @error('fullname') border-red-500 @enderror" name="fullname" id="fullname" @if(old('fullname')) value="{{ old('fullname') }}" @elseif(isset($data)) value="{{ $data->fullname }}" @endif>
                </div>
                @error('fullname')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                    </div>
                    <input type="text" class="form-control @error('username') border-red-500 @enderror" name="username" id="username" @if(old('username')) value="{{ old('username') }}" @elseif(isset($data)) value="{{ $data->username }}" @endif>
                    </div>
                </div>
                @error('username')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div class="form-group">
                    <label for="password">{{ isset($data) ? "New Password" : "Password" }}</label>
                    <input type="password" class="form-control @error('password') border-red-500 @enderror" name="password" id="password">
                </div>
                @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div class="form-group">
                    <label for="password_confirmation">Password confirmation</label>
                    <input type="password" class="form-control @error('password_confirmation') border-red-500 @enderror" name="password_confirmation" id="password_confirmation">
                </div>
                @error('password')
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

        <!-- right column -->
        <div class="col-md-6">
        <!-- Form Element sizes -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Additionally</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Roles for User:</label>
                    @if (isset($roles))
                    @foreach ($roles as $key => $value)
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="roles[]" type="checkbox" id="customCheckbox{{$key}}" @if(old('roles')) @foreach(old('roles') as $val) @if($val == $value->id) checked @endif @endforeach @elseif(isset($data)) @foreach($data->roles as $val) @if($val->name == $value->name) checked @endif @endforeach @elseif ($value->name == 'admin') checked @endif value="{{ $value->id }}">
                        <label for="customCheckbox{{$key}}" class="custom-control-label">{{ $value->name }}</label>
                    </div>
                    @endforeach
                    @endif
                </div>
                @error('roles')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <div class="form-group">
                    <label>Permissions for User:</label>
                    @if (isset($permissions))
                    @foreach ($permissions as $key => $value)
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input"
                        name="permissions[]"
                        type="checkbox"
                        id="permissionCheckbox{{$key}}"
                        value="{{ $value->name }}"
                        @if(old('permissions'))
                        @foreach(old('permissions') as $val)
                        @if($val == $value->name) checked @endif
                        @endforeach
                        @elseif(isset($data) && $data->getAllPermissions()->count() > 0)
                        @foreach($data->getAllPermissions() as $val)
                        @if($val->name == $value->name) checked @endif
                        @endforeach
                        @endif
                        >
                        <label for="permissionCheckbox{{$key}}" class="custom-control-label">{{ $value->name }}</label>
                    </div>
                    @endforeach
                    @endif
                </div>
                @error('permissions')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <!-- Form Element sizes -->
        </div>
        <!--/.col (right) -->

    </div>
    <!-- /.row -->
    </form>
</div>
@stop

@section('css')
@stop

@section('js')
@stop

