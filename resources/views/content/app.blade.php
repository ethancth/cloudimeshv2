@extends('layouts/layoutMaster')

@section('title', 'Department')

<!-- Vendor Styles -->
@section('vendor-style')

{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">--}}
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@endsection

<!-- Page Scripts -->
@section('page-script')

{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>--}}


<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script>

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


    </script>
@endsection

@section('content')
    <div wire:offline>
        This device is currently offline.
    </div>
  {{$slot}}
@endsection
