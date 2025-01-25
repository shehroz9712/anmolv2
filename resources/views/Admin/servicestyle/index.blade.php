@extends('Dashboard.Master.master_layout')
@section('title')
    Service Style List - EatAnmol
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="inner-body">
        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h2 class="main-content-title tx-24 mg-b-5">Service Style</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Manage Service Style</li>
                </ol>
            </div>
            <div class="d-flex">
                <div class="justify-content-center">
                    <a href="{{ route('servicestyles.create') }}" class="btn btn-primary my-2 btn-icon-text">
                        <i class="fe fe-plus me-2"></i> Add Service Style
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row row-sm">
            <div class="col-lg-12">
                <div class="card custom-card mg-b-20">
                    <div class="card-body">
                        <h4 class="text-dark">Create Service Style</h4>
                        <!-- Create Form -->
                        <form method="POST" action="{{ route('servicestyles.store') }}">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-lg-3 mb-3">
                                    <label for="name">Name</label>
                                    <input class="form-control" id="name" name="name" required type="text">
                                </div>

                                <div class="col-lg-3 mb-3">
                                    <label for="course_type_id">Course Type</label>
                                    <select id="course_type_id" class="form-control" name="course_type_id" required>
                                        @foreach ($coursetypes as $item)
                                            <option value="{{ $item->id }}">{{ $item->type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3 mb-3">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>

                                <div class="col-lg-3  mb-3" style="text-align: end;">
                                    <button class="btn btn-block ripple btn-main-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                        <h4 class="text-dark">Manage Service Style</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example2">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Course Type</th>
                                        <th class="wd-lg-20p">Status</th>
                                        <th class="wd-lg-20p">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($servicestyles as $record)
                                        <tr>
                                            <td>{{ $record->name }}</td>
                                            <td>{{ $record->coursetype?->type }}</td>
                                            <td>
                                                @if ($record->status == 1)
                                                    <span class="text-success">Active</span>
                                                @else
                                                    <span class="text-danger">Blocked</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-main-primary px-3 edit-button"
                                                    data-id="{{ $record->id }}" data-name="{{ $record->name }}"
                                                    data-course-type-id="{{ $record->course_type_id }}"
                                                    data-status="{{ $record->status }}">Edit</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" id="editForm" action="">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Service Style</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="edit_name">Name</label>
                                                <input class="form-control" id="edit_name" name="name" required
                                                    type="text">
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_course_type_id">Course Type</label>
                                                <select id="edit_course_type_id" class="form-control" name="course_type_id"
                                                    required>
                                                    @foreach ($coursetypes as $item)
                                                        <option value="{{ $item->id }}">{{ $item->type }}</option>
                                                    @endforeach
                                                </select>
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
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('js')
    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-button');
            const editModal = document.getElementById('editModal');
            const editForm = document.getElementById('editForm');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Set form action dynamically
                    editForm.action = `{{ route('servicestyles.update', ':id') }}`.replace(':id', this
                    .dataset.id);
                    // Populate form fields
                    document.getElementById('edit_name').value = this.dataset.name;
                    document.getElementById('edit_course_type_id').value = this.dataset
                        .courseTypeId;
                    document.getElementById('edit_status').value = this.dataset.status;

                    // Show the modal
                    $(editModal).modal('show');
                });
            });
        });
    </script>
@endsection
