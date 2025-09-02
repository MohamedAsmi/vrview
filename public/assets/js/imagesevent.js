$(document).on('click', '.rooms-types .image-element', async function () {
    var parent = $(this).closest('.rooms-types');
    var dataId = parent.attr('data-id');

    if (typeof v === 'undefined') {
        console.error('VR viewer (v) is not initialized');
        return;
    }

    var activescene = v.getScene();
    var sceneId = $('input[name=sceneId]').val();
    $("#picon").removeClass('far fa-pause').addClass('far fa-play');

    let getaudioroute = window.appRoutes.getaudioroute;

    v.loadScene(dataId);

    try {
        let response = await $.ajax({
            type: 'POST',
            url: getaudioroute,
            dataType: 'json', // fixed: use "dataType" not "datatype"
            data: {
                currentsceneid: dataId,
                _token: $('meta[name="csrf-token"]').attr('content')

            }
        });

        $('.music').empty();
        if (response.length !== 0) {
            $("#start").hide();
            $("#pButton").show();
            $("#pButtondelete").show();

            $.each(response, function (index, item) {
                if (dataId === item.parent_id) {
                    $('.music').append(
                        '<span id="audio_player">' +
                        '<span class="audio_player"><i id="pButton" class="fas fa-volume-mute"></i></span>' +
                        '<audio id="music" preload="true"><source src="' + item.path + '"/></audio></span>'
                    );
                }
            });
        } else {
            $("#start").show();
            $("#pButton").hide();
            $("#pButtondelete").hide();
        }

    } catch (err) {
        console.error("AJAX error:", err.responseText, err.status, err);
    }
});
