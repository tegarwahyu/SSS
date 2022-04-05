<div class="col-md-12 dasboard-bg-color">

    <div class="card">
      <div class="card-header">
        SPT-ku
      </div>
      <div class="card-body table-responsive">
        <table id="penomoran-spt" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
            <thead></thead>
            <tbody></tbody>
        </table>
      </div>
    </div>

    <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalPemeriksaan" aria-hidden="true" id="modalPemeriksaan">
      <div class="modal-dialog modal-xl" style="max-width: 75%;">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="mySmallModalPemeriksaan">Pemeriksaan</h4>
            <button type="button" class="close" id="close-pemeriksaan" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card">
              <div class="card-header">
                Laporan Pemeriksaan per SPT
              </div>
              <div class="card-body table-responsive">
                <table id="uploadLaporan-spt" class="table table-striped table-sm ajax-table" style="border-collapse: collapse;margin: 0;padding: 0;width: 100%;">
                    <thead></thead>
                    <tbody></tbody>
                </table>
                <p>1. button untuk pengawas belum terpisah antara ketuatim dan pengawas dll <br> 2. printnya ada error untuk status['dalnis']</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- modal note -->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel2" aria-hidden="true" id="modalFormCatatanLaporan2">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="mySmallModalLabel2">Form Note Penolakan Laporan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="ajax-form" id="form-note2">
                @csrf
                <input type="hidden" name="id" id="laporan-id2">
                <div class="form-group row">
                    <label for="nomor" class="col-sm-4 col-form-label">{{ __('Note')}} </label>                
                    <textarea rows="5" id="note" class="summernote form-control form-control-alternative @error('note') is-invalid @enderror" name="note" ></textarea>                
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i><span>Simpan</span></button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- modal perbaikan laporan -->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myModalReupload2" aria-hidden="true" id="modalFormReuploadLaporan">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalReupload2">Form Revisi Laporan Auditor</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="ajax-form" id="form-Reupload">
                @csrf
                <input type="hidden" name="id" id="id-laporan" >
                <div class="form-group row">
                    <div class="col-md-6">
                        <span class="col-md-8 col-form-label text-md-right">{{ __('Kode Temuan') }}</span>
                    </div>
                        <input type="number" id="kode-isi" name="isi[kode]" class="form-control" placeholder="{{ __('kode')}}">
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <span class="col-md-8 col-form-label text-md-right">{{ __('Kriteria') }}</span>             
                    </div>
                            <textarea type="text" id="kriteria-isi" class="form-control @error('kriteria') is-invalid @enderror" name="isi[kriteria]"placeholder="{{ __('kriteria')}}" value="isi[kriteria]"></textarea>
                                <span class="invalid-kriteria" permission="alert"></span>
                </div>

                <div class="form-group row">
                    <input type="hidden" name="id" id="Reupload-laporan-id">
                    <label for="nomor" class="col-sm-2 col-form-label">{{ __('Memo')}} </label>             
                    <textarea id="note2" class="summernote form-control form-control-alternative @error('note2') is-invalid @enderror" name="note2" placeholder="{{ __('note2')}}"></textarea>
                    <input type="file" class="form-control" name="file" id="file">
                    <small class="form-text text-muted">Please upload file with .doc, .docx ekstension. Size of word should not be more than 2MB.</small>
                </div>
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i><span>Simpan</span></button>
            </form>
          </div>
        </div>
      </div>
    </div>

</div>
    

