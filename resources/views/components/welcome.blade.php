@extends('layouts/layoutMaster')

@section('title', 'Project')

<!-- Vendor Styles -->
@section('vendor-style')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <livewire:styles />
  <script src="//unpkg.com/alpinejs" defer></script>
  <style>
    [x-cloak] { display: none !important; }
  </style>
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <livewire:scripts />
  {{--    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>--}}
  <script src="https://unpkg.com/@nextapps-be/livewire-sortablejs@0.1.1/dist/livewire-sortable.js"></script>
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
