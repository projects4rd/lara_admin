<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;

use Exception;
use App\Permission;
use App\Authorizable;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;

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
    public function index(Request $request)
    {
        $users = User::latest()->get();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers(Request $request)
    {
        $users = User::latest()->get();

        if ($request->ajax()) {

            return Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    return '
                    <a class="btn btn-success" id="edit-user" data-toggle="modal" data-id=' . $row->id . '>Edit </a>
                    <a id="delete-user" data-id=' . $row->id . ' class="btn btn-danger delete-user">Delete</a>
                    <meta name="csrf-token" content="{{ csrf_token() }}">';
                })
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('d-m-Y');
                })
                ->editColumn('updated_at', function ($user) {
                    return $user->updated_at->format('d-m-Y');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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

        return view('admin.user.create', compact('user', 'roles', 'permissions', ['createUser' => true]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'first_name' => 'bail|required|min:2',
                'last_name'  => 'bail|required|min:2',
                'email'      => 'required|email|max:255|unique:users',
                'password'   => 'required|confirmed|min:6',
                'slug'       => 'required|alpha_dash|min:5|max:255|unique:users,slug',
                'roles'      => 'required|min:1'
            ]);

            $request->merge(['password' => Hash::make($request->input('password'))]);

            if ($user = User::create($request->except('roles', 'permissions'))) {
                $this->syncPermissions($request, $user);
                $alert = ['type' => 'success', 'message' => __('User has been created')];
            } else {
                $alert = ['type' => 'error', 'message' => __('Unable to create user')];
            }


            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect()->route('admin.users.index')->with($alert['type'], $alert['message']);
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
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::all('name', 'id');

        return view('admin.user.edit', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update2(Request $request, User $user)
    {
        // dd($request);
        $this->validate($request, [
            'name'  => 'bail|required|min:2',
            'email' => 'required|email|unique:users, email,' . $id,
            'roles' => 'required|min:1'
        ]);

        $user->fill($request->except('roles', 'permissions', 'password'));

        if ($request->input('password') === '') {
            $user->password = Hash::make($request->input('password'));
        }

        $this->syncPermissions($request, $user);

        $user->save();

        $alert = ['type' => 'success', 'message' => __('User has been updated')];
        return redirect()->route('admin.users.index')->with($alert['type'], $alert['message']);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $input = $request->validated();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user->update($input);

        $this->syncPermissions($request, $user);

        $alert = ['type' => 'success', 'message' => __('User has been updated')];
        return redirect()->route('admin.users.index')->with($alert['type'], $alert['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user() == $user) {
            $alert = ['type' => 'error', 'message' => __('Deletion of currently logged in user is not allowed')];
            return redirect()->back()->with($alert['type'], $alert['message']);
        }

        if ($user->delete()) {
            $alert = ['type' => 'success', 'message' => __('User has been deleted')];
        } else {
            $alert = ['type' => 'error', 'message' => __('Unable to delete user')];
        }

        return redirect()->back()->with($alert['type'], $alert['message']);
    }

    private function syncPermissions(Request $request, User $user)
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
