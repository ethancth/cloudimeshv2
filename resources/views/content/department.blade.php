@extends('layouts/layoutMaster')

@section('title', 'Department')

<!-- Vendor Styles -->
@section('vendor-style')

{{--  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
@endsection

<!-- Page Scripts -->
@section('page-script')

{{--  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>--}}
{{--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>--}}

  <script>
    window.addEventListener('close-modal', event =>{
      $('#createDepartmentModal').modal('hide');
        $('.modal').modal('hide').data('bs.modal', null);
        $('.modal').remove();
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').removeAttr('style');

    });
    window.addEventListener('swal:modal',event=>{

      Swal.fire({
        icon: 'success',
        title: event.detail[0].title,
        text: event.detail[0].text,
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

    // const formdepartmemnt = document.getElementById('formdepartmemnt');
    // const formhod = jQuery(formdepartmemnt.querySelector('[id="select2hod"]'));
    //
    // if (formhod.length) {
    //
    //
    //     formhod.wrap('<div class="position-relative"></div>');
    //     formhod.select2({
    //             placeholder: '  Select Customer',
    //             dropdownParent: formhod.parent(),
    //         })
    //         .on('change.select2', function () {
    //             let data= $(this).val()
    //             console.log(data);
    //             $wire.set('selectedHod', data)
    //             // Revalidate the color field when an option is chosen
    //             // fv.revalidateField('formCustomer');
    //         });
    //
    // }



  </script>
@endsection

@section('content')
  <div wire:offline>
    This device is currently offline.
  </div>
   <livewire:department.department-list />
@endsection
