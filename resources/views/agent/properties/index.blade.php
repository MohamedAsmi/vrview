@extends('agent.layouts.app')
@section('content')
<div class="min-height-200px mb-20 pb-20">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('agent.home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Properties</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                {{ \Carbon\Carbon::now()->format('F Y') }}
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-30 pb-4" >
        <div class="mb-4 row">
            <div class="col-8">
            </div>
            <div class="col flex d-flex text-right">
    
                <a class="challans_tabley col" href="{{ route('property.create')}}">
                    <button type="submit" class="btn btn-success" fdprocessedid="ruveee"
                        data-loading-text="Please Wait...">Add New</button>
                </a>
                <div class="dropdown">
                    {{-- <a href="{{route('challans.create')}}">
                        <button type="button" class="btn btn-dark" fdprocessedid="ruveee">
                            <i class="fa fa-plus"></i>
                            New
                        </button>
                    </a> --}}
                </div>
            </div>
        </div>
        
        <table id="data_table" class="table" data-url="{{route('list.properties')}}" reload="true">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    <th>ADDRESS2</th>
                    <th>PRICE</th>
                    <th>ROOM COUNT</th>
                    <th>BATH ROOMS</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/agent/property.js') }}"></script>
@endpush