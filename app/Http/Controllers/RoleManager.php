<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class RoleManager extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function permissionsIndex()
    {
    
        return Permission::all();
    
    }

    public function usersIndex()
    {
        return User::all();
    
    }

    // /**
    //  * assign a permission of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */

    // public function AddPermission(Request $request, Permission $permission, User $user)
    // {
    //     $user->assignPermission($permission);
    //     return response()->json([
    //         "message"=> $permission->name . "Permission assigned to User!"
    //     ],200);
    // }
    
    // /**
    //  * unassign a permission of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */

    // public function permissionsRemoveUser(Request $request, Permission $permission, User $user)
    // {
    //     $user->removePermission($permission);
    //     return response()->json([
    //         "message"=> $permission->name . "Permission successfully removed from User!"

    //     ],200);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rolesIndex()
    {
        return Role::all();
    }


    public function rolesAddUser(Request $request, Role $role, User $user)
    {

        $user->assignRole($role);

        return response()->json([
            "message" => $role->name . " Role successfully assigned to User!"
        ], 200);
    }

    public function rolesRemoveUser(Request $request, Role $role, User $user)
    {
        $user->removeRole($role);
        return response()->json([
            "message" => $role->name . " Role successfully removed from User"
        ], 200);
    }

}
