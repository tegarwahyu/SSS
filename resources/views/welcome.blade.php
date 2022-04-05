@extends('layouts.frontend', ['class' => 'bg-default'])

@section('content')
            
            <!-- konten halaman bedasarkan role yang ada yang ditambahkan -->
          @hasanyrole('Inspektur')
          <!-- halaman admin ini  -->
          <div class="header bg-gradient-primary py-7 py-lg-8 default-color">
            <div class="container">
              <div class="header-body text-center mt-7 mb-7">
                  <div class="row justify-content-center">
                      <div class="col-lg-5 col-md-6">
                          <h1 class="text-white">{{ __('Welcome to Argon Dashboard FREE Laravel Live Previews login Inspektur.') }}</h1>
                      </div>
                  </div>
              </div>
            </div>
          </div>
          @else
            @hasanyrole('Super Admin')
            <!-- halaman admin ini  -->
            <div class="header bg-gradient-primary py-7 py-lg-8 default-color">
              <div class="container">
                <div class="header-body text-center mt-7 mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1 class="text-white">{{ __('Welcome to Argon Dashboard FREE Laravel Live Previews login admin.') }}</h1>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            @else
                @hasanyrole('Administrasi Umum')
                <!-- halaman Administrasi Umum ini  -->
                <div class="header bg-gradient-primary py-7 py-lg-8 default-color">
                  <div class="container">
                    <div class="header-body text-center mt-7 mb-7">
                        <div class="row justify-content-center">
                            <div class="col-lg-5 col-md-6">
                                <h1 class="text-white">{{ __('Welcome to Argon Dashboard FREE Laravel Live Previews login Administrasi Umum.') }}</h1>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                @else
                    @hasanyrole('TU Perencanaan')
                    <!-- halaman tu perencanaan -->
                    <div class="header bg-gradient-primary py-7 py-lg-8 default-color">
                      <div class="container">
                        <div class="header-body text-center mt-7 mb-7">
                            <div class="row justify-content-center">
                                <div class="col-lg-5 col-md-6">
                                    <h1 class="text-white">{{ __('Welcome to Argon Dashboard FREE Laravel Live Previews login tu perencanaa.') }}</h1>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    @else
                      @hasanyrole('Auditor')
                      <!-- halaman tu perencanaan -->
                      <div class="header bg-gradient-primary py-7 py-lg-8 default-color">
                        <div class="container">
                          <div class="header-body text-center mt-7 mb-7">
                              <div class="row justify-content-center">
                                  <div class="col-lg-5 col-md-6">
                                      <h1 class="text-white">{{ __('Welcome to Argon Dashboard FREE Laravel Live Previews login Auditor.') }}</h1>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                    @else
                      @hasanyrole('TU Evaluasi')
                        <!-- halaman tu perencanaan -->
                        <div class="header bg-gradient-primary py-7 py-lg-8 default-color">
                          <div class="container">
                            <div class="header-body text-center mt-7 mb-7">
                                <div class="row justify-content-center">
                                    <div class="col-lg-5 col-md-6">
                                        <h1 class="text-white">{{ __('Welcome to Argon Dashboard FREE Laravel Live Previews login Evaluasi.') }}</h1>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      @else
                    <!-- halaman awal guest ini -->
                    <div class="header bg-gradient-new py-7 py-lg-8" style="background: url(assets/img/bg/try3.jpg) !important; min-height: 100%;min-width: 1024px;width: 100%;height: auto;position: fixed;top: 0;left: 0;object-fit: cover; ">
                    </div>
                      <div class="container">
                         <div class="header-body text-center mt-7 mb-7" >
                            <div class="row justify-content-center">
                              <div class="col-lg-5 col-md-6" style="margin-bottom: 245px;">
                                <h1 class="text-white" style="position: relative;margin:0 auto; line-height: 1.4em;margin-top: 308px;"><b>{{ __('INSPEKTORAT DAERAH KABUPATEN SIDOARJO') }}</b></h1>
                              </div>
                            </div>
                         </div>
                       </div>
                       <div class="row justify-content-center mt--800" >
                          <div>
                            <div class="row row-grid">
                              <div class="row justify-content-center">
                                 <div class="col-lg-4">
                                    <div class="card card-lift--hover shadow border-0">
                                        <div class="card-body py-4">
                                          <center>
                                              <div class="icon icon-shape icon-shape-primary rounded-circle mb-4 img-fluid floating">
                                                 <i class="ni ni-send "></i>
                                              </div>
                                          <h2 class="text-primary text-uppercase">Visi</h2><p class="description mt-3">Terciptanya Pengawasan Fungsional Pemerintah Kabupaten Sidoarjo yang Profesional</p></center>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-4">
                                    <div class="card card-lift--hover shadow border-0">
                                      <div class="card-body py-4">
                                       <center>
                                           <div class="icon icon-shape icon-shape-danger rounded-circle mb-4 img-fluid floating">
                                             <i class="ni ni-spaceship"></i>
                                           </div>
                                        <h2 class="text-danger text-uppercase">Misi</h2>
                                        <p class="description mt-3">Menciptakan Aparat Pengawasan Fungsional Pemerintah Yang BerkualitMemiliki Disiplin yang Tinggi</p></center>
                                      </div>
                                    </div>
                                 </div>
                              </div>
                             </div>
                          </div>
                       </div>
                       <div class="row justify-content-center mt--300">
                        <div class="col-lg-4" style="margin-top: 460px;">
                            <h2 class="text-white" style="margin-left: 155px;"><b><i class="ni ni-map-big"></i> Lokasi</b></h2>
                          <div class="card bg-gradient-secondary shadow">
                            <div class="gmap_canvas"><iframe style="margin: 0; padding: 0; width:100%; height: 400px;" id="gmap_canvas" src="https://maps.google.com/maps?q=inspektorat%20sidoarjo&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
                          </div>
                        </div>
                      </div>
                        @endhasanyrole
                      @endhasanyrole
                    @endhasanyrole
                @endhasanyrole
            @endhasanyrole
          @endhasanyrole
            <!-- conten yang di tambahkan  -->
    </div>
    <div class="container mt--10 pb-5"></div>
@endsection
