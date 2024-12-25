<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all(); // Fetch all roles
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0]; // Groups by entities like 'user', 'task', etc.
        });

        return view('admin.users.create', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensure email is unique
            'password' => 'required|string|min:6',
            'role' => 'required|exists:roles,id',
            'hourly_rate' => 'required|numeric|min:0',
            'balance' => 'required|numeric|min:0',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'hourly_rate' => $request->hourly_rate,
            'balance' => $request->balance,
        ]);

        // Assign the selected role to the user
        $role = Role::findById($request->role);
        $user->assignRole($role);

        // Optional: Assign custom permissions if provided
        if ($request->has('permissions')) {
            $permissions = array_keys($request->permissions);
            $user->givePermissionTo($permissions);
        }
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }

    public function edit(User $user)
    {
        // Fetch all roles
        $roles = Role::all();

        // Fetch all permissions
        $permissions = Permission::all()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0]; // Groups by entities like 'user', 'task', etc.
        });
        $userPermissions = $user->getAllPermissions();


        // Pass user, roles, and permissions to the edit view
        return view('admin.users.edit', compact('user', 'roles', 'permissions', 'userPermissions'));
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'hourly_rate' => 'required|numeric|min:0',
            'balance' => 'required|numeric|min:0',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'hourly_rate' => $request->hourly_rate,
            'balance' => $request->balance,
        ]);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password); // Hash the new password
            $user->save();
        }

        // Update role
        // $role = Role::findById($request->role);
        // $user->assignRole($role);

        // Update permissions (optional)
        if($user->hasRole('Manager')){
            $permissions = array_keys($request->permissions ?? []);
            $user->syncPermissions($permissions);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
