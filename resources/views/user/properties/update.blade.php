@extends("layouts.master")

@section('title', 'Page Title')

@section('styles')
<link rel="stylesheet" href="assets/css/active.css?t=<?php echo time();?>">
        <link href="{{asset('assets/css/custom.css?v=3.4.2')}}" rel="stylesheet"/>

  <style>
  .toggle { border-radius: 20rem; }
  .closeicon{
      font-weight: 400 !important;
  }
  .switch {
  margin: 4rem auto;
}
/* main styles */
#draggable {
    border-radius: 0%;
    background-image: url(assets/images/drop2.png);
    width: 60px;
    height: 60px;
    background-size: 60px auto;
    background-position: 0px -60px;
}
.switch {
    width: 24rem;
    position: absolute;
    right: 51mm;
}
.switch input {
  position: absolute;
  top: 0;
  z-index: 2;
  opacity: 0;
  cursor: pointer;
}
.switch input:checked {
  z-index: 1;
}
.switch input:checked + label {
  opacity: 1;
  cursor: default;
}
.switch input:not(:checked) + label:hover {
  opacity: 0.5;
}
.switch label {
  color: #495057;
  opacity: 0.33;
  transition: opacity 0.25s ease;
  cursor: pointer;
}
.switch .toggle-outside {
  height: 100%;
  border-radius: 2rem;
  padding: 0.25rem;
  overflow: hidden;
  transition: 0.25s ease all;
}
.switch .toggle-inside {
    border-radius: 5rem;
    background: #61d03e;
    position: absolute;
    margin-top: -2px;
    transition: 0.25s ease all;
}

.switch--horizontal {
  margin: 0 auto;
  font-size: 0;
  margin-bottom: 1rem;
}
.switch--horizontal input {
  height: 3rem;
  width: 6rem;
  left: 6rem;
  margin: 0;
}
.switch--horizontal label {
  font-size: 1.5rem;
  line-height: 3rem;
  display: inline-block;
  width: 6rem;
  height: 100%;
  margin: 0;
  text-align: center;
}
.switch--horizontal label:last-of-type {
    margin-left: 4rem;
    margin-top: -10px;
}
.switch--horizontal .toggle-outside {
    position: absolute;
    width: 68px;
    left: 6rem;
    height: 2rem;
    border: 2px #a4a3b1 solid;
}
.switch--horizontal .toggle-inside {
  height: 1.5rem;
    width: 1.5rem;
}
.switch--horizontal input:checked ~ .toggle-outside .toggle-inside {
  left: 0.25rem;
}
.switch--horizontal input ~ input:checked ~ .toggle-outside .toggle-inside {
  left: 2.25rem;
}
.switch--vertical {
  width: 12rem;
  height: 6rem;
}
.switch--vertical input {
  height: 100%;
  width: 3rem;
  right: 0;
  margin: 0;
}
.switch--vertical label {
  font-size: 1.5rem;
  line-height: 3rem;
  display: block;
  width: 8rem;
  height: 50%;
  margin: 0;
  text-align: center;
}
.switch--vertical .toggle-outside {
  background: #fff;
  position: absolute;
  width: 3rem;
  height: 100%;
  right: 0;
  top: 0;
}
.switch--vertical .toggle-inside {
  height: 2.5rem;
  left: 0.25rem;
  top: 0.25rem;
  width: 2.5rem;
}
.switch--vertical input:checked ~ .toggle-outside .toggle-inside {
  top: 0.25rem;
}
.switch--vertical input ~ input:checked ~ .toggle-outside .toggle-inside {
  top: 3.25rem;
}
.switch--no-label label {
  width: 0;
  height: 0;
  visibility: hidden;
  overflow: hidden;
}
.switch--no-label input:checked ~ .toggle-outside .toggle-inside {
  background: rgba(0,0,0,0.2);
  border: 1px solid rgba(0,0,0,0.2);
}
.switch--no-label input ~ input:checked ~ .toggle-outside {
  background: #fff;
}
.switch--no-label input ~ input:checked ~ .toggle-outside .toggle-inside {
  background: #2ecc71;
}
.switch--no-label.switch--vertical {
  width: 3rem;
}
.switch--no-label.switch--horizontal {
  width: 6rem;
}
.switch--no-label.switch--horizontal input,
.switch--no-label.switch--horizontal .toggle-outside {
  left: 0;
}
.switch--expanding-inner input:checked + label:hover ~ .toggle-outside .toggle-inside {
  height: 2.5rem;
  width: 2.5rem;
}
.switch--expanding-inner.switch--horizontal input:hover ~ .toggle-outside .toggle-inside {
  width: 3.5rem;
}
.switch--expanding-inner.switch--horizontal input:hover ~ input:checked ~ .toggle-outside .toggle-inside {
  left: 2.25rem;
}
.switch--expanding-inner.switch--vertical input:hover ~ .toggle-outside .toggle-inside {
  height: 3.5rem;
}
.switch--expanding-inner.switch--vertical input:hover ~ input:checked ~ .toggle-outside .toggle-inside {
  top: 2.25rem;
}

