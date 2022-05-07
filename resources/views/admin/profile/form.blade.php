<style>
    .alert {
        width: 500px !important;
        margin: 25px auto !important;
    }
</style>
<div class="col-xl-12 order-xl-1">
    <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        {{-- <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-badge mr-2"></i>Profil-Ku</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-circle-08 mr-2"></i>Data Pegawai</a>
                        </li> --}}
                        <!-- <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false" ><i class="ni ni-calendar-grid-58 mr-2"></i>Messages</a>
                        </li> -->
                    </ul>
                    @if(session()->has('SuccessChangePassword'))
                    <div class="alert alert-success">
                        {{ session()->get('SuccessChangePassword') }}
                    </div>
                    @endif
                    <script>
                        setTimeout(function() {
                            $('.alert').fadeOut('fast');
                        }, 4500); // <-- time in milliseconds
                    </script>
            <div class="row align-items-center">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <form autocomplete="off" class="ajax-form" action="{{ route('editPassword') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{ isset($dataUser->id) ?? $dataUser->id }}">
                                    <input type="hidden" name="user_id" id="user-id" value="{{ auth()->user()->id }}">

                                    <h6 class="heading-small text-muted mb-4">{{ __('Data Diri') }}</h6>

                                    @if (session('status'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('status') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="form-group row">
                                        <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>
                                        <div class="col-md-10">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Nomor') }}</span>
                                        <div class="col-md-5">
                                            <input id="ktp" type="text" class="form-control @error('ktp') is-invalid @enderror" name="ktp" value="{{ old('KTP') }}" required autofocus placeholder="{{ __('KTP') }}">

                                            @error('ktp')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <input id="kk" type="text" class="form-control @error('kk') is-invalid @enderror" name="kk" value="{{ old('KK') }}" required autofocus placeholder="{{ __('KK') }}">

                                            @error('kk')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">Alamat</span>
                                        <div class="col-md-5">
                                            <textarea id="alamat_ktp" type="text" class="form-control @error('alamat_ktp') is-invalid @enderror" name="alamat_ktp" required placeholder="{{ __('Alamat KTP') }}"></textarea>

                                            @error('alamat_ktp')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <textarea id="alamat_domisili" type="text" class="form-control @error('alamat_domisili') is-invalid @enderror" name="alamat_domisili" required placeholder="{{ __('Alamat Domisili') }}"></textarea>

                                            @error('alamat_domisili')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Kontak') }}</span>
                                        <div class="col-md-5">
                                            <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required autofocus placeholder="{{ __('No. Hp') }}">

                                            @error('no_hp')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <input id="no_telp" type="passport" class="form-control" name="no_telp" placeholder="{{ __('No. Telepon') }}">
                                            @error('no_telp')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Email') }}</span>
                                        <div class="col-md-5">
                                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('Email') }}">
                                            @error('email')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Tempat Lahir') }}</span>
                                        <div class="col-md-5 container1">
                                            <input id="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" required placeholder="{{ __('Tempat Lahir') }}">
                                            @error('tempat_lahir')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5 container1">
                                            <input id="tanggal_lahir" type="text" class="form-control datepick" name="tanggal_lahir" id="tanggal_lahir" autocomplete="off" required placeholder="{{ __('Tanggal Lahir')}}" data-date-format="dd-mm-yyyy">
                                            @error('tanggal_lahir')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <script>
                                                $('#tanggal_lahir').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                                });
                                            </script>
                                        </div>
                                    </div>

                                    <h6 class="heading-small text-muted mb-4">{{ __('Riwayat Pendidikan') }}</h6>

                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">Pendidikan 1</span>
                                        <div class="col-md-1">
                                            <select class="form-control selectize" id="pendidikan_1" name="pendidikan_1" required>
                                                <option value="" selected disabled>{{ __('Pilih Pendidikan') }}</option>
                                                <option value='S2'>S2</option>
                                                <option value='S1'>S1</option>
                                                <option value='D4'>D4</option>
                                                <option value='D3'>D3</option>
                                                <option value='D2'>D2</option>
                                                <option value='D1'>D1</option>
                                                <option value='SMA'>SMA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 container1">
                                            <input id="tahun_masuk1" type="text" class="form-control @error('tahun_masuk1') is-invalid @enderror" name="tahun_masuk1" required placeholder="{{ __('Tahun Masuk') }}">
                                            @error('tahun_masuk1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 container1">
                                            <input id="tahun_keluar1" type="text" class="form-control @error('tahun_keluar1') is-invalid @enderror" name="tahun_keluar1" required placeholder="{{ __('Tahun Keluar') }}">
                                            @error('tahun_keluar1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5 container1">
                                            <input id="sekolah1" type="text" class="form-control @error('sekolah1') is-invalid @enderror" name="sekolah1" required placeholder="{{ __('Nama Institusi/Sekolah') }}">
                                            @error('sekolah1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">Pendidikan 2</span>
                                        <div class="col-md-1">
                                            <select class="form-control selectize" id="pendidikan_2" name="pendidikan_2" required>
                                                <option value="" selected disabled>{{ __('Pilih Pendidikan') }}</option>
                                                <option value='SMA'>SMA</option>
                                                <option value='SMP'>SMP</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 container1">
                                            <input id="tahun_masuk2" type="text" class="form-control @error('tahun_masuk2') is-invalid @enderror" name="tahun_masuk2" required placeholder="{{ __('Tahun Masuk') }}">
                                            @error('tahun_masuk2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 container1">
                                            <input id="tahun_keluar2" type="text" class="form-control @error('tahun_keluar2') is-invalid @enderror" name="tahun_keluar2" required placeholder="{{ __('Tahun Keluar') }}">
                                            @error('tahun_keluar2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5 container1">
                                            <input id="sekolah2" type="text" class="form-control @error('sekolah2') is-invalid @enderror" name="sekolah2" required placeholder="{{ __('Nama Institusi/Sekolah') }}">
                                            @error('sekolah2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">Pendidikan 3</span>
                                        <div class="col-md-1">
                                            <select class="form-control selectize" id="pendidikan_3" name="pendidikan_3" required>
                                                <option value="" selected disabled>{{ __('Pilih Pendidikan') }}</option>
                                                <option value='SMP'>SMP</option>
                                                <option value='SD'>SD</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 container1">
                                            <input id="tahun_masuk3" type="text" class="form-control @error('tahun_masuk3') is-invalid @enderror" name="tahun_masuk3" required placeholder="{{ __('Tahun Masuk') }}">
                                            @error('tahun_masuk3')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 container1">
                                            <input id="tahun_keluar3" type="text" class="form-control @error('tahun_keluar3') is-invalid @enderror" name="tahun_keluar3" required placeholder="{{ __('Tahun Keluar') }}">
                                            @error('tahun_keluar3')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5 container1">
                                            <input id="sekolah3" type="text" class="form-control @error('sekolah3') is-invalid @enderror" name="sekolah3" required placeholder="{{ __('Nama Institusi/Sekolah') }}">
                                            @error('sekolah3')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <h6 class="heading-small text-muted mb-4">{{ __('Pengalaman Kerja') }}</h6>

                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">Pengalaman 1</span>
                                        <div class="col-md-2 container1">
                                            <input id="tanggal_masukkerja1" type="text" class="form-control datepick" name="tanggal_masukkerja1" id="tanggal_masukkerja1" autocomplete="off" placeholder="{{ __('Tanggal Masuk')}}" data-date-format="dd-mm-yyyy">
                                            @error('tanggal_masukkerja1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <script>
                                                $('#tanggal_masukkerja1').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                                });
                                            </script>
                                        </div>
                                        <div class="col-md-2 container1">
                                            <input id="tanggal_keluarkerja1" type="text" class="form-control datepick" name="tanggal_keluarkerja1" id="tanggal_keluarkerja1" autocomplete="off" placeholder="{{ __('Tanggal Keluar')}}" data-date-format="dd-mm-yyyy">
                                            @error('tanggal_keluarkerja1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <script>
                                                $('#tanggal_keluarkerja1').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                                });
                                            </script>
                                        </div>
                                        <div class="col-md-3 container1">
                                            <input id="perusahaan1" type="text" class="form-control @error('perusahaan1') is-invalid @enderror" name="perusahaan1" placeholder="{{ __('Nama Perusahaan') }}">
                                            @error('perusahaan1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 container1">
                                            <input id="jabatan1" type="text" class="form-control @error('jabatan1') is-invalid @enderror" name="jabatan1" placeholder="{{ __('Jabatan') }}">
                                            @error('jabatan1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">Pengalaman 2</span>
                                        <div class="col-md-2 container1">
                                            <input id="tanggal_masukkerja2" type="text" class="form-control datepick" name="tanggal_masukkerja2" id="tanggal_masukkerja2" autocomplete="off" placeholder="{{ __('Tanggal Masuk')}}" data-date-format="dd-mm-yyyy">
                                            @error('tanggal_masukkerja2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <script>
                                                $('#tanggal_masukkerja2').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                                });
                                            </script>
                                        </div>
                                        <div class="col-md-2 container1">
                                            <input id="tanggal_keluarkerja2" type="text" class="form-control datepick" name="tanggal_keluarkerja2" id="tanggal_keluarkerja2" autocomplete="off" placeholder="{{ __('Tanggal Keluar')}}" data-date-format="dd-mm-yyyy">
                                            @error('tanggal_keluarkerja2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <script>
                                                $('#tanggal_keluarkerja2').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                                });
                                            </script>
                                        </div>
                                        <div class="col-md-3 container1">
                                            <input id="perusahaan2" type="text" class="form-control @error('perusahaan2') is-invalid @enderror" name="perusahaan2" placeholder="{{ __('Nama Perusahaan') }}">
                                            @error('perusahaan2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-3 container1">
                                            <input id="jabatan2" type="text" class="form-control @error('jabatan2') is-invalid @enderror" name="jabatan2" placeholder="{{ __('Jabatan') }}">
                                            @error('jabatan2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <h6 class="heading-small text-muted mb-4">{{ __('Upload') }}</h6>

                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('CV') }}</span>
                                        <div class="col-md-4">
                                            <input type="file" class="form-control" name="file_cv" id="file_cv" accept="application/pdf" required>
                                            <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file ...MB dengan format (pdf)
                                        </div>
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Foto Diri') }}</span>
                                        <div class="col-md-4">
                                            <input type="file" class="form-control" name="file_foto" id="file_foto" accept="image/png, image/jpg, image/jpeg" required>
                                            <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file ...MB dengan format (png, jgp, jpeg)
                                        </div>
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('KTP') }}</span>
                                        <div class="col-md-4">
                                            <input type="file" class="form-control" name="file_ktp" id="file_ktp" accept="image/png, image/jpg, image/jpeg" required>
                                            <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file ...MB dengan format (png, jgp, jpeg)
                                        </div>
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('KK') }}</span>
                                        <div class="col-md-4">
                                            <input type="file" class="form-control" name="file_kk" id="file_kk" accept="image/png, image/jpg, image/jpeg" required>
                                            <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file ...MB dengan format (png, jgp, jpeg)
                                        </div>
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Ijazah Terakhir') }}</span>
                                        <div class="col-md-4">
                                            <input type="file" class="form-control" name="file_ijazah" id="file_ijazah" accept="image/png, image/jpg, image/jpeg" required>
                                            <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file ...MB dengan format (png, jgp, jpeg)
                                        </div>
                                    </div>

                                    <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <span class="col-md-2 col-form-label text-md-right">{{ __('Ubah Password') }}</span>
                                            <div class="col-md-4">
                                                <input id="password" type="password" class="form-control form-control-alternative @error('password') is-invalid @enderror" name="password" value="" autofocus placeholder="Masukkan Password Baru Anda">
                                                <!-- <small></small> -->

                                                @error('password')
                                                    <span class="invalid-feedback" permission="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <span class="col-md-2 col-form-label text-md-right">{{ __('Ulangi Password') }}</span>
                                            <div class="col-md-4">
                                                <input id="ulangi_password" type="password" class="form-control form-control-alternative @error('ulangi_password') is-invalid @enderror" name="ulangi_password" value="" autofocus placeholder="Masukkan Kembali Password Baru Anda">
                                                <!-- <small></small> -->

                                                @error('ulangi_password')
                                                    <span class="invalid-feedback" permission="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <hr class="my-4" />
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                        {{-- <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <!-- <h3 class="name_lokasi">Tabel Data Pegawai</h3> -->
                            <div class="table-responsive data-user">
                                <table class="table table-striped table-sm ajax-table" id="user-lihat-table">
                                    <thead>

                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div> --}}
                        <!-- <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                            <p class="description">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth.</p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
