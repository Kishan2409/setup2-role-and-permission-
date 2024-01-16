<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public $module_name = 'User';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $User = User::with(['roles'])->select("users.*");
            return DataTables::eloquent($User)
                ->addColumn('action', function ($d) {

                    $editUrl = url('admin/user/edit', encrypt($d->id));

                    $deleteUrl = url('admin/user/delete', encrypt($d->id));

                    $viewUrl = url('admin/user/show', encrypt($d->id));

                    $actions = '';

                    if ($d->roles['name'] != 'Super admin') {

                        //Permission edit
                        if (auth()->user()->hasPermission("user.edit")) {
                            $actions .= "<a href='" . $editUrl . "' class='btn btn-primary btn-sm m-1 text-decoration-none '><i class='fas fa-pencil-alt'></i> Edit</a>";
                        }

                        //Permission show
                        if (auth()->user()->hasPermission("user.show")) {
                            $actions .= "<a href='" . $viewUrl . "' class='btn btn-success btn-sm m-1 text-decoration-none '><i class='fas fa-eye'></i> View</a>";
                        }

                        //Permission destroy
                        if (auth()->user()->hasPermission("user.destroy")) {
                            $actions .= "<a href='" . $deleteUrl . "' class='btn btn-danger btn-sm m-1 text-decoration-none  delete' id='delete' data-id='" . $d->id . "'><i class='fa-regular fa-trash-can'></i> Delete</a>";
                        }

                        //Permission status
                        if (auth()->user()->hasPermission("user.status")) {
                            if ($d->status == 0) {
                                $actions .= " <a id='activate' href='#' class='activate btn btn-warning text-decoration-none btn-sm ' data-id='" . $d->id . "'><i class='fa-solid fa-check'></i> Active</a>";
                            } else {
                                $actions .= " <a id='deactivate' href='#'class='deactivate btn btn-warning btn-sm  text-decoration-none ' data-id='" . $d->id . "'><i class='fa-solid fa-ban'></i> Inactive</a>";
                            }
                        }
                    }
                    return $actions;
                })
                ->editColumn('status', function ($d) {
                    if ($d->status == 0) {
                        return "<center>
                        <span class='badge badge-danger'>Inactive</span>
                        </center>";
                    } else {
                        return "<center>
                        <span class='badge badge-success'>Active</span>
                        </center>";
                    }
                })
                ->addColumn('userrole', function ($d) {
                    return "<center>
                        <span class='badge badge-info'>" . $d->roles['name'] . "</span>
                        </center>";
                })
                ->filter(function ($data) use ($request) {

                    //check role
                    if ($request->get('role_id')) {
                        $data->where('role_id', $request->get('role_id'));
                    }

                    //check status
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $data->where('status', $request->get('status'));
                    }

                    if (!empty($request->get('search'))) {
                        $data->where(function ($wordsearch) use ($request) {
                            $search = $request->get('search');
                            $wordsearch->orWhere('name', 'LIKE', "%$search%")
                                ->orWhere('email', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action', 'userrole', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
        $Role = Role::get();
        $module_name = $this->module_name;
        return view('admin.user.index', compact('module_name', 'Role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $module_name = $this->module_name;

        $Role = Role::status('1')->whereNull('deleted_at')->get();

        $permissions = Permission::get()->groupBy('model');

        return view('admin.user.form', compact('module_name', 'Role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $module_name = $this->module_name;
        $data = [
            'role_id' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make($request->password),
            'password_view' => $request->password,
            'added_by' => Auth()->user()->id
        ];

        $permission = $request->permission;

        $user = User::create($data);

        $user->permissions_user()->attach($permission);
        return redirect('admin/user')->with('success', $module_name . ' Add Successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $module_name = $this->module_name;
        $data = User::where('id', decrypt($id))->first();
        $Role = Role::status('1')->whereNull('deleted_at')->get();
        $permissions = Permission::get()->groupBy('model');
        $approved = PermissionUser::where('user_id', decrypt($id))->pluck('permission_id')->toArray();
        return view('admin.user.show', compact('module_name', 'Role', 'permissions', 'data', 'approved'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $module_name = $this->module_name;
        $data = User::where('id', decrypt($id))->first();
        $Role = Role::status('1')->whereNull('deleted_at')->get();
        $permissions = Permission::get()->groupBy('model');
        $approved = PermissionUser::where('user_id', decrypt($id))->pluck('permission_id')->toArray();
        return view('admin.user._form', compact('module_name', 'Role', 'permissions', 'data', 'approved'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $module_name = $this->module_name;
        $data = [
            'role_id' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'updated_by' => Auth()->user()->id
        ];
        if (!empty($request->password)) {
            User::where('id', decrypt($id))->update(['password' => Hash::make($request->password), 'password_view' => $request->password]);
        }
        User::where('id', decrypt($id))->update($data);
        $permission = $request->permission;
        $user = User::find(decrypt($id));

        $user->permissions_user()->sync($permission);
        return redirect('admin/user')->with('success', $module_name . ' Update Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        User::where('id', $id)->delete();
        PermissionUser::where('user_id', $id)->delete();
        return response()->json(['status' => true]);
    }

    public function status(Request $request)
    {
        $id = $request->id;

        $User = User::where('id', $id)->first();

        if ($User->status == 1) {

            User::where('id', $id)->update(['status' => 0]);

            return response()->json([
                'status' => true
            ]);
        } else {
            User::where('id', $id)->update(['status' => 1]);

            return response()->json([
                'status' => true
            ]);
        }
    }
}