.pnlm-panorama-info{
    display:none !important;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
    margin-right: 1mm;
}
.loadera {
  position: relative;
  text-align: center;
  margin: 15px auto 35px auto;
  z-index: 9999;
  display: block;
  width: 80px;
  height: 80px;
  border: 10px solid rgba(0, 0, 0, .3);
  border-radius: 50%;
  border-top-color: #0681E1;
  animation: spin 1s ease-in-out infinite;
  -webkit-animation: spin 1s ease-in-out infinite;

}

@keyframes spin {
  to {
    -webkit-transform: rotate(360deg);
  }
}

@-webkit-keyframes spin {
  to {
    -webkit-transform: rotate(360deg);
  }
}
.pnlm-hotspot.pnlm-scene {
    background-position: 0px -60px;
}
.pnlm-sprite {
    background-image: url(assets/images/drop2.png);
    width: 60px;
    height: 60px;
    background-size: 60px auto;
}
.dd-select{
    width: 259px !important;
    background: rgb(238, 238, 238) !important;
}
.dd-desc{
    display:none !important;
}
.dd-options{
    width: 259px !important;
    display: block;
}
.dd-selected{
    overflow: hidden;
    display: block;
    padding: 5px !important;
    font-weight: bold;
}
.dd-option-image, .dd-selected-image{
    vertical-align: middle;
    float: left;
    margin-right: 5px;
    max-width: 75px !important;
}
dd-option-image{    
    height: 9mm !important;
    width: fit-content !important;
}

label {
    display: inline-block;
    margin-bottom: .5rem;
    font-weight: 400 !important;
    margin-top: 6px;
}
div.pnlm-tooltip span {
    visibility: hidden;
    position: absolute;
    border-radius: 3px;
    background-color: white;
    color: green;
    text-align: center;
    max-width: 200px;
    padding: 5px 10px;
    margin-left: -220px;
    cursor: default;
}

