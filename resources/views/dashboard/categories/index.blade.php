@extends('dashboard.layouts.master')

@section('title','Categories')

@section('breadcrumb')
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <div class="mb-5">
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-outline-primary">Create Category</a>
    </div>
    {{-- alert component --}}
    <x-alert type="success" message="success" />  {{-- success (store & edit) --}}
    <x-alert type="danger" message="danger" />  {{-- success (delete) --}}
    {{-- search form --}}
    <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
        <select name="status" id="status"  class="form-control">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active') >Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>
        <button class="btn btn-dark mx-2">Filter</button>
    </form>

    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Status</th>
                <th>Image</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->parent_id }}</td>
                <td>{{ $category->status }}</td>
                <td>
                    <img src="{{ asset('storage/'.$category->image) }}" style="width:150px; height:100px;" alt="category_img">
                </td>
                <td>{{ $category->created_at }}</td>
                <td><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a></td>
                <td>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                        @csrf
                        {{-- Form method spoofing 2 wayes --}}
                        {{-- @method('delete') --}} 
                        <input type="hidden" name="_method" value="delete"> 
                        <button type="submit" class="btn btn-sm btn-outline-danger delete" data-id={{ $category->id }} data-url={{URL('dashboard/categories/. $category->id ./destroy')}}>Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr> <td colspan="5"><h4>No Data Founded</h4></td> </tr>
            @endforelse
        </tbody>
    </table>
    {{ $categories->withQueryString()->links() }}
@endsection