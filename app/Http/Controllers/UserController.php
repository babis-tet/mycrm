<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{


     public function records() {
        $users = UserResource::collection(User::all());

        return datatables()->of($users)
            ->addColumn('action', function ($row) {
                $html = '<a href="user/edit/' . $row['id'] . '" class="btn btn-xs btn-secondary"><i class="fa fa-edit"></i> Επεξεργασία</a> ';
                $html .= '<button data-rowid="' . $row['id'] . '" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Διαγραφή</button>';
                return $html;
            })->toJson();
    }


    public function activity(Request $request)
    {


        $activities = Activity::with('causer') // Eager load the causer (user) relationship
        //->where('causer_id', auth()->id())
        ->latest()
        ->get();

        return datatables()->of($activities)
            ->addColumn('user', function ($row) {
                // Add the user's name (causer) to the table
                return $row->causer ? $row->causer->name : 'System';
            })
            ->addColumn('description', function ($row) {
                // Add the description of the activity
                return e($row->description);
            })
            ->addColumn('changes', function ($row) {
                // Show changed properties
                $changes = $row->properties['attributes'] ?? [];
                $original = $row->properties['old'] ?? [];

                $html = '<ul>';
                foreach ($changes as $key => $value) {
                    $originalValue = $original[$key] ?? 'N/A';
                    $html .= '<li>' . e($key) . ': ' . e($originalValue) . ' → ' . e($value) . '</li>';
                }
                $html .= '</ul>';

                return $html;
            })
            ->addColumn('date', function ($row) {
                // Format the created_at date
                return $row->created_at->format('d-m-Y H:i:s');
            })
            ->rawColumns(['user', 'description','changes', 'date']) // Allow raw HTML if needed
            ->toJson();
    }

    public function index()
    {
        return view('users.users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::all();
        return view('users.user')->with('action','create')->with('roles', $roles)->with('current', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            //'role_id' => 'required',

             ];

           $messages = [
              'name.required' => 'Υποχρεωτικό πεδίο',
              'email.required' => 'Υποχρεωτικό πεδίο',
              'email.unique' => 'Υπάρχει ήδη',
              'password.required' => 'Υποχρεωτικό πεδίο',
              //'role_id.required' => 'Υποχρεωτικό πεδίο',
           ];

      $validator = Validator::make( $request->all(), $rules, $messages );

      if ($validator->fails()) {
        return Redirect::back()->withInput()->withErrors($validator->messages());
      }

      $record = new User;
      $record->name = $request->name;
      $record->email = $request->email;
      $record->password = Hash::make($request->password);
      $record->save();

//        if ($record) {
//            $role = new \App\Models\Roleuser;
//            $role->user_id = $record->id;
//            $role->role_id = $request->role_id;
//            $role->save();
//        }

      return Redirect::to('/users')->withInput()->with('success', "Αποθηκεύτηκε");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $record = User::find($id);
        $roles = Role::all();
        $current = $record->getRoleNames()->toArray();
        return view('users.user')->with('record',$record)->with('action','update')->with('roles', $roles)->with('current', $current);
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

        //abort_if(Gate::denies('user_management_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $rules = [
            'name' => 'required',
            //'email' => 'required',
            'password' => 'required',
            //'role_id' => 'required',
             ];

           $messages = [
              'name.required' => 'Υποχρεωτικό πεδίο',
              //'email.required' => 'Υποχρεωτικό πεδίο',
              //'email.unique' => 'Υπάρχει ήδη',
              'password.required' => 'Υποχρεωτικό πεδίο',
              //'role_id.required' => 'Υποχρεωτικό πεδίο',
           ];

          $validator = Validator::make( $request->all(), $rules, $messages );

          if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->messages());
          }

          $record = User::find($id);
          $record->name = $request->name;
          //$record->email = $request->email;
          if ($request->filled('password')) {
            $record->password = bcrypt($request->password);
          }
          $record->save();
          $record->syncRoles($request->role_id);

          return Redirect::to('/users')->withInput()->with('success', "Αποθηκεύτηκε");
          //return $record;
        }

    /*
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