div.pnlm-tooltip:hover span:after {
    content: '';
    position: absolute;
    width: 0;
    height: 0;
    border-width: 10px;
    border-style: solid;
    border-color: white transparent transparent transparent;
    bottom: -20px;
    left: -10px;
    margin: 0 50%;
}
div.pnlm-tooltip:hover span {
    margin-left: 63.5px !important;
    margin-top: 7px !important;
}
.fiststep{
    background: white;
    width: 52mm;
    height: 9mm;
    margin-left: 70px;
    margin-top: 6px;
}
.dd-selected-description-truncated{
    visibility: hidden !important;
}
</style>
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<div class="container">
    <div class="row mt-2">
        <div class="col-md-5 rooms-container">
            <table class="table table-bordered">
                <tr>
                    <th style="color: #555766;">Rooms
                        <div class="float-right">
                            <a href="{{ url('/preview?token=fsdfdf') }}"  target="_blank"><button class="btn btn-outline-primary" ><i class="fal fa-presentation" style="padding-right: 4px;"></i>Preview</button></a>
                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#publish"><i class="fas fa-circle" style="@if($onoffstatus == null or $onoffstatus==0) color:#e4e3e3; @else color:#61d03e; @endif;"></i> Publish
                            </button>
                        </div>
                    </th>
                </tr>
                <tr>
                    <td>
                     @if(isset($images_order))
                        <div class="row ui-sortable rda" id="room">
                           <input type="hidden" name="token" value="{{$token}}" id="token">
                           <input type="hidden" name="propid" value="{{$propid}}" id="propid">
                           <input type="hidden" name="decrtoken" value="{{$decrtoken}}" id="decrtoken">
                            @foreach($images_order->sortBy('order_id') as $key=>$image)
  
                            <div class="col-6 m-b-20 ui-sortable-handle" id="parent" draggable="false">
                                <div class="rooms-types card-sub <?php if(isset($_GET['sceneid'])){if($_GET['sceneid'] == $image->id){echo "active";}}else{if($key == 0){echo "active";}}?>" id="rooms-types" data-id='{{$image->id}}' name='{{$image->image_title}}'>
                                <input type="hidden" name="imageOrder[]" value='{{$image->id}}'>
                                <div class="rooms-type-close-btn btn-primary closeses">
                                    <i class="fa fa-close"></i>
                                </div>
                                <div class="image-element --- " data-id='{{$image->id}}' style="background-image: url('{{$image->image}}')">
                                </div>
                                <div class="rooms-type-footer">
                                    <form id="namechanged" enctype="multipart/form-data" class="is-readonly name-field">
                                        <div class="imagename" data-name='{{$image->image_title}}'>
                                            <input type="text" class="form-control is-disabled" name="imagetitle" id="exampleInputPassword1" placeholder="Name" value='{{$image->image_title}}'>
                                        </div>
                                        <input type="hidden" id="imageId" name="imagetitleid" placeholder="Email" value='{{$image->id}}' disabled>
                                        <div class="float-right" style="margin-top: -24px;padding-right: 5px;">
                                       
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                            @endforeach
                           
                        </div>
                    @else
                            <input type="hidden" name="token" value="{{$token}}" id="token">
                           <input type="hidden" name="propid" value="{{$propid}}" id="propid">
                           <input type="hidden" name="decrtoken" value="{{$decrtoken}}" id="decrtoken">
                        <div class="row ui-sortable rda" id="room">
                        </div>
                    @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-7">
            <table class="table table-bordered">
                <tr>
                    <td>
                        @if(isset($images_order))
                        <button class="btn btn-danger" id="start" style="display: none;">
                            <i class="far fa-microphone"></i>
                            
                            Record
                        </button>
                        <button class="btn btn-primary" id="pButton" style="display: none;">
                            <i class="far fa-play" id="picon"></i>
                            <div class="music" style="display:none"></div>
                            Play audio
                        </button>
                        <button class="btn btn-outline-primary" id="pButtondelete" style="display: none;">
                            <i class="far fa-times" aria-hidden="true"></i>
                            Delete audio
                        </button>

                        <div class="float-right">
                            <button class="btn btn-outline-primary" id="clearhotspot"><i class="far fa-times"></i>
                                Clear all
                            </button>
                            <button class="btn btn-primary addhotspot"><i class="far fa-plus"></i> Add hotspot
                            </button>
                        </div>
                        @else
                            <h5 class="imagehead" style="color:#555766;">No Images Uploaded</h5>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="imagerow">
                        <div class="row hotspotrow">
                            <div class="col-md">
                                <div class="editor-view">
                                    @if(isset($images_order))
                                        <div id="panorama">
                                       
                                        </div>
                                    @else

                                        <div id="panorama2">
                                            <img src="assets/images/noimage.png">
                                        </div>
					<div style="position: absolute;top: 65mm;left: 80mm;font-weight: 600;font-size: 14px;">
                                          <a target="_blank" href="https://www.gnomen.co.uk/vt-get-started">How to get started ></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>





