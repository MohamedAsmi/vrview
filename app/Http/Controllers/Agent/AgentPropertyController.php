<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\Publish;
use App\Models\VoiceRecord;
use App\Services\ImageService;
use App\Services\PropertyImageService;
use App\Services\PropertyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function Ramsey\Uuid\v1;

class AgentPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $propertyService;
    protected $propertyImageService;
    protected $imageService;

    public function __construct(PropertyService $propertyService, PropertyImageService $propertyImageService, ImageService $imageService)
    {
        $this->propertyService = $propertyService;
        $this->propertyImageService = $propertyImageService;
        $this->imageService = $imageService;
    }


    public function index()
    {
        return view('agent.properties.index');
    }


    public function list()
    {
        return $this->propertyService->getAllProperties();
    }

    public function create()
    {
        return view('agent.properties.model.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $this->propertyImageService->storePropertyImage($request);
        $property = $this->propertyService->storeProperty($request);
        return redirect()->route('property.edit', $property->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = Property::find($id);
        return view('agent.properties.model.detail',[
        'property' => $property
    ]);
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = $this->propertyService->getPropertyById($id);

        $getfirstimage = PropertyImage::orderBy('order_id')->where('property_id', 1)->where('user_id', 3)->first();
        $default = [
            "firstScene" => (string) ($getFirstImage->id ?? $property->images->first()->id ?? '1'),
            "autoLoad" => true,
            "orientationOnByDefault" => true,
            "showControls" => false,
            "autoRotate" => 0,
            "compass" => false,
        ];
      

        $propety_details = [
            'Property_name' => $property->name ?? '',
            'price' => $property->price ?? '',
            'address' => $property->address ?? '',
            'address1' => $property->address1 ?? '',
        ];
        $images_order = $property->images->map(function ($image) {
            return (object)[
                "id"          => $image->id,
                "image_title" => $image->image_title,
                "image"       => $image->image_path,
                "pitch"       => $image->pitch ?? 0,
                "yaw"         => $image->yaw ?? 0,
                "hfov"        => $image->hfov ?? 100,
                "propety_id"  => $image->property_id,
                "user_id"     => $image->user_id,
                "order_id"    => $image->order_id,
                "created_at"  => $image->created_at,
                "updated_at"  => $image->updated_at,
                "audio_name"  => $image->audio_name,
            ];
        });
        $json = $property->images->mapWithKeys(function ($image) {
            return [
                (string)$image->id => [
                    "title" => $image->image_title . "<input type='hidden' id='imageid' name='imageid' value='{$image->id}'>",
                    "panorama" => asset($image->image_path), // make sure image_path is correct
                    "pitch" => $image->pitch ?? 0,
                    "yaw" => $image->yaw ?? 0,
                    "hfov" => $image->hfov ?? 100,
                    "hotSpots" => [[
                        "sceneId" => (string)$image->id,
                        "type" => "scene",
                        "pitch" => $image->pitch ?? 0,
                        "yaw" => $image->yaw ?? 0,
                        "hfov" => $image->hfov ?? 100,
                        "image_title" => $image->image_title,
                    ]]
                ]
            ];
        });
        return view('agent.properties.model.add_images', [
            'json' => json_encode($json, JSON_UNESCAPED_SLASHES),
            'default' => json_encode($default),
            'images_order' => $images_order,
            'token' => 'sdsafsdfsdf',
            'decrtoken' => 'safdasf',
            'property_id' => 20,
            'propety_details' => $propety_details,
            'full_address' => 'fsdfsdfsdfds',
            'onoffstatus' => 1,
            'property' => $property,
            'image_path' => $property->images->first()->image_path ?? 'assets/images/noimage.png',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        return $this->propertyImageService->storePropertyImage($request);
    }

    public function getallImage(Request $request)
    {

        $images = $this->propertyImageService->getAllImages($request->property);

        return response()->json($images);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


     public function ajaxRequestPost(Property $property,Request $request)
    {

        $currentId = $request->get('id'); // current image id

        $dropdownImages = PropertyImage::where('property_id', $property->id)
            ->where('user_id', auth()->id())
            ->where('id', '!=', $currentId) // exclude current image
            ->orderBy('order_id')
            ->get()
            ->map(function ($image) use ($currentId) {
                return [
                    'text'        => $image->image_title,
                    'value'       => $image->id,
                    'selected'    => $image->id == $currentId ? "true" : "false", // mark active image
                    'description' => $image->image_title,
                    'imageSrc'    => asset($image->image_path), // full URL
                ];
            });

        return response()->json($dropdownImages);
    }


    function udateorder(Request $request)
    {
        $orders = $request->all();
        foreach($orders['dataId'] as $key => $o){
                PropertyImage::where('id',$o)->update(["order_id" => $key+1]);
        }
     
    }

    public function getaudio(Request $request)
    {
        $currentsceneid = $request->currentsceneid;
        $result = VoiceRecord::where('property_images_id', $currentsceneid)->get();
        return response()->json($result);
    }
}
