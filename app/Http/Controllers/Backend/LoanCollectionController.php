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
        $total_amount = 0;

        foreach ($request->collections as $data) {
            if (!empty($data['amount']) && $data['amount'] > 0) {

                // Create the loan collection entry
                LoanCollection::create([
                    'loan_id' => $data['loan_id'],
                    'user_id' => $data['user_id'],
                    'amount'  => $data['amount'],
                    'date'    => $date,
                ]);

                // Subtract the collected amount from the loan's total_balance
                $loan = Loan::find($data['loan_id']);
                if ($loan) {
                    $loan->decrement('total_balance',$data['amount']);
                }

                $total_amount += $data['amount'];
            }
        }

        // Log the total collection
        transactions($date, 'Loan Collections', $total_amount, 'in');
    }

    return redirect()->route('loan_collections.index')->with('success', 'Loan collection added successfully.');
}
    /**
     * Show the form for editing the specified resource.
     */

    public function editDate($date)
    {
    $loans =  Loan::where('status', 2)->get();

    return view('backend.loan_collection.loan_collection_edit', compact('date', 'loans'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateDate(Request $request, $date){
       

    if ($request->collections) {
        $newAmount = 0;
        $oldAmount = LoanCollection::whereDate('date', $date)->sum('amount'); // Total of old records

        
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
                     $newAmount += $data['amount'];
            }
        }
         // If amount changed, log transactions
        if ($oldAmount != $newAmount) {
            if ($oldAmount > 0) {
                transactions($date, 'loan Amount (Update Reversal)', $oldAmount, 'out');
            }
            if ($newAmount > 0) {
                transactions($date, 'loan Amount (Updated)', $newAmount, 'in');
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