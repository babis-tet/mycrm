<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Symfony\Component\HttpFoundation\Response;
use Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function records() {
        //abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $records = Role::all();
        return datatables()->of($records)
            ->addColumn('action', function ($row) {
                $html = '<a href="role/edit/' . $row['id'] . '" class="btn btn-xs btn-secondary"><i class="fa fa-edit"></i> Επεξεργασία</a> ';
                $html .= '<button data-rowid="' . $row['id'] . '" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Διαγραφή</button>';
                return $html;
            })->toJson();
    }

    public function index()
    {
        //abort_if(Gate::denies('handle.roles'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('roles.roles');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all();
        $current_permissions = [];
        return view('roles.role')->with('action','create')->with('permissions', $permissions)->with('current_permissions',$current_permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rules = [
            'name' => 'required',
        ];

       $messages = [
          'name.required' => 'Υποχρεωτικό πεδίο',
       ];

      $validator = Validator::make( $request->all(), $rules, $messages );

      if ($validator->fails()) {
        return Redirect::back()->withInput()->withErrors($validator->messages());
      }

      $role = Role::create(['name' => $request->title]);
      $role->givePermissionTo($request->permissions);
      return Redirect::to('/roles')->withInput()->with('success', "Αποθηκεύτηκε");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $record =Role::find($id);
        $current_permissions = Role::findByName($record->name)->permissions->pluck('name')->toArray();
        $permissions = Permission::all();
        return view('roles.role')->with('record',$record)->with('action','update')->with('permissions', $permissions)->with('current_permissions',$current_permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


            $rules = [
                'name' => 'required',
            ];

            $messages = [
                'name.required' => 'Υποχρεωτικό πεδίο',
            ];

          $validator = Validator::make( $request->all(), $rules, $messages );

          if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->messages());
          }

          $record = Role::find($id);
          $record->update($request->all());
          $record->syncPermissions($request->permissions);

          return Redirect::to('/roles')->withInput()->with('success', "Αποθηκεύτηκε");
          //return $record;
        }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
