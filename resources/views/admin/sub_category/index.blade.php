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
                <a href="{{ route('admin.subcategory.index') }}">Sub Category</a>
            </li>

        </ul>
    </div>
    <div>
        <a href="{{ route('admin.subcategory.create') }}" class="btn btn-primary btn-sm">Add Sub Category</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header py-2">
                <h4 class="card-title">Sub Category</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover" id="category">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subCategories as $key => $subCategory)
                            <tr>
                                <td>{{ $key+1}}</td>
                                <td>{{ $subCategory->name }}</td>
                                <td>{{ $subCategory->slug }}</td>
                                <td>{{ $subCategory->category->name??'' }}</td>
                                <td>{{ \Carbon\Carbon::parse($subCategory->created_at)->diffForHumans() }}</td>

                                <td>
                                    <a href="{{  route('admin.category.edit', $subCategory->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <button onclick="deleteRecord({{ $subCategory->id }})" type="button"
                                        class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                        title="Delete Category">
                                        Delete
                                    </button>
                                    <form id="delete-form-{{ $subCategory->id }}"
                                        action="{{ route('admin.category.destroy', $subCategory->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty

                            @endforelse


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>

@endsection

@push('page_css')
<link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css
    " rel="stylesheet">
@endpush

@push('page_js')
<!-- Datatables -->
<script src="{{ asset('assets/backend/js/plugin/datatables/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
@endpush

@push('custom_js')
<script>
    $(document).ready(function () {

        $("#category").DataTable({});

    });

        function deleteRecord(id) {
              const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                    });
                    swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                    }).then((result) => {
                    if (result.isConfirmed) {
                        if (result.value) {
                        $('#delete-form-' + id).submit();
                        }
                       /* swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                        });*/
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error"
                        });
                    }
                    });
                /*   swal({
                       title: 'Are you sure?',
                       text: "You won't be able to revert this!",
                       type: 'warning',
                       showCancelButton: true,
                       confirmButtonColor: '#3085d6',
                       cancelButtonColor: '#d33',
                       confirmButtonText: 'Yes, Delete!'
                   }).then((result) => {
                       if (result.value) {
                           $('#delete-form-' + id).submit();
                       }
                   })
                       */
            }

</script>
@endpush