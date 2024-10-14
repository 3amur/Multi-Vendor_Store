@extends('dashboard.layouts.master')

@section('title','Categories')

@section('breadcrumb')
    <li class="breadcrumb-item active">{{ isset($category) ? "Edit Category" : "Categories"}}</li>
@endsection

@section('content')
    <form action="{{ route('categories.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Category Name</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="">Category Parent</label>
            <select class="form-control" name="parent_id" id="parent_id">
                <option value="{{ null }}">Sub Category</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description"></textarea>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input class="form-control" name="image" type="file">
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="active" name="active" class="custom-control-input">
                <label class="custom-control-label" for="active">Active</label>
            </div>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="archived" name="archived" class="custom-control-input">
                <label class="custom-control-label" for="archived">Archived</label>
            </div>            
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
@endsection