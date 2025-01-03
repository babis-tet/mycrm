<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function phonebook()
    {
         return view('phonebook.phonebook');
    }

    public function records($id,$type) {

        if ($type == 'customer') {
            $type = Customer::class;
        } elseif ($type == 'supplier') {
            $type = Supplier::class;
        }

        $contacts = Contact::where('contactable_id', $id)->where('contactable_type', $type)->get();
        //$contacts = Contact::all();

        return datatables()->of($contacts)
            ->addColumn('action', function ($row) {
                $html = '<button value="' . $row['id'] . '" class="btn btn-xs btn-secondary editRecord"><i class="fa fa-edit"></i> Επεξεργασία</button>';
                $html .= '<button value="' . $row['id'] . '" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Διαγραφή</button>';
                return $html;
            })->toJson();
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request->all());

        if ($request->contactable_type == 'customer') {
            $type = Customer::class;
        } elseif ($request->contactable_type == 'supplier') {
            $type = Supplier::class;
        }

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'surname'  => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $data = array_merge(
            $validated,                // Validated fields
            $request->all(),           // All other request data
            [
                'contactable_id'   => $request->contactable_id, // Additional static/dynamic fields
                'contactable_type' => $type,
            ]
        );

        Contact::create($data);

        return response()->json(['message' => 'Record created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $contact = Contact::find($id);

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'surname'  => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $data = array_merge(
            $validated,                // Validated fields
            $request->all()         // All other request data
        );

        $contact->update($data);

        return response()->json(['message' => 'Record created successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
