<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Audio;
use App\Models\Hotspot;
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
              "pitch" => 17 ,
                        "yaw" => -23.30913201221735,
                "hfov"        => $image->hfov ?? 100,
                "propety_id"  => $image->property_id,
                "user_id"     => $image->user_id,
                "order_id"    => $image->order_id,
                "created_at"  => $image->created_at,
                "updated_at"  => $image->updated_at,
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
                    "hotSpots" => $image->hostpot->map(function ($hotspot) {
                        return [
                            "sceneId" => (string)$hotspot->scene_id, // or related image ID
                            "type"    => "scene",
                            "pitch"   => $hotspot->pitch ?? 0,
                            "yaw"     => $hotspot->yaw ?? 0,
                            "hfov"    => $hotspot->hfov ?? 100,
                            "image_title" => $hotspot->image_title ?? '',
                        ];
                    })->toArray()
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


    public function editPropertyName($imageId){
        $image = PropertyImage::find($imageId);
        return view('agent.properties.model.edit_image_name',['image'=> $image]);
    }
    public function savePropertyName(Request $request,$imageId){
        $image = PropertyImage::find($imageId);
        $image->image_title = $request->title;
        $image->save();

        return response()->json([
            'success' => true,
            'message' => 'image Name updated successfully',
            'image' => $image
        ]);

    }

     public function insertRequestPost(Request $request)
    {
        $pitch = number_format($request->get('pitch'),0);
        $yaw = $request->get('yaw');
        $scenename = $request->get('scenename');
        $parent_id = $request->get('parant_id');
        $sceneId = $request->get('sceneId');



  
        Hotspot::insert([
            'pitch' => $pitch,
            'yaw' => $yaw,
            'scenename' => $scenename,
            'property_image_id' => $parent_id,
            'scene_id' => $sceneId,
            'type' => 'scene',
        ]);
        PropertyImage::where('id',$parent_id)->update(["pitch" => $pitch,"yaw" => $yaw]);
        return ['request' => $request,'SceneId' => $sceneId];
    }


    public function deletehotspot(Request $request){
       $delete = Hotspot::where('property_image_id',$request->SceneId)->delete();
       return ['SceneId' =>$request->SceneId];
    }

    /**
     * Get properties list for dropdown
     */
    public function getPropertiesList()
    {
        try {
            $properties = Property::where('user_id', Auth::id())
                ->select('id', 'name', 'address')
                ->orderBy('name')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $properties
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to load properties'
            ], 500);
        }
    }

    /**
     * Store voice recording
     */
    public function storeVoiceRecord(Request $request)
    {
        try {
            // Custom validation for voice file based on record method
            $rules = [
                'property_images_id' => 'required|exists:property_images,id',
                'record_method' => 'required|in:microphone,text',
                'text_content' => 'nullable|string'
            ];

            // More flexible file validation for text-to-speech
            if ($request->record_method === 'text') {
                $rules['voice_file'] = 'required|file|max:10240'; // Allow any file type for TTS (including text files)
            } else {
                $rules['voice_file'] = 'required|file|mimes:wav,mp3,ogg,webm,mp4|max:10240';
            }

            $request->validate($rules);

            // Check if user owns the property image
            $propertyImage = PropertyImage::where('id', $request->property_images_id)->first();
            if (!$propertyImage) {
                return response()->json([
                    'success' => false,
                    'message' => 'Property image not found'
                ], 404);
            }

            // Check if user owns the property
            $property = Property::where('id', $propertyImage->property_id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$property) {
                return response()->json([
                    'success' => false,
                    'message' => 'Property not found or access denied'
                ], 403);
            }

            // Store the voice file
            $voiceFile = $request->file('voice_file');
            $extension = $voiceFile->getClientOriginalExtension();
            
            // Default to wav if no extension (common with TTS generated files)
            if (empty($extension)) {
                $extension = 'wav';
            }
            
            $fileName = 'voice_' . time() . '_' . uniqid() . '.' . $extension;
            $voiceFile->storeAs('public/voice_records', $fileName);

            // Create or update voice record for this property image
            $voiceRecord = VoiceRecord::where('property_images_id', $request->property_images_id)->first();
            
            if (!$voiceRecord) {
                $voiceRecord = new VoiceRecord();
            }
            
            $voiceRecord->property_images_id = $request->property_images_id;
            $voiceRecord->user_id = Auth::id();
            $voiceRecord->record_method = $request->record_method;
            $voiceRecord->text_content = $request->text_content;
            $voiceRecord->file_path = 'voice_records/' . $fileName;
            $voiceRecord->file_name = $fileName;
            $voiceRecord->save();

            // Update property image to indicate it has audio
            $propertyImage->save();

            return response()->json([
                'success' => true,
                'message' => 'Voice recording saved successfully',
                'data' => $voiceRecord
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to save voice recording: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete voice recording
     */
    public function deleteVoiceRecord(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:voice_records,id'
            ]);

            $voiceRecord = VoiceRecord::find($request->id);
            
            // Check if user owns this voice record
            if ($voiceRecord->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied'
                ], 403);
            }

            // Remove audio indicator from property image
            $propertyImage = PropertyImage::find($voiceRecord->property_images_id);
            if ($propertyImage) {
                $propertyImage->audio_name = null;
                $propertyImage->save();
            }

            // Delete the actual file
            $filePath = storage_path('app/public/' . $voiceRecord->file_path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the record
            $voiceRecord->delete();

            return response()->json([
                'success' => true,
                'message' => 'Voice recording deleted successfully'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete voice recording: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Play/Stream voice recording
     */
    public function playVoiceRecord($id)
    {
        try {
            $voiceRecord = VoiceRecord::find($id);
            
            if (!$voiceRecord) {
                return response()->json([
                    'success' => false,
                    'message' => 'Voice recording not found'
                ], 404);
            }

            // Check if user owns this voice record
            if ($voiceRecord->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Access denied'
                ], 403);
            }

            $filePath = storage_path('app/public/' . $voiceRecord->file_path);
            
            if (!file_exists($filePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Audio file not found'
                ], 404);
            }

            $mimeType = mime_content_type($filePath);
            
            // Fallback MIME type mapping if mime_content_type fails
            if (!$mimeType || $mimeType === 'application/octet-stream') {
                $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                $mimeTypes = [
                    'wav' => 'audio/wav',
                    'mp3' => 'audio/mpeg',
                    'ogg' => 'audio/ogg',
                    'webm' => 'audio/webm',
                    'mp4' => 'audio/mp4',
                    'm4a' => 'audio/mp4'
                ];
                $mimeType = $mimeTypes[strtolower($extension)] ?? 'audio/wav';
            }
            
            return response()->file($filePath, [
                'Content-Type' => $mimeType,
                'Accept-Ranges' => 'bytes',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
                'Content-Disposition' => 'inline; filename="' . $voiceRecord->file_name . '"'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to play voice recording: ' . $e->getMessage()
            ], 500);
        }
    }
}
