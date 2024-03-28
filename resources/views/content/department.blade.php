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

@endsection

@section('content')
  <div wire:offline>
    This device is currently offline.
  </div>
   <livewire:department.department-list />
@endsection
