$(document).on('click', '.rooms-type-close-btn', function() {
        var parent = $(this).closest('.rooms-types');
        var dataId = parent.attr('data-id');
        var name =parent.attr('name');
        var access_token =$('#token').val();
        var dConfirm = confirm('Do you want to delete  ' + name + "?");
        if (dConfirm) {
            $.ajax({
                url: "DeleteImage",
                type: "POST",
                dataType: 'json',
                data: {
                    dataId: dataId,
                },
                success: function(response) {
                    console.log(response);
                    parent.parent().remove();
                     window.location = "vrview?token=" + access_token;
                    
                },
            });
            
        }
    })