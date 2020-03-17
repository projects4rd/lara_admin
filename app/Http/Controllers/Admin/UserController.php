<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use App\Permission;
use App\Authorizable;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $result = User::latest()->paginate();
        return view('user.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::all();

        return view('user.create', compact('user', 'roles', 'permissions', ['createUser' => true]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'bail|required|min:2',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles'    => 'required|min:1'
        ]);

        $request->merge(['password' => bcrypt($request->get('password'))]);

        if ($user = User::create($request->except('roles', 'permissions'))) {
            $this->syncPermissions($request, $user);
            $alert = ['type' => 'success', 'message' => __('User has been created')];
        } else {
            $alert = ['type' => 'error', 'message' => __('Unable to create user')];
        }

        return redirect()->route('users.index')->with($alert['type'], $alert['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::all('name', 'id');

        return view('user.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update2(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
            'name'  => 'bail|required|min:2',
            'email' => 'required|email|unique:users, email,' . $id,
            'roles' => 'required|min:1'
        ]);

        $user = User::findOrFail($id);

        $user->fill($request->except('roles', 'permissions', 'password'));

        if ($request->input('password') === '') {
            $user->password = bcrypt($request->get('password'));
        }

        $this->syncPermissions($request, $user);

        $user->save();

        $alert = ['type' => 'success', 'message' => __('User has been updated')];
        return redirect()->route('users.index')->with($alert['type'], $alert['message']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'     => 'bail|required|min:2',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles'    => 'required|min:1'
        ]);


        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::findOrFail($id);
        $user->update($input);
        
        $this->syncPermissions($request, $user);

        $alert = ['type' => 'success', 'message' => __('User has been updated')];
        return redirect()->route('users.index')->with($alert['type'], $alert['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->id == $id) {
            $alert = ['type' => 'error', 'message' => __('Deletion of currently logged in user is not allowed')];
            return redirect()->back()->with($alert['type'], $alert['message']);
        }

        if (User::findOrFail($id)->delete()) {
            $alert = ['type' => 'success', 'message' => __('User has been deleted')];
        } else {
            $alert = ['type' => 'error', 'message' => __('Unable to delete user')];
        }

        return redirect()->back()->with($alert['type'], $alert['message']);
    }

    private function syncPermissions(Request $request, $user)
    {
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        $roles = Role::find($roles);

        if ($user->hasAllRoles($roles)) {
            $user->permissions()->sync([]);
        } else {
            $user->permissions()->sync($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }
}