<div class="modal fade" id="record" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Recording Audio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <button class="recordbutton button5 btn-danger" id="pauseaudio">
                    <i class="far fa-microphone"></i>

                </button>
                <button class="recordbutton button5 btn-danger" id="resumeaudio">
                    <i class="far fa-play-circle"></i>

                </button>
                <button class="recordbutton button5 btn-danger" id="stop" hidden>
                    <i class="far fa-stop-circle"></i>

                </button>



                <div id="time"><span class="time" id="display">00:00:00 s</span></div>
                <div class="sound-clip">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline-primary" id="cancelaudio">
                    cancel
                </button>
                <button class="btn btn-primary" id="saveaudioa">
                    save
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
        <div class="loadera"></div>
        
      </div>
    </div>
  </div>
</div>
@endsection

<div class="modal fade" id="publish" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display:none">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="switch switch--horizontal">
        @if($onoffstatus != NULL)

            <input id="radio-a" type="radio" name="first-switch" value="off" @if($onoffstatus == null or $onoffstatus==0) checked @endif/>
            <label for="radio-a"></label>
            <input id="radio-a" type="radio" value="on" name="first-switch" @if($onoffstatus==1) checked @endif/>
             <label for="radio-a">Publish</label><span class="toggle-outside"><span class="toggle-inside"></span></span>
          @else
            <input id="radio-a" type="radio" name="first-switch" value="off" checked/>
            <label for="radio-a"></label>
            <input id="radio-a" type="radio" value="on" name="first-switch" />
             <label for="radio-a">Publish</label><span class="toggle-outside"><span class="toggle-inside"></span></span>
        @endif
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="publisheform" enctype="multipart/form-data" class="is-readonly name-field">
            <div class="form-group">
                <label for="exampleFormControlInput1">Vitual tour link</label>
                <input type="text" class="form-control" id="urllink" value="{{url('VirtualTour/public_view?token='.$token.'')}}">
            </div>

            <div class="form-group">
                <input type="hidden" value="{{$token}}" id="hascode">
                <label for="exampleFormControlTextarea1">Embed code</label>
                <textarea class="form-control" id="urlemebedlink" rows="3"><iframe allow="camera; microphone" src="{{url('VirtualTour/public_view?token='.$token.'#config=https://pannellum.org/configs/tour.json')}}" title="@if(!empty($propety_details['address1'])){{$propety_details['address1']}}@endif,@if(!empty($propety_details['town'])){{$propety_details['town']}}@endif,@if(!empty($propety_details['postcode'])){{$propety_details['postcode']}}@endif" frameborder="0" width="560" height="315"></iframe>
                </textarea>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="publishsave">Save changes</button>
      </div>
    </div>
  </div>
</div>

@section('scripts')

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    }
});
$('#toggle-demo').bootstrapToggle('off');

    
    window.addEventListener('load', bodyLoad);
    var v;

    async function bodyLoad() {
	
        v = pannellum.viewer('panorama', {
            "default": {!! $default !!},
            "scenes":{!!$json!!},
        });
        var getaudio = await $.ajax({
            type: 'POST',
            url: "",
            datatype: 'json',
            data: {
                currentsceneid: v.getScene(),
            },
            success: function(response) {
                $('.music').empty();
                if (response.length != 0) {
                    $("#start").hide();
                    $("#pButton").show();
                    $("#pButtondelete").show();
                    jQuery.each(response, function(index, item) {
                        if (currentsceneid = item.parent_id) {

                            $('.music').append('<span id="audio_player"> <span class="audio_player"><i id="pButton" class="fas fa-volume-mute"></i></span> <audio id="music" preload="true"><source src="' + item.path + '"/></audio></span> ');
                            $("start").hide();
                        }

                    });
                } else {
                    $("#start").show();
                    $("#pButton").hide();
                    $("#pButtondelete").hide();
                }

            }
        });
                   
    }
  $(document).on('click','#publishsave',function(){
      var checkeds =$('#radio-a:checked').val();
      var url =$("#hascode").val();
      $.ajax({
            data:{checkeds: checkeds,url: url,},
            type: 'POST',
            url: "published",
            success: function(response) {
               
                $('#publish').modal('toggle'); 
		window.location.reload();
            }
        });
      
  });
 

</script>
@endsection