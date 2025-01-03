<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Imports\CustomersImport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{

    public function records() {
        $users = CustomerResource::collection(Customer::all());

        return datatables()->of($users)
            ->addColumn('action', function ($row) {
                $html = '<a href="customers/' . $row['id'] . '/edit" class="btn btn-xs btn-secondary"><i class="fa fa-edit"></i> Επεξεργασία</a> ';
                $html .= '<button data-rowid="' . $row['id'] . '" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Διαγραφή</button>';
                return $html;
            })->toJson();
    }


    public function index()
    {
        return view('customers.customers');
    }

    public function create()
    {
        return view('customers.customer')->with('action','create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'activity' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'nullable|string|max:15',
            'vat' => 'required|numeric',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $contacts = $customer->contacts()->get();
        //return $contacts;
        return view('customers.customer', compact('customer', 'contacts'));
    }

    public function update(Request $request, Customer $customer)
    {
        //return $request->all();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'activity' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:15',
            'vat' => 'required|numeric',
        ]);
        // Update the customer
        $customer->update($request->all());
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $import = new CustomersImport();

        try {
            Excel::import($import, $request->file('file'));

            $results = $import->results;

            return response()->json([
                'success' => true,
                'message' => "{$results['success']} customers imported successfully.",
                'skipped' => "{$results['skipped']} duplicate records were skipped.",
                'errors' => $results['errors'],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error during import: ' . $e->getMessage(),
            ], 500);
        }
    }
}
