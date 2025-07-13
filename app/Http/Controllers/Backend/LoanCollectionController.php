<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanCollection;
use App\Models\User;
use Illuminate\Http\Request;



class LoanCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loanCollections = LoanCollection::with(['user', 'loan'])->latest()->paginate(10);
        return view('backend.loan_collection.loan_collection_index', compact('loanCollections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $users = User::all();
        $loans = Loan::all();
        return view('backend.loan_collection.loan_collection_create', compact('users', 'loans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'nullable|exists:loans,id',
            'date' => 'nullable|date',
         
        ]);
         // Use helper function to get amount
        $amount = loan_balance($validated['loan_id']);

        // Add amount to validated data
        $validated['amount'] = $amount;


        LoanCollection::create($validated);

        return redirect()->route('loan_collections.index')->with('success', 'Loan collection added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoanCollection $loanCollection)
    {
        $users = User::all();
        $loans = Loan::all();
        return view('backend.loan_collection.loan_collection_edit', compact('loanCollection', 'users', 'loans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanCollection $loanCollection)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'loan_id' => 'nullable|exists:loans,id',
            'date' => 'nullable|date',
         
        ]);
         // Recalculate amount using helper
        $validated['amount'] = loan_balance($validated['loan_id']);

        $loanCollection->update($validated);

        return redirect()->route('loan_collections.index')->with('success', 'Loan collection updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanCollection $loanCollection)
    {
        $loanCollection->delete();

        return redirect()->route('loan_collections.index')->with('success', 'Loan collection deleted successfully.');
    }
}