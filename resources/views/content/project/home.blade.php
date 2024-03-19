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

    window.addEventListener('closeModal', event => {
        $("#createProjectModal").modal('hide');
        $('.modal').modal('hide').data('bs.modal', null);
        $('.modal').remove();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').removeAttr('style');
    })
    window.addEventListener('swal:modal',event=>{

      Swal.fire({
        icon: 'success',
        title: event.detail.title,
        text: 'Project Created Successfully.',
        customClass: {
          confirmButton: 'btn btn-success'
        }
      });
    });
    window.addEventListener('swal:confirm',event=>{
      Swal.fire({
        icon: event.detail[0].type,
        title: event.detail[0].title,
        text: event.detail[0].text,
        confirmButtonText: 'Yes, Delete It',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-label-secondary'
        },
      }).then((willDelete)=>
        {
          if(willDelete.value){
            Livewire.dispatch('delete', { id: event.detail[0].id })
          }
        }
      )
      ;
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
   <livewire:project.project-list />
@endsection
