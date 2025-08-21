$(document).on('submit', '#addhotspotpost', function(e) {
    var currentsceneid=$('#parant_id').val();
    var access_token =$('#token').val();
    var ddData = $('#imageselect').data('ddslick');
    var sceneId=ddData.selectedData.value;
    e.preventDefault();
    var formData = new FormData(this);
    var scenename = ddData.selectedData.text;
    console.log(scenename);

    formData.append('scenename', scenename);
    formData.append('sceneId', sceneId);
    $.ajax({
        type: 'POST',
        url: "Inserthotspot",
        data: formData,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,

        success: function(response) {
            window.location = "vrview?token="+access_token+"&sceneid="+currentsceneid;
            $('.addhotspot').prop("disabled",false);
        }
    });


});
  $(document).on("click", function(event){
      if(!event.target.className.includes("addhotspot")){
            if(!$(event.target).closest("#draggable").length){
                $( "#draggable" ).remove();
                $('.addhotspot').prop("disabled",false);
            }
        }
    });
     $(document).on("click", "#cancelhotspot", function(event){
        $( "#draggable" ).remove();
        $('.addhotspot').prop("disabled",false);
    });

$(document).on('click', '.addhotspot', function(e) {
    $(this).prop("disabled",true);
    $('.imagerow').append('<div id="draggable" class="ui-widget-content modala"style="top: 61mm;left: 71mm;position: absolute;bottom: 0;z-index: 2;cursor: pointer;"><div id="dragdrop" class="ui-widget-content "style="position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);"><i class="fas fa-circle"style="color: #0084FF;"></i></div><div class="hover"></div><div class="fiststep" style="background: white;width: 268px;height: 46px;margin-left: 80px;margin-top: 4px;border-radius: .25rem;"><span style="font-weight: 700; margin-left: 29px;color: #555766;position: relative;top: 10px;">Please reposition hotspot</span></div><div class="card secondstep" style="height: 47mm;"><div class="card-body"><span style="font-weight: 600;">Link to</span><div class="dragging-option" style="diplay:none"><p>Please reposition hotspot</p></div><form id="addhotspotpost" enctype="multipart/form-data" class="is-readonly"><div class="dragging"><select class="form-control" name="sceneId" id="imageselect"></select><br><div class="pichandyaw"></div><div class="submithotspot"></div></div><div class="modal-footer" style="height: 8mm;margin-top: -31px;margin-right: -18px;"><button type="button" class="btn btn-outline-primary" id="cancelhotspot" data-bs-dismiss="modala">Cancel</button><button type="submit" class="btn btn-primary" id="hotspot">Save</button></div></form></div></div></div>');
    $('.dragging-option').show();
    $('.dragging').hide();
    $('.secondstep').hide();


    $(function() {
        
        $("#draggable").draggable({
            handle: ".fa-circle",
        });
        
        var parant_id = $('input[name=imageid]').val();
        $("#imageselect").empty();
        var parant_id = $('input[name=imageid]').val();
        var coords = v.mouseEventToCoords(event);
        var pitch = 6;
        var yaw = -7;
        $(".pichandyaw").append('<input type="hidden" name="pitch" id="pitch" value="' + pitch + '"><input type="hidden" name="yaw" id="yaw" value="' + yaw + '"><input type="hidden" name="parant_id" id="parant_id" value="' + parant_id + '">');
        var itema=[];
        $.ajax({
            type: "get",
            url: "getimage",
            dataType: 'json',
            data: {
                id: parant_id
            },

            success: function(response) {
                
                jQuery.each(response, function(index, item) {
                    itema.push(item);
                   // $('#imageselect').append('<option value="' + item.id + '">' + item.image_title + '</option>');
                });
            }
        });

      
        $("#panorama").droppable({

            accept: "#draggable",

            drop: function() {
                $('.dragging-option').hide();
                $('.dragging').show();
                $('#hotspot').show();
                $('.fiststep').hide();
                $('.secondstep').show();
                // $("#imageselect").empty();
                $("#pitch").remove();
                $("#yaw").remove();
                var coords = v.mouseEventToCoords(event);
                console.log('coords:', coords);
                var pitch = coords[0];
                var yaw = coords[1];
        
                var parant_id = $('input[name=imageid]').val();
                var propid =$('#propid').val();
		var decrtoken =$('#decrtoken').val();
		var text=[];
                $.ajax({
                    type: "get",
                    url: "getimage",
                    dataType: 'json',
                    data: {
                        id: parant_id,propid:propid,decrtoken:decrtoken
                    },

                    success: function(response) {
                        

                        jQuery.each(response, function(index, item) {
                            if(index==0){
                                var active=true;
                            }else{
                                var active=false;
                            }
                            
                            text.push({text: item.image_title, value: item.id, selected: active, description: item.image_title, imageSrc: item.image},);

                            // $('#imageselect').append('<option value="' + item.id + '">' + item.image_title + '</option>');
                            
                        });
                        // return false;
                        getim(text);

                    }
                    
                });

                async function getim(text){
                    console.log("image");
                   var a =await  $('#imageselect').ddslick({
                        data: text,
                        width: 300,
                        description:"none",
                        imagePosition: "left",
                        truncateDescription: true,
                        selectText: "Choose One",
                        
                    });

                }
                 $('#demoSetSelected').ddslick('destroy');
                
                $(".pichandyaw").append('<input type="hidden" name="pitch" id="pitch" value="' + pitch + '"><input type="hidden" name="yaw" id="yaw" value="' + yaw + '"><input type="hidden" name="parant_id" id="parant_id" value="' + parant_id + '">');



            }
        });

    });

});

$(document).on("click", "#clearhotspot", function() {
   foo(); 
});

var foo = async () => {

    var currentsceneid = v.getScene();
    var access_token =$('#token').val();
    var users = await $.ajax({
        url: "deletehotspot",
        type: "POST",
        dataType: 'json',
        data: {
            SceneId: currentsceneid,
        },
        success: function(response) {

            window.location = "vrview?token="+access_token+"&sceneid="+currentsceneid;
        
        },
    });


}
