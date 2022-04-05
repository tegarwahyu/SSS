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
            <div class="card shadow">
                <div class="card-body">
                    {{-- session show message --}}
                    @if(session()->has('SuccessImportData'))
                        <div class="alert alert-success">
                            {{ session()->get('SuccessImportData') }}
                        </div>
                    @endif
                    <div class="text-center">
                        <h2>{{ __('Form Salary Karyawan') }}</h2>
                    </div>
                    <div id="formUploadSalary">
                        <form action="{{ route('uploadSalary') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            @csrf
                            <h3 class="zheading-small text-muted mb-4">{{ __('Upload Salary') }}</h3>
                            @csrf
                            <div class="form-group row">
                                <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Salary Periode') }}</span>
                                <div class="col-md-6">
                                    <input type="text" class="form-control datepick" name="salary_periode" id="salary-periode" autocomplete="off" placeholder="{{ __('Salary Periode')}}" data-date-format="dd-mm-yyyy">
                                </div>
                            </div>
                            <script>
                                var today = new Date();
                                $('#salary-periode').datepicker({
                                    format: 'mm-yyyy',
                                    minViewMode: "months",
                                    autoclose:true,
                                    endDate: "today",
                                    maxDate: today,
                                });
                            </script>
                            <div class="form-group row">
                                <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Upload File') }}</span>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="file_excel_salary" id="file_excel_salary">
                                    <small class="form-text text-muted" style="font-size: 16px;">Silahkan masukkan File Excel dengan Max ukuran file ...MB dengan format (xlsx)</small>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary offset-md-3 default-button">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                        
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
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
