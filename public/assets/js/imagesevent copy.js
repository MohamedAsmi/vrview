$(document).on('click', '.rooms-types .image-element', async function () {
        var parent = $(this).closest('.rooms-types');
        var dataId = parent.attr('data-id');
        var activescene = v.getScene();
        var sceneId = $('input[name=sceneId]').val();
            $("#picon").removeClass('far fa-pause').addClass('far fa-play');;
        
        
        v.loadScene(dataId);
        
        var getaudio = await $.ajax({
            type: 'POST',
            url: "getaudio",
            datatype: 'json',
            data:{
                currentsceneid:dataId
            },
            success: function(response) {
                
                $('.music').empty();
                if(response.length != 0){
                    $("#start").hide();
                    $("#pButton").show();
                    $("#pButtondelete").show();
                    jQuery.each(response, function(index, item) {
                        if(currentsceneid=item.parent_id){
                            $('.music').append('<span id="audio_player"> <span class="audio_player"><i id="pButton" class="fas fa-volume-mute"></i></span> <audio id="music" preload="true"><source src="'+item.path+'"/></audio></span> ');
                        }
                        
                    });
                }else{
                    $("#start").show();
                    $("#pButton").hide();
                    $("#pButtondelete").hide();
                    
                }
            }
        });
    })