<script type="text/javascript">

    /*datatable setup*/
    
    var table = $('#penomoran-spt').DataTable({        
        'pageLength': 50,
        dom: '<"col-md-12 row"<"col-md-6"B><"col"f>>rtlp',
        buttons:[ {extend:'excel', title:'Daftar SPT'}, {extend:'pdf', title:'Daftar SPT'} ],
        language: {
            paginate: {
              next: '&gt;', 
              previous: '&lt;' 
            }
        },
        "opts": {
          "theme": "bootstrap",
        },
        processing: true,
        serverSide: true,
        ajax: '{{ url("spt/myspt") }}',
        deferRender: true,
        columns: [
            {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
            },
            {data: 'name', name: 'name', 'title': "{{ __('Nama SPT') }}"},
            {data: 'jenis_spt', name: 'jenis_spt', 'title': "{{ __('Jenis SPT') }}"},
            {data: 'lokasi', name: 'lokasi', 'title': "{{ __('Lokasi') }}"},
            {data: 'lama_detail', name: 'lama_detail', title: 'lama (jam)'},
            {data: 'dupak', name: 'dupak', 'title': "{{ __('Dupak') }}"},
            {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
        ],        
        "order": [[ 1, 'asc' ]],
    });

    function showModalPemeriksaan(id){
        $('#modalPemeriksaan').modal('show');

        var url = "/admin/getPemeriksaan/" +id+ "/get";
        var tabelPemeriksaan = $('#uploadLaporan-spt').DataTable({
            retrieve: true,
            paging: false,
            ajax : url,
            type: "GET",
            dataType: "JSON",
            columns: [
                {'defaultContent' : '', 'data' : 'DT_RowIndex', 'name' : 'DT_RowIndex', 'title' : 'No', 'orderable' : false, 'searchable' : false, 'exportable' : true, 'printable' : true
                },
                {data: 'nomor', name: 'nomor', title: 'Nomor SPT'},
                {data: 'name', name: 'name', title: 'Nama SPT'},
                {data: 'lokasi', name: 'lokasi', title: 'Lokasi'},
                {data: 'nama', name: 'nama', title: 'Nama Auditor'},
                {data: 'kode', name: 'kode', title: 'Kode Temuan'},
                // {data: 'kriteriakkp', name: 'kriteriakkp', title: 'kriteria'},
                // {data: 'kondisi', name: 'kondisi',title:'Nama Temuan.'},
                {data: 'jenislaporan', name: 'jenislaporan', title: 'Status Laporan'},
                {data: 'filename', name: 'filename', title: 'Nama File Upload'},
                // {data: 'filename', name: 'filename', 'title': "{{ __('Nama File') }}"},
                {data: 'note', name: 'note', title:'Catatan'},
                {data: 'action', name: 'action', 'orderable': false, 'searchable': false, 'title': "{{ __('Action') }}", 'exportable' : false,'printable': false},
            ],        
            "order": [[ 1, 'asc' ]],
        })

        $('#close-pemeriksaan').on('click', function(){
            tabelPemeriksaan.destroy();
            $('#uploadLaporan-spt').empty();
        });
    }

    function sign(user_id){
        var id = user_id;
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var status = {!! json_encode((array)auth()->user()->id) !!};      
        $.ajax({
            url : '/verifikasi/status',
            type: 'POST',
            data: {id:id, '_token' : csrf_token, status:status},
            success : function(data){
                console.log('success:',data);
                $('#uploadLaporan-spt').DataTable().ajax.reload();
            },
            error: function(error){
                console.log('Error:', error);
            }
        });
    }

    function showRejectFormModal(user_id){
        $('#modalFormCatatanLaporan2').modal('show');
        $('#laporan-id2').val(user_id);
    }
    $('#form-note2').submit(function(event){
            event.preventDefault();
            var form = $(this);
            var id = $('#laporan-id2').val();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var status = {!! json_encode((array)auth()->user()->id) !!};   
            var note = $('#note').val();
            $.ajax({
                url: '/verifikasi/status',
                type: 'post',
                data: {id:id, status:status, '_token' : csrf_token, note:note},
                success: function(data){                    
                    console.log('success:',data);
                    $('#modalFormCatatanLaporan2').modal('hide');
                    $('#uploadLaporan-spt').DataTable().ajax.reload();
                    form[0].reset();
                },
                error: function(error){
                    console.log('Error :', error);
                }
            });
        });

    function showRevisiFormModal(id_laporan){
        $('#form-Reupload')[0].reset();
        $('#modalFormReuploadLaporan').modal('show');
        url = "/admin/laporan-spt/" +id_laporan+ "/edit";
        
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                // console.log(data);                
                $('#kode-isi').val(data.file_laporan.kode);
                $('#kriteria-isi').val(data.file_laporan.kriteriakkp);
                $('#id-laporan').val(data.detail_id);
                // data_isi = JSON.parse(data.status);
                $('#note2').val(data.note);
            },

            error: function(err){ 
            }
        });

    }

    $('#form-Reupload').submit(function(event){
            event.preventDefault();
            var form = $(this);
            var id_laporan = $('#id-laporan').val();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var status = 'pengajuan revisi';
            var kode = $('#kode-isi').val();
            var kriteria = $('#kriteria-isi').val();
            // var isi = val(kode,kriteria);
            var file = $('#file').val();
            var note2 = $('#note2').val();
            $.ajax({
                url: '/revisi/laporan-auditor',
                type: 'post',
                data: {id_laporan:id_laporan, status:status, '_token' : csrf_token, note2:note2, file:file, kode:kode, kriteria:kriteria},
                success: function(data){                    
                    console.log('success:',data);
                    // console.log(data.isi)
                    $('#modalFormReuploadLaporan').modal('hide');
                    $('#form-Reupload')[0].reset();
                    $('#uploadLaporan-spt').DataTable().ajax.reload();
                },
                error: function(error){
                    console.log('Error :', error);
                }
            });
        });

</script>