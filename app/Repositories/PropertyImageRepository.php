<?php
namespace App\Repositories;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use App\Repositories\Interfaces\PropertImageRepositoryInterface;
use App\Repositories\Interfaces\PropertRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PropertyImageRepository implements PropertImageRepositoryInterface
{
    /**
     * Get all users.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return PropertyImage::all();
    }

 
    
    public function create(array $data): PropertyImage
    {
        return PropertyImage::create($data);
    }

    public function findById(int $id): ?PropertyImage
    {
        return PropertyImage::find($id);
    }

    public function update(int $id, array $data): ?PropertyImage
    {
        $propertyImage = $this->findById($id);
        if ($propertyImage) {
            $propertyImage->update($data);
            return $propertyImage->fresh();
        }
        return null;
    }
    public function store(array $data): ? PropertyImage
    {

        $propertyImage = new PropertyImage();
        $propertyImage->property_id = $data['property_id'];
        $propertyImage->user_id = Auth::user()->id ?? null;
        $propertyImage->image_path = $data['image_path'];
        $propertyImage->image_title = "test";
        $propertyImage->pitch = 20;
        $propertyImage->yaw = 50;
        $propertyImage->hfov = 20;
        $propertyImage->order_id = 1;
        $propertyImage->save();
        return $propertyImage->fresh();
    }


    public function delete(int $id): bool
    {
        $propertyImage = $this->findById($id);
        if ($propertyImage) {
            return $propertyImage->delete();
        }
        return false;
    }

    public function getPropertiesBId(int $Id): PropertyImage
    {
        return PropertyImage::where('id', $Id)->get();
    }

    public function getPropertiesByPropertyId(int $id): collection
    {
        return PropertyImage::where('property_id', $id)->get();
    }
}