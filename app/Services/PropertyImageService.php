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
            if (!$request->hasFile('files')) {
                return response()->json(['error' => 'No files uploaded'], 400);
            }

            $result = $this->imageService->store($request, 'files', 'uploads');
            
            // Check if the result is an error response
            if ($result instanceof \Illuminate\Http\JsonResponse) {
                return $result;
            }
            
            // If it's a successful response with image paths
            if (is_array($result)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Images uploaded successfully',
                    'paths' => $result
                ]);
            }
            
            // If we get here, something unexpected happened
            return response()->json(['error' => 'Unexpected response from image service'], 500);
            
        } catch (\Exception $e) {
            Log::error('Error storing property images: ' . $e->getMessage());
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