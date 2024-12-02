<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class PermissionController extends Controller
{
    public function records() {
        //abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $records = Permission::all();
        return datatables()->of($records)
            ->addColumn('action', function ($row) {
                $html = '<a href="permission/edit/' . $row['id'] . '" class="btn btn-xs btn-secondary"><i class="fa fa-edit"></i> Επεξεργασία</a> ';
                $html .= '<button data-rowid="' . $row['id'] . '" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Διαγραφή</button>';
                return $html;
            })->toJson();
    }

    public function index()
    {
        //abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('permissions.permissions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('permissions.permission')->with('action','create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rules = [
            'title' => 'required',
        ];

       $messages = [
          'title.required' => 'Υποχρεωτικό πεδίο',
       ];

      $validator = Validator::make( $request->all(), $rules, $messages );

      if ($validator->fails()) {
        return Redirect::back()->withInput()->withErrors($validator->messages());
      }

      $role = Permission::create(['name' => $request->title]);
        //$role->givePermissionTo($request->permissions);

      return Redirect::to('/permissions')->withInput()->with('success', "Αποθηκεύτηκε");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $record = \App\Models\Permission::find($id);

        return view('permissions.permission')->with('record',$record)->with('action','update');
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
        //abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


            $rules = [
                'title' => 'required',
            ];

            $messages = [
                'title.required' => 'Υποχρεωτικό πεδίο',
            ];

          $validator = Validator::make( $request->all(), $rules, $messages );

          if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->messages());
          }

          $record = Permission::find($id);
          $record->title = $request->title;
          $record->save();


          return Redirect::to('/permissions')->withInput()->with('success', "Αποθηκεύτηκε");
          //return $record;
        }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
