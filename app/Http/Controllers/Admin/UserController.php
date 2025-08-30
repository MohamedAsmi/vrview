<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
       return view('admin.users.index');
    }

    public function list()
    {
        return $this->userService->getAllUsers();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.model.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $nicFrontPath = $request->file('nic_front')->store('nic_files/front', 'public');
        $nicBackPath = $request->file('nic_back')->store('nic_files/back', 'public');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'mobile' => $request->mobile,
            'type' => $request->type,
            'nic_front' => $nicFrontPath,
            'nic_back' => $nicBackPath,
            'is_admin' => $request->type == User::ROLE_AGENT ? User::ROLE_AGENT : User::ROLE_USER,
            // 'status' => $request->type == User::ROLE_USER ? User::IS_ACTIVE : User::IS_INACTIVE,
            'status' => $request->type == User::IS_ACTIVE,
        ]);

        event(new Registered($user));
        return response()->json([
            'success' => true,
            'message' => 'User Created successfully',
            'user' => $user
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.users.model.show', [
            'user' => $this->userService->getUserById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userService->getUserById($id);
        return view('admin.users.model.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $this->userService->updateUser($request, $id);
      
        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->deleteUser($id);
        return response()->json([
            'success' => $user,
            'message' => 'User deleted successfully'
        ]);
    }
}
