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
        {{-- input component --}}
        <x-form.input label="Category Name" name="name" :value=" $category->name ?? old('name') " />
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
            <x-form.label for="description">Description</x-form.label>
            <x-form.textarea name="description" :value=" $category->description ?? old('description') " />
        </div>
        <div class="form-group">
            <x-form.input label="Image" type="file" name="image" accept="image/*" />
            @isset($category->image)
             <img class="p-2" src="{{ asset('storage/'.$category->image) }}" style="width:150px; height:100px;" alt="category_img">
            @endisset
        </div>
        <div class="form-group">
            <x-form.label for="status">Status</x-form.label> 
            <x-form.radio-button name="status" :checked=" $category->status ?? '' " :options="['active' => 'Active', 'archived' => 'Archived']" />      
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
@endsection