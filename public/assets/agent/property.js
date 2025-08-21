
$(document).ready( function () {
    let columns = [
        {
            data: 'id',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'price',
            name: 'price'
        },
        {
            data: 'address',
            name: 'address'
        },
        {
            data: 'address2',
            name: 'address2'
        },
        {
            data: 'room_count',
            name: 'room_count'
        },
        {
            data: 'bath_count',
            name: 'bath_count'
        },
        {
            data: 'status',
            name: 'status'
        },
        {
            data: 'actions',
            name: 'actions'
        },
    ];

    let table =  initDataTable($('#data_table'), columns,'data_tabley');
   
});

$(document).on('click', '.delete', function () {
    $('#delete-modal .modal-title').html('Delete Confirmation');
    $('#delete-modal #ajax-form').attr('method', 'GET');
    $('#delete-modal #ajax-form').attr('action', $(this).attr('data-url'));
    $('#delete-modal #ajax-form').attr('data-table', 'users_table');
    let modal = new bootstrap.Modal(document.getElementById('delete-modal'));
    modal.show();
});


