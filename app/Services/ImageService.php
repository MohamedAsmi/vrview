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
    public function store(Request $request, string $fieldName = 'files', string $folder = 'uploads')
    {
        $images = $request->file($fieldName);

        if (!$images || !is_array($images)) {
            return [];
        }

        // Get last order_id for this property
        $lastOrder = PropertyImage::where('property_id', $request->property_id)
            ->orderByDesc('order_id')
            ->value('order_id') ?? 0;

        $storedImages = [];
        $orderId = $lastOrder;

        foreach ($images as $item) {
            // Validate each image
            $validator = Validator::make(
                ['image' => $item],
                ['image' => 'mimes:jpeg,jpg,png,gif|required|max:10000']
            );

            if ($validator->fails()) {
                throw new \Exception(json_encode($validator->errors()->getMessages()));
            }

            $orderId++;
            $newName = uniqid() . '.' . $item->getClientOriginalExtension();
            $savePath = "assets/{$request->property_id}/images/{$newName}";

            // Save DB record
            $values = [
                'image_title' => 'Room' . $orderId,
                'image_path'  => $savePath,
                'pitch'       => 0,
                'yaw'         => 0,
                'property_id' => $request->property_id,
                'user_id'     => auth()->user()->id,
                'order_id'    => $orderId
            ];

            $propertyImage = PropertyImage::create($values);

            // Process & save the image
            $manager = new ImageManager(new Driver());
            $image   = $manager->read($item);

            $maxHeight = 2600;
            if ($image->height() > $maxHeight) {
                $image->resize(
                    intval($image->width() * $maxHeight / $image->height()),
                    $maxHeight
                );
            }

            $directory = public_path("assets/{$request->property_id}/images/");
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            $image->save(public_path($savePath));

            $storedImages[] = $propertyImage;
        }

        return $storedImages;
    }
}
