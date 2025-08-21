    $( document ).ready(function() {
    $("#room").sortable({
        start: function(event, ui) {
            var start_pos = ui.item.index();
            ui.item.data('start_pos', start_pos);
        },
        update: function (event, ui) {
                
                var values = $("input[name='imageOrder[]']").map(function(){return $(this).val();}).get()
                console.log(values);
            $.ajax({
                data:{
                        dataId: values,
                    },
                type: 'POST',
                url: "dropzone/upload",
                success: function(response) {
                
                }
            });
            
        }
    });
    $("#room").disableSelection();
});