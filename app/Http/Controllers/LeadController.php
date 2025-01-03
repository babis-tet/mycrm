<?php

namespace App\Http\Controllers;

use App\Http\Resources\LeadResource;
use App\Models\Customer;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{

    public function records() {
        $users = LeadResource::collection(Lead::all());

        return datatables()->of($users)
            ->addColumn('action', function ($row) {
                $html = '<a href="leads/' . $row['id'] . '/edit" class="btn btn-xs btn-secondary"><i class="fa fa-edit"></i> Επεξεργασία</a> ';
                $html .= '<button data-rowid="' . $row['id'] . '" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Διαγραφή</button>';
                return $html;
            })->toJson();
    }


    public function convert(Request $request) {
        $request->validate([
            'id' => 'required|integer|exists:leads,id', // Ensure the ID exists in the leads table
        ]);
        $lead = Lead::findOrFail($request->id);

        $customerData = [
            'name' => $lead->name,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'address' => $lead->address,
            'vat' => $lead->vat,
            'activity' => $lead->activity
        ];
        $customer = Customer::create($customerData);

        $lead->converted = 1;
        // Return a success response
        return response()->json([
            'message' => 'Lead successfully converted to customer',
            'customer_id' => $customer->id,
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return view('leads.leads');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leads.lead')->with('action','create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'activity' => 'required|string|max:255',
            'email' => 'required|email|unique:leads',
            'phone' => 'nullable|string|max:15',
            'vat' => 'required|numeric',
        ]);

        Lead::create($validated);

        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        return view('leads.lead', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'activity' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email,' . $lead->id,
            'phone' => 'nullable|string|max:15',
            'vat' => 'required|numeric',
        ]);
        // Update the lead
        $lead->update($request->all());
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');
    }
}
