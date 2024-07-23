@extends('Dashboard.Master.master_layout')
@section('title')
EatAnmol - Manage Types
@endsection

@section('content')

<div class="inner-body">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Welcome to Eatanmol</h2>
             <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Types</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                    <i class="fe fe-download me-2"></i> Import
                </button>
                <button type="button" class="btn btn-white btn-icon-text my-2 me-2">
                    <i class="fe fe-filter me-2"></i> Filter
                </button>
                <button type="button" data-bs-target="#addTypeModal" data-bs-toggle="modal" class="btn btn-primary my-2 btn-icon-text">
                    <i class="fe fe-menu me-2"></i> Add Types
                </button>
            </div>
        </div>
    </div>
    <!-- End Page Header -->

    <!--Row-->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card p-3 mg-b-20">
                <div class="card-body">
                    <div class="card-header border-bottom-0 pt-0 ps-0 pe-0 d-flex">
                        <div>
                            <label class="main-content-label mb-2">Types</label>
                           
                        </div>
                    </div>
                    <br>
                  <div class="container">
                    <div class="table-responsive tasks">
                        <table class="table card-table table-vcenter text-nowrap mb-0 border">
                            <thead>
                                <tr>
                                    <th class="wd-lg-10p">ID</th>
                                    <th class="wd-lg-40p">Name</th>
                                    <th class="wd-lg-20p">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $type)
                                    <tr>
                                        <td>{{ $type->id }}</td>
                                        <td>{{ $type->name }}</td>
                                        <td>
                                            {{-- <a href="{{ route('types.edit', $type->id) }}" class="btn btn-primary px-3">Edit</a> --}}
                                            <div class="main-dropdown-form-demo" style="display: inline-block">
                                                <button class="btn ripple btn-main-primary  px-4 pd-x-20" data-bs-toggle="dropdown">Edit &nbsp; <i class="icon ion-ios-arrow-down mg-l-5 tx-12"></i></button>
                                                <div class="dropdown-menu" id="editDropdown">
                                                    <h6 class="dropdown-title text-center mb-4">Edit</h6>
                                                    <form method="POST" id="editTypeForm" action="{{ route('types.update', $type->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group">
                                                            <input class="form-control" id="OcassionNameEdit" name="name" placeholder="Edit Type Name" type="text" required value="{{ $type->name }}">
                                                            <small class="text-danger" id="nameEditError"></small>

                                                        </div>
                                                        <button type="button" onclick="validateAndSubmitEditForm()" class="btn ripple btn-primary btn-block">Save Changes</button>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                            <form action="{{ route('types.destroy', $type->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger px-4" onclick="return confirm('Are you sure you want to delete this type?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
                    
                    
                </div>
            </div>
        </div>
    </div><!-- Row end -->
</div>
<div class="modal" id="addTypeModal">
    <div class="modal-dialog wd-xl-400" role="document">
        <div class="modal-content">
            <div class="modal-body pd-20 pd-sm-40">
                <button aria-label="Close" class="close pos-absolute t-15 r-20 tx-26" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title mb-4 text-center">Add New Type</h5>
                <form method="POST" action="{{ route('types.store') }}">
                    @csrf
                    <div class="form-group">
                        <input class="form-control" id="OcassionNameAdd" name="name" placeholder="Type Name" type="text" required>
                        <small class="text-danger" id="nameError"></small>
                    </div>
                    <button type="button" class="btn ripple btn-primary btn-block" onclick="validateAndSubmitForm()">Add Type</button>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
<script>
    function validateAndSubmitForm() {
        // const nameInput = document.querySelector('[name="name"]');
        const nameInput = document.querySelector('#OcassionNameAdd');
        const nameError = document.querySelector('#nameError');
        let isValid = true;

        // Check if the name is empty
        if (nameInput.value.trim() === '') {
            nameError.textContent = 'Name is required.';
            isValid = false;
        } else if (nameInput.value.length < 3) {
            nameError.textContent = 'Name must be at least 3 characters.';
            isValid = false;
        } else {
            nameError.textContent = ''; // Clear the error message
        }

        if (isValid) {
            // Submit the form if validation passes
            document.querySelector('#addTypeModal form').submit();
        }
    }
    function validateAndSubmitEditForm() {
        // const nameInput = document.querySelector('[name="name"]');
        const nameInput = document.querySelector('#OcassionNameEdit');
        const nameError = document.querySelector('#nameEditError');
        let isValid = true;

        // Check if the name is empty
        if (nameInput.value.trim() === '') {
            nameError.textContent = 'Name is required.';
            isValid = false;
        } else if (nameInput.value.length < 3) {
            nameError.textContent = 'Name must be at least 3 characters.';
            isValid = false;
        } else {
            nameError.textContent = ''; // Clear the error message
        }

        if (isValid) {
            // Submit the form if validation passes
            document.querySelector('#editTypeForm').submit();
        }
    }
    document.querySelector('#editDropdown').addEventListener('click', function(event) {
        event.stopPropagation();
    });
</script>

@endsection
