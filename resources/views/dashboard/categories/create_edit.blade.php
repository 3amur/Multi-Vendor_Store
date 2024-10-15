@extends('dashboard.layouts.master')

@section('title','Categories')
{{-- start breadcrumb --}}
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ isset($category) ? "Edit Category" : "Categories"}}</li>
@endsection
{{-- start content --}}
@section('content')
    <form action="{{ route('categories.store').'?name' }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Category Name</label>
            <input class="form-control" type="text" name="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="">Category Parent</label>
            <select class="form-control" name="parent_id" id="parent_id">
                <option value="{{ null }}">Primary Category</option>
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
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="active" value="active" checked>
                <label class="form-check-label" for="active">Active</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="archived" value="archived">
                <label class="form-check-label" for="archived">Archived</label>   
            </div>       
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
@endsection