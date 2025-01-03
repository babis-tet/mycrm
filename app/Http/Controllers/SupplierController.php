<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function records() {
        $users = SupplierResource::collection(Supplier::all());

        return datatables()->of($users)
            ->addColumn('action', function ($row) {
                $html = '<a href="suppliers/' . $row['id'] . '/edit" class="btn btn-xs btn-secondary"><i class="fa fa-edit"></i> Επεξεργασία</a> ';
                $html .= '<button data-rowid="' . $row['id'] . '" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Διαγραφή</button>';
                return $html;
            })->toJson();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('suppliers.suppliers');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.supplier')->with('action','create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
        ]);

        $data = array_merge(
            $validated,                // Validated fields
            $request->all()
        );

        Supplier::create($data);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
         return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $contacts = $supplier->contacts()->get();
        //return $contacts;
        return view('suppliers.supplier', compact('supplier', 'contacts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //return $request->all();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $supplier->id,
        ]);
        // Update the customer
        $data = array_merge(
            $validated,                // Validated fields
            $request->all()
        );

        $supplier->update($data);
        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
    }
}
