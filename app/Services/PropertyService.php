<?php
namespace App\Services;

use App\Repositories\PropertyRepository;
use App\Traits\Response;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class PropertyService
{
    use Response;
     public function __construct(
        protected PropertyRepository $propertyRepository
    ) {}

    public function getAllProperties()
    {
        try {
            $users = $this->propertyRepository->getAll();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('status', function ($user) {
                    return $user->status == 1 
                        ? 'Active' 
                        : 'Inactive';
                })
                ->addColumn('actions', function ($user) {
                    return view('agent.partials.actions', [
                        'editRoute'   => route('property.show', $user->id),
                        'editRouteImage'   => route('property.edit', $user->id),
                        'showRoute'   => route('users.show', $user->id),
                        'deleteRoute' => route('users.destroy', $user->id),
                    ])->render();
                })
                ->rawColumns(['actions'])
                ->toJson();
        } catch (\Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch users'], 500);
        }
    }

    

    public function storeProperty($request)
    {
        try {
            $data = $request->all();
            $property = $this->propertyRepository->create($data);
            return $property;
        } catch (\Exception $e) {
            Log::error('Error storing property: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to store property'], 500);
        }
    }   

    public function getPropertyById(int $id)
    {
        try {
            return $this->propertyRepository->findById($id);
        } catch (\Exception $e) {
            Log::error('Error fetching property by ID: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch property'], 500);
        }
    }
}