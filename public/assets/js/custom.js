$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }

});
$(function () {


   

    //- Remove room type.
    

    $(document).on('click', '.rooms-types-add', function(){
        // $('#imageupload').modal('show');
        

    });

});
