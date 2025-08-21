$(document).on('click', '#pButton', function(){
    var picon = $("#picon");
    // music.paused ? (music.play(), (picon.className = ""), (picon.className = "fa fa-volume-up")) : (music.pause(), (pButton.className = ""), (pButton.className = "fas fa-volume-mute"));
    if(music.paused) {
        music.play();
        picon.removeClass('far fa-play').addClass('far fa-pause');
    }else {
        music.pause();
        picon.removeClass('far fa-pause').addClass('far fa-play');
    }
});
