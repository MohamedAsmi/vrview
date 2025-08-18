<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;


class UserService
{
    use Response;
     public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function getAllUsers()
    {
        try {
            $users = $this->userRepository->getAll();

            return DataTables::of($users)   // or ->eloquent() if $users is an Eloquent query
                ->addIndexColumn()
                ->addColumn('role', fn ($user) => $user->getRoleLabel())
                ->addColumn('nic_images', function ($user) {
                    $front = $user->nic_front 
                        ? '<img src="' . asset('storage/' . $user->nic_front) . '" width="60" class="img-thumbnail" />' 
                        : 'No Front';

                    $back = $user->nic_back 
                        ? '<img src="' . asset('storage/' . $user->nic_back) . '" width="60" class="img-thumbnail" />' 
                        : 'No Back';

                    return $front . ' ' . $back;
                })
                ->addColumn('status', function ($user) {
                    return $user->status == 1 
                        ? 'Active' 
                        : 'Inactive';
                })
                ->addColumn('actions', function ($user) {
                    return view('admin.partials.actions', [
                        'editRoute'   => route('users.edit', $user->id),
                        'showRoute'   => route('users.show', $user->id),
                        'deleteRoute' => route('users.destroy', $user->id),
                    ])->render();
                })
                ->rawColumns(['role', 'nic_images', 'actions'])
                ->toJson();
        } catch (\Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch users'], 500);
        }
    }


    public function Role(User $user)
    {
        try {
            $role = $user->getRoleNames()->first();
            return $role ? $role : 'No role assigned';
        } catch (\Exception $e) {
            Log::error('Error fetching user role: ' . $e->getMessage());
            return 'Error fetching role';
        }
    }

    public function getUserById($id)
    {
        try {
            $user = $this->userRepository->findById($id);
            if (!$user) {
                return $this->respondNotFound('User not found', 404);
            }
            return $user;
        } catch (\Exception $e) {
            Log::error('Error fetching user by ID: ' . $e->getMessage());
            return $this->respondNotFound('Failed to fetch user', 500);
        }
    }
    

}