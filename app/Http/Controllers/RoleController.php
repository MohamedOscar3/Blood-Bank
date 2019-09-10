<?php

namespace App\Http\Controllers;




use App\Http\Requests\RoleRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }
    //
    public function index() {
        return view('roles.index',['roles' => Role::all(),'permissions'=>Permission::all()]);
    }

    public function store(RoleRequest $request) {
        $validate = $request->validated();
        
        
            $roles = Role::create($validate);
                if($roles) {
                    $roles->perms()->sync($request->permissions_id);
                }
        

        return back()->with('msg',"the role have been added succsessfuly");
        
    }

    public function update($id,Request $request) {
        $validate = $request->validate([
            'name' =>'required|max:255',
            'display_name' => 'required|max:255',
            'description' => 'max:255',
            'permissions_id',
            
        ]);

        $role= Role::find($id)->first();
       
        
        
        $role->fill($validate);
        $role->save();
        
        if ($request->has('permissions_id')) {
            
            $role->perms()->sync($request->permissions_id);
        }
        return back()->with('msg','the role have been updated successfully');

        
    }

    public function destroy($id) {
        
        $role = Role::find($id);
        
        if ($role) {
            
            
            $role->perms()->sync([]);
            $role->forceDelete();
            return back()->with('msg','the role has been deleted successfuly');
        } else {
            return back()->with('errors','the role is not found');
        }
    }
}
