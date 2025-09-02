<div class="btn-group" role="group">

    {{-- Show --}}
    <a class="load-modal btn btn-sm btn-info"
       href="javascript:void(0)"
       data-url="{{ $showRoute }}"
       title="View">
        <i class="fa fa-eye"></i>
    </a>

    {{-- Edit --}}
    <a class="load-modal btn btn-sm btn-warning"
         href="javascript:void(0)"
       data-url="{{ $editRoute }}"
       title="Edit">
        <i class="fa fa-edit"></i>
    </a>

    <a class="load-modal btn btn-sm btn-warning"
       href="{{ $editRouteImage }}"
       title="Edit">
        <i class="fa fa-image"></i>
    </a>

    {{-- Delete --}}
    <a class="btn btn-sm btn-danger delete"
       href="javascript:void(0)"
       data-url="{{ $deleteRoute }}"
       title="Delete">
        <i class="fa fa-trash"></i>
    </a>

</div>
