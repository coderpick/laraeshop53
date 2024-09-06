@extends('layouts.backend.master')

@section('content')


<div class="page-header d-flex justify-between">
    <div>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.subcategory.index') }}">Category</a>
            </li>

        </ul>
    </div>
    <div>
        <a href="{{ route('admin.subcategory.index') }}" class="btn btn-danger btn-sm">Back to List</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-2">
                <h4 class="card-title">Sub Category Create</h4>
            </div>
            <div class="card-body">               
                <form action="{{  route('admin.subcategory.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                        @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button> 
                </form>
            </div>
        </div>
    </div>


</div>

@endsection


@push('page_js')


@endpush

@push('custom_js')

<script>

    $(document).ready(function () {
        $('#name').keyup(function () {
            let name = $(this).val();
            $('#slug').val(slugify(name));
        });
    });


    function slugify(text) {
        return text.toString().toLowerCase().trim()
            .replace(/&/g, '-and-') // Replace & with 'and'
            .replace(/[\s\W-]+/g, '-') // Remove all non-word chars
            .replace(/-+$/, '');
    }

</script>

@endpush