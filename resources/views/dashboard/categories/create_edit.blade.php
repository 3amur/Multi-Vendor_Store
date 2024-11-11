@extends('dashboard.layouts.master')

@section('title', isset($category) ? 'Edit Categories' : 'Categories')
{{-- start breadcrumb --}}
@section('breadcrumb')
    <li class="breadcrumb-item active">{{ isset($category) ? "Edit Category" : "Categories" }}</li>
@endsection
{{-- start content --}}
@section('content')
    {{-- check errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <h4>Error Ocurred !</h4>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @isset($category)
            @method('PUT')
        @endisset
        <div class="form-group">
            <label for="">Category Name</label>
            <input @class([
                'form-control',
                'is-invalid' => $errors->has('name'),
                ])
            type="text" name="name" value="{{ isset($category) ? $category->name : old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Category Parent</label>
            <select @class([
                'form-control',
                'is-invalid' => $errors->has('parent_id'),
                ]) name="parent_id" id="parent_id">
                <option value="{{ null }}">Primary Category</option>
                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" @selected( isset($category) ? $category->parent_id == $parent->id : '' ) >{{ $parent->name }}</option>
                @endforeach
            </select>
            @error('parent_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
             @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea @class([
                'form-control',
                'is-invalid' => $errors->has('description'),
                ]) 
            name="description" id="description">{{ isset($category) ? $category->description : old('description') }}</textarea>
            @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Image</label>
            @isset($category->image)
             <img class="p-2" src="{{ asset('storage/'.$category->image) }}" style="width:150px; height:100px;" alt="category_img">
            @endisset
            <input @class([
                'form-control',
                'is-invalid' => $errors->has('image'),
                ]) name="image" type="file">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">Status</label> 
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="active" value="active" @checked(old('status', isset($category) ? $category->status : '') == 'active')>
                <label class="form-check-label" for="active">Active</label>
                @error('active')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="archived" value="archived" @checked(old('status', isset($category) ? $category->status : '') == 'archived')>

                <label class="form-check-label" for="archived">Archived</label>   
                @error('archived')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>       
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
@endsection