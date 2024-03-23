@extends('layouts/layoutMaster')

@section('title', 'User Management - Crud App')

@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css')}}" />
@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')
  <script src="{{asset('js/laravel-user-management.js')}}"></script>
@endsection

@section('content')

  <!-- Users List Table -->
  <div class="card">
    <div class="card-header">
      <h5 class="card-title mb-0">Search Filter</h5>
    </div>
    <div class="card-datatable table-responsive">
      <table class="datatables-users table">
        <thead class="border-top">
        <tr>
          <th></th>
          <th>Id</th>
          <th>User</th>
          <th>Email</th>
          <th>Verified</th>
          <th>Actions</th>
        </tr>
        </thead>
      </table>
    </div>
    <!-- Offcanvas to add new user -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" aria-labelledby="offcanvasAddUserLabel">
      <div class="offcanvas-header">
        <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body mx-0 flex-grow-0">
        <form class="add-new-user pt-0" id="addNewUserForm">
          <input type="hidden" name="id" id="user_id">
          <div class="mb-3">
            <label class="form-label" for="add-user-fullname">Name</label>
            <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe" name="name" aria-label="John Doe" />
          </div>
          <div class="mb-3">
            <label class="form-label" for="add-user-email">Email</label>
            <input type="text" id="add-user-email" class="form-control" placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="email" />
          </div>

          <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
          <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </form>
      </div>
    </div>
  </div>
@endsection
