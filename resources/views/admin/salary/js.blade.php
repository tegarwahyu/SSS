<script type="text/javascript">

$("#cari-salary").click(function() {
    // $("#salary-table").buttons( 0, null ).destroy();
    let periode = $('#periode').val();
    let result;
    if (periode == 'januari') {
        result = 1;
    } else if(periode == 'februari'){
        result = 2;
    } else if(periode == 'maret'){
        result = 3;
    } else if(periode == 'april'){
        result = 4;
    } else if(periode == 'mei'){
        result = 5;
    } else if(periode == 'juni'){
        result = 6;
    } else if(periode == 'juli'){
        result = 7;
    } else if(periode == 'agustus'){
        result = 8;
    } else if(periode == 'september'){
        result = 9;
    } else if(periode == 'oktober'){
        result = 10;
    } else if(periode == 'november'){
        result = 11;
    } else {
        result = 12;
    }
    console.log(result);
    let id = result;

    $("#salary-card").css("display", "block");
    // get data tabel
    var table = $('#salary-table').DataTable({
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
        // ajax: '{{ url("admin/hr/getDataSalary") }}' + '/' + id,
        ajax : "{{ url('admin/hr/getDataSalary') }}" + '/' + id,
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
            {data: 'employee_id', name: 'employee_id', title:'Employee ID'},
            {data: 'fullname', name: 'fullname', title: 'Nama'},
            {data: 'pendapatan', name: 'pendapatan', title: 'Pendapatan'},
            {data: 'potongan', name: 'potongan', title: 'Potongan'},
            {data: 'total', name: 'total', title: 'Total'},
            {data: 'action', name: 'action', orderable: false, searchable: false,title: 'Action'},
        ],
        columnDefs: [
            { "width": "150px", "targets": 3 },
            { "searchable": false, "orderable": false, "targets": 0 },
            ],
        "order": [[ 1, 'asc' ]],
        // $('#salary-table').ajax.reload();
    });

});


$('#periode').change(function () {
// var job =  $('#periode').val();
    // alert(job);
    $('#cari-salary').prop('disabled', false);
    $('#btn-import-salary').prop('disabled', false);
    $('#btn-download-tamplate').removeClass('disabled');

})

setTimeout(function() {
    $('.alert').fadeOut('fast');
}, 4500); // <-- time in milliseconds

</script>
