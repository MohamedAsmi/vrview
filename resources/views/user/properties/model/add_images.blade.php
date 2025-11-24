@extends('agent.layouts.app')
@section('content')

    <div class="min-height-200px mb-20 pb-20">
        <div class="row mt-2">
            <div class="col-md-5 rooms-container">
                <table class="table table-bordered">
                    <tr>
                        <th style="color: #555766;">Rooms
                            <div class="float-right">
                                <a href="{{ url('/preview?token=fsdfdf') }}" target="_blank"><button
                                        class="btn btn-outline-primary"><i class="fal fa-presentation"
                                            style="padding-right: 4px;"></i>Preview</button></a>
                                <button class="btn btn-outline-primary" data-toggle="modal" data-target="#publish"><i
                                        class="fas fa-circle"
                                        style="@if ($onoffstatus == null or $onoffstatus == 0) color:#e4e3e3; @else color:#61d03e; @endif;"></i>
                                    Publish
                                </button>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            @if (isset($images_order))
                                <div class="row ui-sortable rda" id="room" data-url="{{ route('Image.get') }}">
                                    <input type="hidden" name="token" value="{{ $token }}" id="token">
                                    <input type="hidden" name="property_id" value="{{ $property->id }}" id="property_id">
                                    <input type="hidden" name="decrtoken" value="{{ $decrtoken }}" id="decrtoken">
                                    @foreach ($images_order->sortBy('order_id') as $key => $image)
                                        <div class="col-6 m-b-20 ui-sortable-handle mb-4" id="parent" draggable="false">
                                            <div class="rooms-types card-sub <?php if (isset($_GET['sceneid'])) {
                                                if ($_GET['sceneid'] == $image->id) {
                                                    echo 'active';
                                                }
                                            } else {
                                                if ($key == 0) {
                                                    echo 'active';
                                                }
                                            } ?>" id="rooms-types"
                                                data-id='{{ $image->id }}' name='{{ $image->image_title }}'>
                                                <input type="hidden" name="imageOrder[]" value='{{ $image->id }}'>
                                                <div class="rooms-type-close-btn  closeses">
                                                    <i class="fa fa-close "></i>
                                                </div>
                                                <div class="image-element --- " data-id='{{ $image->id }}'
                                                    style="background-image: url('{{ $image->image && asset('public/' . $image->image) ? asset($image->image) : asset('assets/noimage.png') }}')">
                                                </div>
                                                <div class="rooms-type-footer">
                                                    <form id="namechanged" enctype="multipart/form-data"
                                                        class="is-readonly name-field">
                                                        <div class="imagename" data-name='{{ $image->image_title }}'>
                                                            <input type="text" class="form-control is-disabled"
                                                                name="imagetitle" id="exampleInputPassword1"
                                                                placeholder="Name" value='{{ $image->image_title }}'>
                                                        </div>
                                                        <input type="hidden" id="imageId" name="imagetitleid"
                                                            placeholder="Email" value='{{ $image->id }}' disabled>
                                                    
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            @else
                                <input type="hidden" name="token" value="{{ $token }}" id="token">
                                <input type="hidden" name="property_id" value="{{ $property->id }}" id="property_id">
                                <input type="hidden" name="decrtoken" value="{{ $decrtoken }}" id="decrtoken">
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
                            @if (isset($images_order))
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
                                    <button class="btn btn-outline-primary" id="clearhotspot"><i
                                            class="far fa-times"></i>
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
                                        @if (isset($images_order))
                                            <div id="panorama" style="width: 100%; height: 500px;"></div>
                                        @else
                                            <div id="panorama2">
                                                <img src="{{ asset('assets/noimage.png') }}">
                                            </div>
                                            <div
                                                style="position: absolute;top: 65mm;left: 80mm;font-weight: 600;font-size: 14px;">

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


@endsection
@push('js')
    <script src="{{ asset('assets/agent/property.js') }}"></script>
    <script>
        // $('#toggle-demo').bootstrapToggle('off');
        var imageUrl = "{{ asset('assets/1/images/477268420.jpg') }}";


       var v;
var activescene;

window.addEventListener('load', bodyLoad);

async function bodyLoad() {
    v = pannellum.viewer('panorama', {
        "useWebGL2": true,
        "default": {!! $default !!},
        "scenes": {!! $json !!},
    });

    activescene = v.getScene();

}

// Anywhere else, check if v is initialized first
function doSomething() {
    if (v) {
        console.log(v.getScene());
    }
}
    </script>
@endpush

<script>
    window.appRoutes = {
        imageGet: "{{ route('Image.get') }}",
        imageupload: "{{ route('property.update', ['property' => $property->id]) }}",
    };
</script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="{{ asset('assets/js/imagesevent.js') }}"></script>
