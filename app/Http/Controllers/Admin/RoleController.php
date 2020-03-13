<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\Permission;
use App\Authorizable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    use Authorizable;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('role.index', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        if( Role::create($request->only('name')) ) {
            $alert = ['type' => 'success', 'message' => __('Role has been created')];
        } else {
            $alert = ['type' => 'error', 'message' => __('Unable to create role')];
        }

        return redirect()->back()->with($alert['type'], $alert['message']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($role = Role::findOrFail($id)) {
            // admin role has everything
            if($role->name === 'super-admin') {
                $role->syncPermissions(Permission::all());
                return redirect()->route('roles.index');
            }

            $permissions = $request->get('permissions', []);

            $role->syncPermissions($permissions);

            $alert = ['type' => 'success', 'message' => $role->name . __(' permissions has been updated.')];
        } else {
            $alert = ['type' => 'error', 'message' => __('Role with id '. $id .' note found.')];
        }

        return redirect()->route('roles.index')->with($alert['type'], $alert['message']);
    }
}