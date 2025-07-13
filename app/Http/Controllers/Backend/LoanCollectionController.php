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
        $loans = Loan::with('user')->get(); // Only active loans ideally
        $loanCollections = LoanCollection::with(['user', 'loan'])->latest()->paginate(10);
        return view('backend.loan_collection.loan_collection_index', compact('loanCollections','loans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $users = User::all();
        $loanCollections = LoanCollection::all();
         $loans = Loan::with(['user', 'LoanCollection'])->get();
        return view('backend.loan_collection.loan_collection_create', compact('loanCollections','users', 'loans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
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

    public function storeBulk(Request $request)
{
    $request->validate([
        'collections.*.loan_id' => 'required|exists:loans,id',
        'collections.*.amount' => 'nullable|numeric|min:0',
    ]);

    foreach ($request->collections as $data) {
        if (!empty($data['amount']) && $data['amount'] > 0) {
            LoanCollection::create([
                'loan_id' => $data['loan_id'],
                'amount' => $data['amount'],
                'date' => now(),
            ]);

            // Optionally deduct this from the loan's balance here
        }
    }

    return redirect()->back()->with('success', 'Loan collections saved successfully!');
}
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