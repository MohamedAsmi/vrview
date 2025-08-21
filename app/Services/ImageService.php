<?php

namespace App\Services;

use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    public static function store(Request $request, string $fieldName = 'images', string $folder = 'uploads')
    {
        try {
            if (!$request->hasFile('files')) {
                return response()->json(['error' => 'No files uploaded'], 400);
            }

            $images = $request->file('files');
            $savedPaths = [];

            $orderid_select = PropertyImage::select('order_id')
                ->where('property_id', $request->property_id)
                ->orderBy('order_id', 'desc')
                ->first();
            
            $orderid = $orderid_select ? $orderid_select->order_id : 0;

            foreach ($images as $item) {


                    $fileArray = array('image' => $item);
                    $rules = array(
                        'image' => 'mimes:jpeg,jpg,png,gif|required'
                    );
                    
                    $validator = Validator::make($fileArray, $rules);
                    if ($validator->fails()) {
                        continue; // Skip invalid files
                    }

                    try {
                        $orderid++;
                        $new_name = rand() . '.' . $item->getClientOriginalExtension();
                        $save_path = 'assets/' . $request->property_id . '/images/' . $new_name;

                        // Ensure the directory exists
                        $directory = public_path('assets/' . $request->property_id . '/images/');
                        if (!file_exists($directory)) {
                            mkdir($directory, 0755, true);
                        }

                        // Initialize ImageManager
                        $manager = new ImageManager(
                            driver: new Driver()
                        );

                        // Process the image
                        $image = $manager->read($item);

                        // Resize if height exceeds max
                        $max_height = 2600;
                        if ($image->height() > $max_height) {
                            $image->resize(
                                intval($image->width() * $max_height / $image->height()),
                                $max_height
                            );
                        }

                        // Save the processed image
                        $image->save(public_path($save_path));

                        // Store in database
                        $values = array(
                            'image_title' => 'Room' . $orderid,
                            'image_path' => $save_path,
                            'pitch' => 0,
                            'yaw' => 0,
                            'property_id' => $request->property_id,
                            'user_id' => Auth::user()->id,
                            'order_id' => $orderid
                        );
                        
                        PropertyImage::insert($values);

                        // Add to saved paths
                        $savedPaths[] = $save_path;

                        // Clear memory
                        unset($image);
                        unset($manager);
                        gc_collect_cycles();

                    } catch (\Exception $e) {
                        Log::error('Error processing image: ' . $e->getMessage());
                        continue; // Skip this image and continue with others
                    }
            }

            return $savedPaths;

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to process images: ' . $e->getMessage()
            ], 500);
        }
    }
}
