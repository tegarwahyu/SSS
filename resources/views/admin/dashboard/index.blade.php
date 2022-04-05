{{-- Users index page --}}
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
<div class="container-fluid mt--7 bg-color" style="padding-top: 120px;">
    {{-- <breadcrumb list-classes="breadcrumb-links">
      <breadcrumb-item><a href="{{ url('admin') }}">Beranda</a></breadcrumb-item>
      <breadcrumb-item>/ Dokumen</breadcrumb-item>
      <breadcrumb-item active>/ Data SPT</a></breadcrumb-item>
    </breadcrumb> --}}

    <div class="col-md-12 dashboard-bg-color">
    <div class="card">
        <div class="card-header">
          
        </div>
        <div class="card-body">
          <div class="tab-content mt-3">
            
          </div>
        </div>
    </div>
  </div>

</div>

<!-- end core spt -->
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/summernote/summernote-lite.min.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/summernote/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
