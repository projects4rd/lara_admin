<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;

use Exception;
use App\Contact;
use App\Permission;
use App\Authorizable;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Support\Facades\Storage;
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
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();
        try {
            $request->merge(['password' => Hash::make(request('password'))]);
            $request->request->set('name', request('first_name') . ' ' . request('last_name'));

            $user = User::create($request->except('roles', 'permissions'));


            $contact = Contact::create([
                'first_name' => request('first_name'),
                'last_name'  => request('last_name'),
                'email'      => request('email'),
                'phone'      => request('phone'),
                'mobile'     => request('mobile'),
                'salutation' => request('salutation'),
                'bio'        => request('bio'),
                'avatar'     => $this->convertAvatar($request),
            ]);

            $this->syncPermissionsAndRoles($request, $user);

            DB::commit();
            return redirect()->route('users.index')->with('success', __('User has been created'))->withInput();
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('users.create')->with('error', __('Unable to create user: ') . $e->getMessage())->withInput();
        }
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

        $this->syncPermissionsAndRoles($request, $user);

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

        $this->syncPermissionsAndRoles($request, $user);

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

    private function syncPermissionsAndRoles(Request $request, User $user)
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

    private function convertAvatar($request)
    {
        if (!$request->hasFile('avatar')) {
            return '';
        }

        $image          = $request->file('avatar');
        $extension      = $image->getClientOriginalExtension();
        $hash           = md5($image->__toString());
        $filename       = $hash . '.' . $extension;
        $imageDimension = config('rd-backend.image.avatar_dimension.fit');

        try {

            $avatar = Image::make($image)->fit($imageDimension)->encode($extension);
            Storage::put("public/images/avatars/" . $filename, $avatar);

            return $filename;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function removeAvatar($image)
    {
        if (!empty($image)) {
            $imagePath     = public_path(config('rd-backend.image.directory') . '/' . $image);
            $ext           = substr(strrchr($image, '.'), 1);
            $thumbnailPath = str_replace(".{$ext}",  "_thumb.{$ext}", $imagePath);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }
        }
    }
}
