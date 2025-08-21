$(document).on('click', '#pButtondelete', function () {
    $.ajax({
        type: 'POST',
        url: "deleteaudio",
        datatype: 'json',
        data:{
            currentsceneid:v.getScene(),
        },
        success: function(response) {
            window.location.reload();
        }
        
    });
});