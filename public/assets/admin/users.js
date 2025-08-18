
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
            data: 'email',
            name: 'email'
        },
        {
            data: 'role',
            name: 'role'
        },
         {
            data: 'mobile',
            name: 'mobile'
        },
        {
            data: 'address',
            name: 'address'
        },
        {
            data: 'nic_images',
            name: 'nic_images'
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

    let table =  initDataTable($('#users_table'), columns,'item_tabley');
   
});

$(document).on('click', '.delete', function () {
    $('#delete-modal .modal-title').html('Delete Confirmation');
    $('#delete-modal #ajax-form').attr('method', 'GET');
    $('#delete-modal #ajax-form').attr('action', $(this).attr('data-url'));
    $('#delete-modal #ajax-form').attr('data-table', 'users_table');
    let modal = new bootstrap.Modal(document.getElementById('delete-modal'));
    modal.show();
});


