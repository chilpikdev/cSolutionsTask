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
          <li class="breadcrumb-item"><a href="{{ route("products.index") }}">Products</a></li>
          <li class="breadcrumb-item active">{{ isset($data) ? "Edit post ID {$data->id}" : "Add new Entry" }}</li>
        </ol>
      </div>
    </div>
</div>
@stop

@section("content")
<div class="container-fluid">
    <form action="@if(isset($data)) {{ route('products.update', $data->id) }} @else {{ route('products.store') }} @endif" method="POST">
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
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') border-red-500 @enderror" name="title" id="title" @if(old('title')) value="{{ old('title') }}" @elseif(isset($data)) value="{{ $data->title }}" @endif>
                        </div>
                        @error('title')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="quantiy">Quantiy</label>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                            </div>
                            <input type="number" class="form-control @error('quantiy') border-red-500 @enderror" name="quantiy" id="quantiy" @if(old('quantiy')) value="{{ old('quantiy') }}" @elseif(isset($data)) value="{{ $data->quantiy }}" @endif>
                            </div>
                        </div>
                        @error('quantiy')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror

                        <div class="form-group">
                            <label for="price">Price</label>
                            <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                            </div>
                            <input type="text" class="form-control @error('price') border-red-500 @enderror" name="price" id="price" @if(old('price')) value="{{ old('price') }}" @elseif(isset($data)) value="{{ $data->price }}" @endif>
                            </div>
                        </div>
                        @error('price')
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
