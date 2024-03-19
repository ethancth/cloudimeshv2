@extends('layouts/layoutMaster')

@section('title', 'Department')

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
    window.addEventListener('swal:modal',event=>{

      Swal.fire({
        icon: 'success',
        title: event.detail.title,
        text: 'Created Successfully.',
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
        confirmButtonText: 'Yes',
        customClass: {
          confirmButton: 'btn btn-primary me-3',
          cancelButton: 'btn btn-label-secondary'
        },
      }).then((willDelete)=>
        {
          if(willDelete){
            Livewire.dispatch('delete', { id: event.detail[0].id })
          }
        }
      )
      ;
    });


  </script>
@endsection

@section('content')
  <div wire:offline>
    This device is currently offline.
  </div>
   <livewire:department.department-list />
@endsection
