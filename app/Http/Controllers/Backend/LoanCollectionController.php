<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class LoanCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // loan_collections 
    $collections = DB::table('loan_collections')
        ->select('date', DB::raw('SUM(amount) as total_amount'))
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->paginate(15); // pagination 

    return view('backend.loan_collection.loan_collection_index', compact('collections'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loans =  Loan::where('status', 2)->get();
        return view('backend.loan_collection.loan_collection_create', compact('loans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $date = $request->input('date'); // Get the top-level date

    if ($request->collections) {
        foreach ($request->collections as $data) {
            if (!empty($data['amount']) && $data['amount'] > 0) {
                LoanCollection::create([
                    'loan_id' => $data['loan_id'],
                    'user_id' => $data['user_id'],
                    'amount'  => $data['amount'],
                    'date'    => $date, // Use the shared form date
                ]);
                $request->validate([
    'date' => 'required|date',
    'collections.*.amount' => 'nullable|numeric|min:0',
]);
            }
        }
    }

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


    public function editDate($date)
{
    $loans =  Loan::where('status', 2)->get();

    return view('backend.loan_collection.loan_collection_edit', compact('date', 'loans'));
}

 public function updateDate(Request $request, $date)
{

    if ($request->collections) {
        foreach ($request->collections as $data) {
            if (!empty($data['amount']) && $data['amount'] > 0) {
                LoanCollection::where('loan_id', $data['loan_id'])
                    ->where('user_id', $data['user_id'])
                    ->whereDate('date', $date)
                    ->update(
                        [
                            'amount' => $data['amount'],
                        ]
                    );
            }
        }
    }

    return redirect()->route('loan_collections.index')->with('success', 'Loan collection updated successfully.');
    }

public function destroyDate($date)
{
    LoanCollection::whereDate('date', $date)->delete();

    return redirect()->route('loan_collections.index')->with('success', 'All collections for date ' . $date . ' deleted successfully.');
}


}