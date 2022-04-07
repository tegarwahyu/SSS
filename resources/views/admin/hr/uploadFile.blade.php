@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')

<div class="container-fluid mt--7 bg-color" style="margin-top: 20px  !important;">
    <div class="row">
        <div class="col">
            <div class="card shadow" id="user-card">
                <div class="card-body">
                    <div class="col-md-12 user-form">
                        <div class="invalid-feedback" permission="alert">

                        </div>
                        <form id="user-form" class="ajax-form" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">

                            @csrf
                                <h3 class="zheading-small text-muted mb-5">{{ __('Input Karyawan') }}</h3>

                            <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('KTP') }}</span>
                                <div class="col-md-3">
                                    <input id="ktp" type="text" class="form-control @error('ktp') is-invalid @enderror" name="ktp" value="{{ old('KTP') }}" required autofocus placeholder="{{ __('KTP') }}">

                                    @error('ktp')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <input id="kk" type="text" class="form-control @error('kk') is-invalid @enderror" name="kk" value="{{ old('KK') }}" required autofocus placeholder="{{ __('KK') }}">

                                    @error('kk')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('Passport') }}</span>
                                <div class="col-md-3">
                                    <input id="passport" type="passport" class="form-control" name="passport" placeholder="{{ __('Passport') }}">
                                    <small class="form-text text-muted" style="font-size: 16px;">kolom <b>Passport</b> bisa di kosongkan bila tidak ada</small>
                                    @error('passport')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <input id="npwp" type="npwp" class="form-control" name="npwp" placeholder="{{ __('NPWP') }}">
                                    @error('npwp')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('Nama Lengkap') }}</span>
                                <div class="col-md-3">
                                    <textarea id="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="fullname" value="{{ old('first_name') }}" required autofocus placeholder="{{ __('Nama Lengkap') }}"></textarea>
                                    <small class="form-text text-muted" style="font-size: 16px;">kolom <b>Nama Lengkap</b> tidak perlu di beri <b>Enter</b></small>
                                    @error('nama_lengkap')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required placeholder="{{ __('Email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">Alamat Domisili</span>
                                <div class="col-md-4">
                                    <textarea id="alamat_domisili" type="text" class="form-control @error('alamat_domisili') is-invalid @enderror" name="alamat_domisili" required placeholder="{{ __('Alamat Domisili') }}"></textarea>

                                    @error('alamat_domisili')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-2 container1">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone_rumah" required placeholder="{{ __('Telp. Rumah') }}">
                                    @error('phone')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">Alamat KTP</span>
                                <div class="col-md-4">
                                    <textarea id="alamat_ktp" type="text" class="form-control @error('alamat_ktp') is-invalid @enderror" name="alamat_ktp" required placeholder="{{ __('Alamat KTP') }}"></textarea>

                                    @error('alamat_ktp')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-2 container1">
                                    <input type="text" class="form-control @error('phone_hp') is-invalid @enderror" name="phone_hp" required placeholder="{{ __('Telp. HP') }}">
                                    @error('phone_hp')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">Jabatan</span>
                                <div class="col-md-3">
                                    <select class="form-control selectize" id="jabatan" name="jabatan">
                                        <option value="" selected disabled>{{ __('Pilih Jabatan') }}</option>
                                        @foreach($dataRole as $role)
                                            <option class="form-control" value="{{$role->id}}" >{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 container1">
                                    <input type="text" class="form-control @error('divisi') is-invalid @enderror" id="divisi" name="divisi" required placeholder="{{ __('Divisi') }}">
                                    @error('divisi')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <script>
                                    $("select.selectize").change(function(){
                                        var selectIdRole = $(this).children("option:selected").val();
                                        if(selectIdRole == 16 || selectIdRole == 14){
                                            $('#divisi').val('HRD');
                                        }else if(selectIdRole == 17 || selectIdRole == 18 || selectIdRole == 19 || selectIdRole == 20){
                                            $('#divisi').val('Collection');
                                        }
                                    });
                                </script>
                            </div>

                            <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('Status Pernikahan') }}</span>
                                <div class="col-md-4">
                                    <select class="form-control selectize" id="status_pernikahan" name="status_pernikahan">
                                        <option value="" selected disabled>{{ __('Pilih Status Pernikahan') }}</option>
                                        <option class="form-control" value="TK" >Belum Kawin</option>
                                        <option class="form-control" value="K0" >Kawin belum punya anak</option>
                                        <option class="form-control" value="K1" >Kawin anak 1</option>
                                        <option class="form-control" value="K2" >Kawin anak 2</option>
                                        <option class="form-control" value="K3" >Kawin anak 3</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control selectize" id="agama" name="agama">
                                        <option value="" selected disabled>{{ __('Pilih Agama') }}</option>
                                        <option class="form-control" value="Islam">Islam</option>
                                        <option class="form-control" value="Buddha" >Buddha</option>
                                        <option class="form-control" value="Hindu" >hindu</option>
                                        <option class="form-control" value="Kristen Katolik">Kristen Katolik</option>
                                        <option class="form-control" value="Khonghucu" >Khonghucu</option>
                                        <option class="form-control" value="Kristen">Kristen</option>
                                        <option class="form-control" value="Kristen Protestan">Kristen Protestan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('Tempat Lahir') }}</span>
                                <div class="col-md-2 container1">
                                    <input id="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" required placeholder="{{ __('Tempat Lahir') }}">
                                    @error('tempat_lahir')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 container1">
                                    <input id="tanggal_lahir" type="text" class="form-control datepick" name="tanggal_lahir" id="tanggal_lahir" autocomplete="off" placeholder="{{ __('Tanggal Lahir')}}" data-date-format="dd-mm-yyyy">
                                    @error('tanggal_lahir')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <script>
                                        $('#tanggal_lahir').datepicker({
                                            format: "dd-mm-yyyy",
                                            autoclose: true,
                                        });
                                    </script>
                                </div>
                                <div class="col-md-2 container1">
                                    <input id="kewarganegaraan" type="text" class="form-control @error('kewarganegaraan') is-invalid @enderror" name="kewarganegaraan" required placeholder="{{ __('Kewarganegaraan') }}">
                                    @error('kewarganegaraan')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--  <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('Nama Ibu Kandung') }}</span>
                                <div class="col-md-4 container1">
                                    <input type="text" class="form-control @error('kerabat') is-invalid @enderror" name="kerabat" required placeholder="{{ __('Nama Ibu Kandung') }}">
                                    @error('kerabat')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>  --}}

                            <div class="form-group row">
                                <span class="col-md-3 col-form-label text-md-right labelclass">{{ __('Password') }}</span>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="{{ __('Password') }}">
                                        {{--  <input type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" autocomplete="new-password" minlength="6">  --}}
                                        {{--  <div class="input-group-append toggle-password">
                                             <span class="input-group-text mdi mdi-eye-outline"></span>
                                        </div>  --}}
                                     </div>
                                    {{--  <script>
                                        $('.toggle-password').click(function(){ //show password
                                            $(this).children().toggleClass('mdi-eye-outline mdi-eye-off-outline');
                                            let input = $(this).prev();
                                            input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
                                        });
                                    </script>  --}}
                                </div>
                                <div class="col-md-3 container1">
                                    <input id="darah" type="text" class="form-control @error('darah') is-invalid @enderror" name="darah" required placeholder="{{ __('Golongan Darah') }}">
                                    @error('darah')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{--  <div class="col-md-3 container1">
                                    <input id="sosmed" type="text" class="form-control @error('sosmed') is-invalid @enderror" name="sosmed" required placeholder="{{ __('Sosial Media') }}">
                                    @error('sosmed')
                                        <span class="invalid-feedback" permission="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>  --}}
                            </div><br><br>

                            <div class="form-group">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary offset-md-3 default-button">
                                        {{ __('Submit') }}
                                    </button>
                                    <button type="button" class="btn btn-danger offset-md-1" onclick="window.location='{{ route('hr') }}'">
                                        {{ __('Kembali') }}
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
@include('admin.hr.js')
@include('layouts.footers.auth')
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/datatables/datatables.min.css') }}">
    <link href="{{ asset('assets/vendor/bsdatepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@push('js')
    <script src="{{ asset('assets/vendor/bsdatepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-validate.bootstrap-tooltip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/handlebars.js') }}"></script>
@endpush
