<?php
namespace App\Services;

use App\Repositories\PropertyImageRepository;
use App\Repositories\PropertyRepository;
use App\Traits\Response;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class PropertyImageService
{
    use Response;
     public function __construct(
        protected PropertyImageRepository $propertyImageRepository,
        protected ImageService $imageService
    ) {}

    public function getAllImages()
    {
        try {
           return $this->propertyImageRepository->getAll();
        } catch (\Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch users'], 500);
        }
    }

    // public function getOrderFirsImages(int $id)
    // {
    //     try {

    //        return $this->propertyImageRepository->getOrderFirst($id);
    //     } catch (\Exception $e) {
    //         Log::error('Error fetching users: ' . $e->getMessage());
    //         return response()->json(['error' => 'Failed to fetch users'], 500);
    //     }
    // }

    public function storePropertyImage($request)
    {
        try {
            $image_paths = $this->imageService->store($request,'files','uploads');
            // foreach ($image_paths as $image_path) {
            //     $data = $request->all();
            //     $data['image_path'] = $image_path;
            //     $property = $this->propertyImageRepository->store($data);
            // }
         
            return $image_paths;
        } catch (\Exception $e) {
            Log::error('Error storing property: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }   

    public function getPropertyById(int $id)
    {
        try {
            return $this->propertyImageRepository->findById($id);
        } catch (\Exception $e) {
            Log::error('Error fetching property by ID: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch property'], 500);
        }
    }

    public function getPropertyImages(int $id)
    {
        try {
            return $this->propertyImageRepository->getPropertiesByPropertyId($id);
        } catch (\Exception $e) {
            Log::error('Error fetching property by ID: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch property'], 500);
        }
    }
}