@extends('dashboard.layouts.master')

@section('title', isset($category) ? 'Edit Categories' : 'Categories')
{{-- start breadcrumb --}}
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ isset($category) ? "Edit Category" : "Categories" }}</li>
@endsection
{{-- start content --}}
@section('content')
    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @isset($category)
            @method('PUT')
        @endisset
        <div class="form-group">
            <label for="">Category Name</label>
            <input class="form-control" type="text" name="name" value="{{ isset($category) ? $category->name : old('name') }}">
        </div>
        <div class="form-group">
            <label for="">Category Parent</label>
            <select class="form-control" name="parent_id" id="parent_id">
                <option value="{{ null }}">Primary Category</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" @selected( isset($category) ? $category->parent_id == $parent->id : '' ) >{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description">{{ isset($category) ? $category->description : old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="">Image</label>
            <input class="form-control" name="image" type="file">
        </div>
        <div class="form-group">
            <label for="status">Status</label> 
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="active" value="active" @checked(isset($category) ? $category->status == 'active' : '')>
                <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="archived" value="archived" @checked(isset($category) ? $category->status == 'archived' : '')>
                <label class="form-check-label" for="archived">Archived</label>   
            </div>       
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
@endsection