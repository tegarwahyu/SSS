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
                                <form id="form-upload" action="{{ route('editPassword') }}" method="post" enctype="multipart/form-data">
                                    {{method_field('post')}}
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
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $dataUser[0]->full_name_user }}" required autocomplete="name" autofocus>

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
                                            <input id="ktp" type="text" class="form-control @error('ktp') is-invalid @enderror" name="ktp" value="{{ $dataUser[0]->ktp }}" required autofocus placeholder="{{ __('KTP') }}">

                                            @error('ktp')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <input id="kk" type="text" class="form-control @error('kk') is-invalid @enderror" name="kk" value="{{ $dataUser[0]->kk }}" required autofocus placeholder="{{ __('KK') }}">

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
                                            <textarea id="alamat_ktp" type="text" class="form-control @error('alamat_ktp') is-invalid @enderror" name="alamat_ktp" value="{{ $dataUser[0]->almt_ktp }}" required>{{ $dataUser[0]->almt_ktp }}</textarea>

                                            @error('alamat_ktp')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <textarea id="alamat_domisili" type="text" class="form-control @error('alamat_domisili') is-invalid @enderror" name="alamat_domisili" value="{{ $dataUser[0]->almt_domisili }}" required>{{ $dataUser[0]->almt_domisili }}</textarea>

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
                                            <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $dataUser[0]->tlp_hp }}" required autofocus placeholder="{{ __('No. Hp') }}">

                                            @error('no_hp')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5">
                                            <input id="no_telp" type="passport" class="form-control" name="no_telp" value="{{ $dataUser[0]->tlp_rumah }}" placeholder="{{ __('No. Telepon') }}">
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
                                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $dataUser[0]->email }}" required autofocus placeholder="{{ __('Email') }}">
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
                                            <input id="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" name="tempat_lahir" value="{{ $dataUser[0]->tempat_lahir }}" required placeholder="{{ __('Tempat Lahir') }}">
                                            @error('tempat_lahir')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-5 container1">
                                            <input id="tanggal_lahir" type="text" class="form-control datepick" name="tanggal_lahir" id="tanggal_lahir" autocomplete="off" required placeholder="{{ __('Tanggal Lahir')}}" data-date-format="dd-mm-yyyy">
                                            
                                            <script>
                                                $('#tanggal_lahir').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                                });
                                                var tgl_lahir = '<?php echo $dataUser[0]->tanggal_lahir; ?>';
                                                $('#tanggal_lahir').datepicker('setDate', new Date(tgl_lahir));
                                            </script>
                                            @error('tanggal_lahir')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <h6 class="heading-small text-muted mb-4">{{ __('Riwayat Pendidikan') }}</h6>

                                    <div class="row">
                                        <span class="col-md-2"></span>
                                        <div class="col-md-2">Jenjang</div>
                                        <div class="col-md-1">Tahun Masuk</div>
                                        <div class="col-md-1">Tahun Keluar</div>
                                        <div class="col-md-5">Institusi / Sekolah</div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="col-md-2"></span>
                                        <div class="col-md-2">
                                            <select class="form-control selectize" id="pendidikan_1" name="pendidikan_1" required>
                                                <option value="" selected disabled>{{ __('Pilih') }}</option>
                                                <option value='S2'>S2</option>
                                                <option value='S1'>S1</option>
                                                <option value='D4'>D4</option>
                                                <option value='D3'>D3</option>
                                                <option value='D2'>D2</option>
                                                <option value='D1'>D1</option>
                                                <option value='SMA'>SMA</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1 container1">
                                            <input id="tahun_masuk1" type="text" class="form-control @error('tahun_masuk1') is-invalid @enderror" name="tahun_masuk1" required placeholder="{{ date('Y') }}">
                                            @error('tahun_masuk1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-1 container1">
                                            <input id="tahun_keluar1" type="text" class="form-control @error('tahun_keluar1') is-invalid @enderror" name="tahun_keluar1" required placeholder="{{ date('Y') }}">
                                            @error('tahun_keluar1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 container1">
                                            <input id="sekolah1" type="text" class="form-control @error('sekolah1') is-invalid @enderror" name="sekolah1" required placeholder="{{ __('Nama Institusi/Sekolah') }}">
                                            @error('sekolah1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <script>
                                            $("#pendidikan_1").selectize({
                                                allowEmptyOption: true,
                                                placeholder: "Jenjang",
                                                create: false,
                                            });
                                            var data = '<?php echo $dataUser[0]->pendidikan ?>';
                                            if(data == null || data == ''){
                                                
                                            }else{
                                                
                                                var pendidikan1 = JSON.parse('<?php echo $dataUser[0]->pendidikan; ?>');
                                                $('#pendidikan_1')[0].selectize.setValue(pendidikan1.sekolah1.jenjang1);
                                                $('#tahun_masuk1').val(pendidikan1.sekolah1.thn_masuk1);
                                                $('#tahun_keluar1').val(pendidikan1.sekolah1.thn_keluar1);
                                                $('#sekolah1').val(pendidikan1.sekolah1.nama1);
                                                
                                                
                                            }
                                            
                                            
                                        </script>
                                    </div>

                                    <div class="form-group row">
                                        <span class="col-md-2"></span>
                                        <div class="col-md-2">
                                            <select class="form-control selectize" id="pendidikan_2" name="pendidikan_2" required>
                                                <option value="" selected disabled>{{ __('Pilih') }}</option>
                                                <option value='SMA'>SMA</option>
                                                <option value='SMP'>SMP</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1 container1">
                                            <input id="tahun_masuk2" type="text" class="form-control @error('tahun_masuk2') is-invalid @enderror" name="tahun_masuk2" required placeholder="{{ date('Y') }}">
                                            @error('tahun_masuk2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-1 container1">
                                            <input id="tahun_keluar2" type="text" class="form-control @error('tahun_keluar2') is-invalid @enderror" name="tahun_keluar2" required placeholder="{{ date('Y') }}">
                                            @error('tahun_keluar2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 container1">
                                            <input id="sekolah2" type="text" class="form-control @error('sekolah2') is-invalid @enderror" name="sekolah2" required placeholder="{{ __('Nama Institusi/Sekolah') }}">
                                            @error('sekolah2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <script>
                                            $("#pendidikan_2").selectize({
                                                allowEmptyOption: true,
                                                placeholder: "Pilih Jenjang 2",
                                                create: false,
                                            });
                                            var data = '<?php echo $dataUser[0]->pendidikan ?>';
                                            if(data == null || data == ''){
                                                
                                            }else{
                                                var pendidikan2 = JSON.parse('<?php echo $dataUser[0]->pendidikan; ?>');
                                                $('#pendidikan_2')[0].selectize.setValue(pendidikan2.sekolah2.jenjang2);
                                                $('#tahun_masuk2').val(pendidikan2.sekolah2.thn_masuk2);
                                                $('#tahun_keluar2').val(pendidikan2.sekolah2.thn_keluar2);
                                                $('#sekolah2').val(pendidikan2.sekolah2.nama2);
                                            }
                                            
                                            
                                        </script>
                                    </div>

                                    <div class="form-group row">
                                        <span class="col-md-2"></span>
                                        <div class="col-md-2">
                                            <select class="form-control selectize" id="pendidikan_3" name="pendidikan_3" required>
                                                <option value="" selected disabled>{{ __('Pilih') }}</option>
                                                <option value='SMP'>SMP</option>
                                                <option value='SD'>SD</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1 container1">
                                            <input id="tahun_masuk3" type="text" class="form-control @error('tahun_masuk3') is-invalid @enderror" name="tahun_masuk3" required placeholder="{{ date('Y') }}">
                                            @error('tahun_masuk3')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-1 container1">
                                            <input id="tahun_keluar3" type="text" class="form-control @error('tahun_keluar3') is-invalid @enderror" name="tahun_keluar3" required placeholder="{{ date('Y') }}">
                                            @error('tahun_keluar3')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 container1">
                                            <input id="sekolah3" type="text" class="form-control @error('sekolah3') is-invalid @enderror" name="sekolah3" required placeholder="{{ __('Nama Institusi/Sekolah') }}">
                                            @error('sekolah3')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <script>
                                            $("#pendidikan_3").selectize({
                                                allowEmptyOption: true,
                                                placeholder: "Pilih Jenjang 2",
                                                create: false,
                                            });
                                            var data = '<?php echo $dataUser[0]->pendidikan ?>';
                                            if(data == null || data == ''){
                                                
                                            }else{
                                                var pendidikan3 = JSON.parse('<?php echo $dataUser[0]->pendidikan; ?>');
                                                $('#pendidikan_3')[0].selectize.setValue(pendidikan3.sekolah3.jenjang3);
                                                $('#tahun_masuk3').val(pendidikan3.sekolah3.thn_masuk3);
                                                $('#tahun_keluar3').val(pendidikan3.sekolah3.thn_keluar3);
                                                $('#sekolah3').val(pendidikan3.sekolah3.nama3); 
                                            }
                                            
                                            
                                        </script>
                                    </div>

                                    <h6 class="heading-small text-muted mb-4">{{ __('Pengalaman Kerja') }}</h6>

                                    <div class="row">
                                        <span class="col-md-2"></span>
                                        <div class="col-md-2">Tahun Masuk</div>
                                        <div class="col-md-2">Tahun Keluar</div>
                                        <div class="col-md-3">Nama Instansi</div>
                                        <div class="col-md-3">Jabatan</div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass"></span>
                                        <div class="col-md-2 container1">
                                            <input id="tanggal_masukkerja1" type="text" class="form-control datepick" name="tanggal_masukkerja1" id="tanggal_masukkerja1" autocomplete="off" placeholder="{{ __('Tanggal Masuk')}}" data-date-format="dd-mm-yyyy">
                                            @error('tanggal_masukkerja1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 container1">
                                            <input id="tanggal_keluarkerja1" type="text" class="form-control datepick" name="tanggal_keluarkerja1" id="tanggal_keluarkerja1" autocomplete="off" placeholder="{{ __('Tanggal Keluar')}}" data-date-format="dd-mm-yyyy">
                                            @error('tanggal_keluarkerja1')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
                                        <script>
                                            $('#tanggal_masukkerja1').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                            });

                                            $('#tanggal_keluarkerja1').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                            });

                                            var data = '<?php echo $dataUser[0]->p_kerja ?>';
                                            if(data == null || data == ''){

                                            }else{
                                                var p_kerja = JSON.parse('<?php echo $dataUser[0]->p_kerja; ?>');
                                                $('#tanggal_masukkerja1').datepicker('setDate', new Date(p_kerja.pengalaman1.tgl_msk1));
                                                $('#tanggal_keluarkerja1').datepicker('setDate', new Date(p_kerja.pengalaman1.tgl_klr1));
                                                $('#perusahaan1').val(p_kerja.pengalaman1.nama1);
                                                $('#jabatan1').val(p_kerja.pengalaman1.jbtn1);
                                                $('#tanggal_masukkerja1').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                                });   
                                            }
                                            
                                        </script>
                                    </div>

                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass"></span>
                                        <div class="col-md-2 container1">
                                            <input id="tanggal_masukkerja2" type="text" class="form-control datepick" name="tanggal_masukkerja2" id="tanggal_masukkerja2" autocomplete="off" placeholder="{{ __('Tanggal Masuk')}}">
                                            @error('tanggal_masukkerja2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2 container1">
                                            <input id="tanggal_keluarkerja2" type="text" class="form-control datepick" name="tanggal_keluarkerja2" id="tanggal_keluarkerja2" autocomplete="off" placeholder="{{ __('Tanggal Keluar')}}">
                                            @error('tanggal_keluarkerja2')
                                                <span class="invalid-feedback" permission="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
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
                                        <script>
                                            $('#tanggal_masukkerja2').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                            });

                                            $('#tanggal_keluarkerja2').datepicker({
                                                    format: "dd/mm/yyyy",
                                                    autoclose: true,
                                            });
                                            
                                            var data = '<?php echo $dataUser[0]->p_kerja ?>';
                                            if(data == null || data == ''){

                                            }else{
                                                var p_kerja2 = JSON.parse('<?php echo $dataUser[0]->p_kerja; ?>');
                                                    console.log(p_kerja2.pengalaman2);
                                                $('#tanggal_masukkerja2').datepicker('setDate', new Date(p_kerja2.pengalaman2.tgl_msk2));
                                                $('#tanggal_keluarkerja2').datepicker('setDate', new Date(p_kerja2.pengalaman2.tgl_klr2));
                                                $('#perusahaan2').val(p_kerja2.pengalaman2.nama2);
                                                $('#jabatan2').val(p_kerja2.pengalaman2.jbtn2);
                                            }

                                        </script>
                                    </div>

                                    <h6 class="heading-small text-muted mb-4">{{ __('Upload') }}</h6>

                                    <div class="form-group row">
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('CV') }}</span>
                                        <div class="col-md-4">
                                            @if($dataUser[0]->resume == null || $dataUser[0]->resume == '' )
                                                <input type="file" class="form-control" name="file_cv" id="file_cv" accept="application/pdf" required>
                                                <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file ...MB dengan format (pdf)
                                            @else
                                            <a href="#" id="btn-cv" class="btn btn-primary btn-sm">Lihat CV</a>
                                            <script>
                                                var pathname = window.location.origin + '/file_upload/<?= $dataUser[0]->employee_id ?>/<?= $dataUser[0]->resume ?>';
                                                $("#btn-cv").attr("href", pathname);
                                            </script>
                                            @endif
                                        </div><br>
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Foto Diri') }}</span>
                                        <div class="col-md-4">
                                        
                                            @if($dataUser[0]->f_diri == null || $dataUser[0]->f_diri == '' )
                                                <input type="file" class="form-control" name="file_foto" id="file_foto" accept="image/png, image/jpg, image/jpeg" required>
                                                <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file ...MB dengan format (png, jgp, jpeg)
                                            @else
                                                <a href="#" id="btn-f-diri" class="btn btn-primary btn-sm">Lihat Foto Diri</a>
                                                <script>
                                                var pathname = window.location.origin + '/file_upload/<?= $dataUser[0]->employee_id ?>/<?= $dataUser[0]->f_diri ?>';
                                                $("#btn-f-diri").attr("href", pathname);
                                            </script>
                                            @endif

                                        </div>
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('KTP') }}</span>
                                        <div class="col-md-4">
                                            
                                            @if($dataUser[0]->f_ktp == null || $dataUser[0]->f_ktp == '' )
                                                <input type="file" class="form-control" name="file_ktp" id="file_ktp" accept="image/png, image/jpg, image/jpeg" required>
                                                <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file ...MB dengan format (png, jgp, jpeg)
                                            @else
                                                <a href="#" id="btn-ktp" class="btn btn-primary btn-sm" >Lihat Foto KTP</a>
                                                <script>
                                                var pathname = window.location.origin + '/file_upload/<?= $dataUser[0]->employee_id ?>/<?= $dataUser[0]->f_ktp ?>';
                                                $("#btn-ktp").attr("href", pathname);
                                            </script>
                                            @endif

                                        </div>
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('KK') }}</span>
                                        <div class="col-md-4">

                                            @if($dataUser[0]->f_kk == null || $dataUser[0]->f_kk == '' )
                                                <input type="file" class="form-control" name="file_kk" id="file_kk" accept="image/png, image/jpg, image/jpeg" required>
                                                <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file ...MB dengan format (png, jgp, jpeg)
                                            @else
                                                <a href="#" id="btn-kk" class="btn btn-primary btn-sm">Lihat Foto KK</a>
                                                <script>
                                                var pathname = window.location.origin + '/file_upload/<?= $dataUser[0]->employee_id ?>/<?= $dataUser[0]->f_kk ?>';
                                                $("#btn-kk").attr("href", pathname);
                                            </script>
                                            @endif

                                        </div>
                                        <span class="col-md-2 col-form-label text-md-right labelclass">{{ __('Ijazah Terakhir') }}</span>
                                        <div class="col-md-4">

                                            @if($dataUser[0]->f_ijazah == null || $dataUser[0]->f_ijazah == '' )
                                                <input type="file" class="form-control" name="file_ijazah" id="file_ijazah" accept="image/png, image/jpg, image/jpeg" required>
                                                <p class="form-text text-muted" style="font-size: 10px;">*Max ukuran file ...MB dengan format (png, jgp, jpeg)
                                            @else
                                                <a href="#" id="btn-ijazah" class="btn btn-primary btn-sm">Lihat Foto KK</a>
                                                <script>
                                                var pathname = window.location.origin + '/file_upload/<?= $dataUser[0]->employee_id ?>/<?= $dataUser[0]->f_ijazah ?>';
                                                $("#btn-ijazah").attr("href", pathname);
                                            </script>
                                            @endif

                                        </div>
                                    </div>
                                    
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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
