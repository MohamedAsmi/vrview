<?php

namespace App\Services;

use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    public static function store(Request $request, string $fieldName = 'images', string $folder = 'uploads')
    {
        $images = $request->file('files');
        $orderid_select = PropertyImage::select('order_id')->where('property_id', $request->propety_id)->orderBy('order_id', 'desc')->first();
        if ($orderid_select != NULL) {
            $orderid = $orderid_select->order_id;
        } else {
            $orderid = 0;
        }
        if ($request->hasFile('files')) {
            if (count($images) > 0) {
                foreach ($images as $item) {


                    $fileArray = array('image' => $item);
                    $rules = array(
                        'image' => 'mimes:jpeg,jpg,png,gif|required' // max 10000kb
                    );
                    $validator = Validator::make($fileArray, $rules);
                    if ($validator->fails()) {
                        return response()->json(['error' => $validator->errors()->getMessages()]);
                    } else {
                        $orderid++;
                        $new_name = rand() . '.' . $item->getClientOriginalExtension();
                        $save_path = 'assets/' . $request->property_id . '/images/' . $new_name;
                        // Initialize ImageManager with GD driver

                        $new_name = rand() . '.' . $item->getClientOriginalExtension();
                        $values = array('image_title' => 'Room'. $orderid, 'image_path' => 'assets/'.$request->property_id.'/images/'. $new_name, 'pitch' => 0,'yaw' => 0,'property_id' => $request->property_id, 'user_id' => Auth::user()->id,'order_id' => $orderid);
                        $image = PropertyImage::insert($values);
                        $manager = new ImageManager(
                            driver: new Driver()
                        );

                        // Open the uploaded image once
                        $image = $manager->read($item);

                        // Resize if height exceeds max
                        $max_height = 2600;
                        if ($image->height() > $max_height) {
                            $image->resize(
                                intval($image->width() * $max_height / $image->height()),
                                $max_height
                            );
                        }

                        // Ensure the directory exists
                        $directory = public_path('assets/' . $request->property_id . '/images/');
                        if (!file_exists($directory)) {
                            mkdir($directory, 0755, true);
                        }

                        // Save the image
                        $image->save(public_path($save_path));
                        return $image;
                    }
                }
            }
        }
    }
}
