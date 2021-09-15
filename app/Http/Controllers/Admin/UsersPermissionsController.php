<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersPermissionsController extends Controller
{
    public function update(Request $request, user $user)
    {
        $user->permissions()->detach();
        
        if($request->filled('permissions'))
        {
            $user->syncPermissions($request->permissions);    
        }
        

        return back()->withFlash('Los permisos han sido actualizados');
    }
}
