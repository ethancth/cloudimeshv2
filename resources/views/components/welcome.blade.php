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
{{--  <script src="https://cdn.tailwindcss.com"></script>--}}
@endsection

@section('content')
  <div wire:offline>
    This device is currently offline.
  </div>
  <livewire:users-table />
@endsection
