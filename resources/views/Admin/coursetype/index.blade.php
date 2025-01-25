@extends('Dashboard.Master.master_layout')
@section('title')
    Course Type List - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Course Types</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Course Type</li>
                </ol>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">

                <div class="card custom-card mg-b-20">
                    <div class="card-body">

                        <h4 class="text-dark">Create Course Types</h4>
                        <form action="{{ route('coursetypes.store') }}" method="POST">
                            @csrf
                            <div class="align-items-end row">
                                <div class="col-lg-4 mb-3">
                                    <label for="type">Type</label>
                                    <input class="form-control" id="type" name="type" required type="text">
                                    <small id="typeError" class="text-danger"></small>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                    <small id="statusError" class="text-danger"></small>
                                </div>
                                <div class="col-lg-4  mb-3" style="text-align: end;">
                                    <button class="btn btn-block ripple btn-main-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                        <h4 class="text-dark mt-4">Manage Course Types</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coursetypes as $course)
                                        <tr>
                                            <td>{{ $course->id }}</td>
                                            <td>{{ $course->type }}</td>
                                            <td>{{ $course->status == 1 ? 'Active' : 'Inactive' }}</td>
                                            <td>
                                                <button class="btn btn-main-primary px-3 edit-button"
                                                    data-id="{{ $course->id }}" data-type="{{ $course->type }}"
                                                    data-status="{{ $course->status }}">
                                                    Edit
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" id="editForm" action="">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit Course Type</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="edit_type">Type</label>
                                        <input class="form-control" id="edit_type" name="type" required type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_status">Status</label>
                                        <select class="form-control" id="edit_status" name="status" required>
                                            <option value="0">Inactive</option>
                                            <option value="1">Active</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-button');
            const editModal = document.getElementById('editModal');
            const editForm = document.getElementById('editForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Set form action dynamically
                    editForm.action = `{{ route('coursetypes.update', ':id') }}`.replace(':id', this
                        .dataset.id);

                    // Populate form fields
                    document.getElementById('edit_type').value = this.dataset.type;
                    document.getElementById('edit_status').value = this.dataset.status;

                    // Show the modal
                    $(editModal).modal('show');
                });
            });
        });
    </script>
@endsection
