@extends('layouts/layoutMaster')

@section('title', 'Project')

<!-- Vendor Styles -->
@section('vendor-style')

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@endsection

<!-- Page Scripts -->
@section('page-script')

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
  <script>
    window.addEventListener('close-modal', event =>{
      $('#createProjectModal').modal('hide');

    });


    // window.addEventListener('show-edit-post-modal', event => {
    //   $('#editPostModal').modal('show');
    // });
    //
    //
    // window.addEventListener('show-delete-confirmation-modal', event => {
    //   $('#deletePostModal').modal('show');
    // });
    //
    //
    // window.addEventListener('show-view-post-modal', event => {
    //   $('#viewPostModal').modal('show');
    // });
  </script>
@endsection

@section('content')
  <div wire:offline>
    This device is currently offline.
  </div>
   <livewire:projecttable />
@endsection
