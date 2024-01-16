<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public $module_name = 'Role';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $Role = Role::query();
            return DataTables::eloquent($Role)
                ->addColumn('action', function ($d) {

                    $editUrl = url('admin/role/edit', encrypt($d->id));

                    $deleteUrl = url('admin/role/delete', encrypt($d->id));

                    $viewUrl = url('admin/role/show', encrypt($d->id));

                    $actions = '';

                    if ($d->name != 'Super admin') {

                        //Permission edit
                        if (auth()->user()->hasPermission("role.edit")) {
                            $actions .= "<a href='" . $editUrl . "' class='btn btn-primary btn-sm m-1 text-decoration-none '><i class='fas fa-pencil-alt'></i> Edit</a>";
                        }

                        //Permission show
                        if (auth()->user()->hasPermission("role.show")) {
                            $actions .= "<a href='" . $viewUrl . "' class='btn btn-success btn-sm m-1 text-decoration-none '><i class='fas fa-eye'></i> View</a>";
                        }

                        //Permission destroy
                        if (auth()->user()->hasPermission("role.destroy")) {
                            $actions .= "<a href='" . $deleteUrl . "' class='btn btn-danger btn-sm m-1 text-decoration-none  delete' id='delete' data-id='" . $d->id . "'><i class='fa-regular fa-trash-can'></i> Delete</a>";
                        }

                        //Permission status
                        if (auth()->user()->hasPermission("role.status")) {
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
                ->filter(function ($data) use ($request) {
                    //check status
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $data->where('status', $request->get('status'));
                    }
                    if (!empty($request->get('search'))) {
                        $data->where(function ($wordsearch) use ($request) {
                            $search = $request->get('search');
                            $wordsearch->orWhere('name', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
        $module_name = $this->module_name;
        return view('admin.role.index', compact('module_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $module_name = $this->module_name;
        return view('admin.role.form', compact('module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = [
            'name' => $request->name,
            'status' => $request->status,
            'added_by' => auth()->user()->id
        ];

        Role::create($data);

        return redirect('admin/role')->with('success', $this->module_name . ' Create  Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $module_name = $this->module_name;
        $data = Role::find(decrypt($id));
        return view('admin.role.show', compact('module_name', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $module_name = $this->module_name;
        $data = Role::find(decrypt($id));
        return view('admin.role._form', compact('module_name', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        Role::where('id', decrypt($id))->update(
            [
                'name' => $request->name,
                'status' => $request->status,
                'updated_by' => auth()->user()->id
            ]
        );

        return redirect('admin/role')->with('success', $this->module_name . ' Update Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        Role::where('id', $id)->delete();
        return response()->json(['status' => true]);
    }

    public function status(Request $request)
    {
        $id = $request->id;

        $Role = Role::where('id', $id)->first();

        if ($Role->status == 1) {

            Role::where('id', $id)->update(['status' => 0]);
            User::where('role_id', $id)->update(['status' => 0]);
            return response()->json([
                'status' => true
            ]);
        } else {
            Role::where('id', $id)->update(['status' => 1]);

            return response()->json([
                'status' => true
            ]);
        }
    }
}
