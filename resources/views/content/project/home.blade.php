@extends('layouts/layoutMaster')

@section('title', 'Project')

<!-- Vendor Styles -->
@section('vendor-style')
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@endsection

<!-- Page Scripts -->
@section('page-script')
@endsection

@section('content')
  <div wire:offline>
    This device is currently offline.
  </div>
   <livewire:projecttable />
@endsection
