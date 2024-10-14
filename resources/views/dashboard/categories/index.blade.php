@extends('dashboard.layouts.master')

@section('title','Categories')

@section('breadcrumb')
    <li class="breadcrumb-item active">Categories</li>
@endsection

@section('content')
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->parent }}</td>
                <td>{{ $category->created_at }}</td>
                <td><a href="{{ route('categories.edit') }}" class="btn btn-sm btn-outline-success">Edit</a></td>
                <td>
                    <form action="{{ route('categories.destroy') }}" method="post">
                        @csrf
                        {{-- Form method spoofing 2 wayes --}}
                        {{-- @method('delete') --}}
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr> <td colspan="5"><h4>No Data Founded</h4></td> </tr>
            @endforelse
        </tbody>
    </table>
@endsection