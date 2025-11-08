@extends('agent.layouts.app')
@section('content')

    <div class="card-box col-md-4">
 

        <form method="POST" action="{{route('edit.property.save',['id' => $image->id])}}" enctype="multipart/form-data" id="ajax-form" data-reload="true" >
            @csrf
      
            <div class="modal-body">
                <div id="message-area"></div>
             
                <div class="form-group row">
                    <div class="col">
                        <label class="col col col-form-label">Image Name</label>
                        <div class="col col-md-10">
                            <input type="text" class="form-control" name="title" id="title" value="{{ $image->name }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark" data-loading-text="Please Wait...">Save</button>
            </div>
        </form>
    </div>

@endsection
