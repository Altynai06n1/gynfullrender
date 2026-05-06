<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Workout;
use App\Models\GymNews;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $data = [
            'user'           => $user,
            'roles'          => $user->getRoleNames(),
            'permissions'    => $user->getAllPermissions()->pluck('name'),
            'workoutsCount'  => Workout::count(),
            'gymNewsCount'   => GymNews::count(),
        ];

        return view('dashboard', $data);
    }

  
    public function adminPanel()
    {
        $users       = User::with('roles')->get();
        $roles       = Role::with('permissions')->get();
        $permissions = Permission::all();

        return view('admin.panel', compact('users', 'roles', 'permissions'));
    }

    
    public function analytics()
    {
        $workoutsCount = Workout::count();
        $gymNewsCount  = GymNews::count();
        $usersCount    = User::count();

        return view('admin.analytics', compact('workoutsCount', 'gymNewsCount', 'usersCount'));
    }

   
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);

        
        if ($user->id === auth()->id()) {
            return back()->with('error', __('messages.admin.cannot_delete_self'));
        }

        $user->delete();

        return back()->with('success', __('messages.admin.user_deleted_named', ['name' => $user->name]));
    }

   
    public function updateUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

      
        if ($user->id === auth()->id()) {
            return back()->with('error', __('messages.admin.cannot_change_self_role'));
        }

        $request->validate([
            'role' => 'required|string|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return back()->with('success', __('messages.admin.role_updated_named', ['name' => $user->name, 'role' => $request->role]));
    }
}
