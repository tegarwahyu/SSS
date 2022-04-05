<!-- js script -->
<script type="text/javascript">
    /*datatable setup*/
    var table = $('.ajax-table').DataTable({
        language: {
            paginate: {
              next: '&#8594;', // or '→'
              previous: '&#8592;' // or '←'
            }
        },
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: '{{ url("/admin/permissions/getdata") }}',
        columns: [
            {
                'defaultContent' : '',
                'data'           : 'DT_RowIndex',
                'name'           : 'DT_RowIndex',
                'title'          : '',
                'render'         : null,
                'orderable'      : false,
                'searchable'     : false,
                'exportable'     : false,
                'printable'      : true,
                'footer'         : '',
            },
            {data: 'name', name: 'name'},
            {data: 'guard_name', name: 'guard_name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
              { "width": "150px", "targets": 3 },
              { "searchable": false, "orderable": false, "targets": 0 },
            ],
        "order": [[ 1, 'asc' ]],
    });

    function editForm(id){
        save_method = 'edit';
        url = "permissions/" +id+"/edit";
        $('.ajax-form')[0].reset();
        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('#id').val(data.id);
                $('#name').val(data.name);
                console.log(data);
            }
        });
    }


    function deleteData(id){
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        $.confirm({
            title: "{{ __('Delete Confirmation') }}",
            content: "{{ __('Are you sure to delete ?') }}",
            buttons: {
                delete: {
                    btnClass: 'btn-danger',
                    action: function(){
                        url = "permissions/" +id;
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {_method: 'delete', '_token' : csrf_token },
                            success: function(data){
                                $('.ajax-form')[0].reset();
                                table.ajax.reload();
                                $.alert('Deleted!');
                            },
                            error: function(data){
                            }
                        });
                    },
                },
                cancel: function(){
                    $.alert('Canceled!');
                }
            }
        });
    }

    $(".ajax-form").validate({
        rules: {
            name : {required: true, minlength: 2},
        },
        submitHandler: function(form){
            save_method = (typeof save_method !== 'undefined') ? save_method : 'new';
            var id = $('#id').val();
            base_url = "permissions";
            url =  (save_method == 'new') ? base_url : base_url + '/' + id ;
            type = (save_method == 'new') ? "POST" : "PUT";
            alert = (save_method == 'new') ? 'Permission created!' : 'Permission updated!';

            $.ajax({
                url: url,
                type: type,
                data: $('.ajax-form').serialize(),
                success: function($data){
                    $.alert(alert);
                    $('.ajax-form')[0].reset();
                    table.ajax.reload();
                },
                error: function($data){
                }
            });
        }
    });

</script>
