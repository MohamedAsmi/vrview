<?php

namespace App\Http\Controllers\Agent;

use App\Models\PropertyImage;
use App\Http\Requests\StorePropertyImageRequest;
use App\Http\Requests\UpdatePropertyImageRequest;
use App\Http\Controllers\Controller;
use App\Services\PropertyImageService;
use App\Services\PropertyService;
use Illuminate\Http\Request;

class AgentPropertyImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $propertyService;
    protected $propertyImageService;

    public function __construct(PropertyService $propertyService, PropertyImageService $propertyImageService)
    {
        $this->propertyService = $propertyService;
        $this->propertyImageService = $propertyImageService;
    }


    public function index(Request $request)
    {

        return view('agent.properties.update', [
            'property' => $this->propertyService->getPropertyById($request->property),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyImageRequest $request)
    {
        return $this->propertyImageService->storePropertyImage($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyImageRequest $request, PropertyImage $propertyImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyImage $propertyImage)
    {
        //
    }
}
