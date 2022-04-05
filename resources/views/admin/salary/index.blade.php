<style>
    .alert {
        width: 500px !important;
        margin: 25px auto !important;
    }
</style>
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: 20px  !important;">
    <div class="row">
        <div class="col">
            {{-- session show message --}}
            @if(session()->has('EmptyData'))
                <div class="alert alert-danger">
                    {{ session()->get('EmptyData') }}
                </div>
            @endif

            <div class="col-md-12">
                @include('admin.salary.form_cari')
           </div>
           
           <div class="card shadow" id="salary-card" style="display: none">
                <div class="card-body">
                    <div class="text-center">
                        <h2>{{ __('Data Salary Karyawan') }}</h2>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm ajax-table" id="salary-table">
                            <thead>

                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@include('admin.salary.js')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
