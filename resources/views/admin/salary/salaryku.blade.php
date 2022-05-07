<style>
    .alert {
        width: 500px !important;
        margin: 25px auto !important;
    }
</style>
@extends('layouts.backend')

@section('content')
@include('layouts.headers.cards')
    <div class="container-fluid mt--7 bg-color" style="padding-top: 113px;">
        <div class="row">
            <div class="col-xl-12 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="card-body">
                      <div class="text-center">
                          <h3>{{ __('My Salary') }}</h3>
                      </div>
                      <div class="table-responsive">
                            <table class="table table-striped table-sm ajax-table" id="user-salary-table">
                                <thead>

                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <script>
                      let id = {!! auth()->user()->id !!};
                      // console.log(id);
                      let table = $('#user-salary-table').DataTable({
                          language: {
                              paginate: {
                              next: '&lt;',
                              previous: '&gt;'
                              }
                          },
                          bDestroy: true,
                          processing: true,
                          serverSide: true,
                          deferRender: true,
                          ajax : "{{ url('user/profile/getDataSalaryUserById/') }}" + '/' + id,
                          columns: [
                              {
                                  'defaultContent' : '',
                                  'data'           : 'DT_RowIndex',
                                  'name'           : 'DT_RowIndex',
                                  'title'          : 'No',
                                  'render'         : null,
                                  'orderable'      : false,
                                  'searchable'     : false,
                                  'exportable'     : false,
                                  'printable'      : true,
                                  'footer'         : '',
                              },
                                //{data: 'employee_id', name: 'employee_id', title:'Employee ID'},
                                {data: 'periode', name: 'periode', title:'Periode'},
                                {data: 'pendapatan', name: 'pendapatan', title: 'Pendapatan'},
                                {data: 'potongan', name: 'potongan', title: 'Potongan'},
                                {data: 'total', name: 'total', title: 'Total'},
                                {data: 'action', name: 'action', orderable: false, searchable: false,title: 'Action'},
                          ],
                          'columnDefs': [
                                  {
                                      "targets": '_all', // your case first column
                                      "className": "text-center",
                                      "width": "4%"
                              },
                              {
                                      "targets": 3,
                                      "className": "text-center",
                              }
                              ],
                          "order": [[ 1, 'asc' ]],
                          // $('#salary-table').ajax.reload();
                      });
                    </script>
                </div>
            </div>

        </div>

    </div>
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
