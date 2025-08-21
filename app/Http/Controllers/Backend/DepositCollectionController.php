<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\DepositCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class depositCollectionController extends Controller
{
   
    public function index()
    {
    // deposit_collections 
    $collections = DB::table('deposit_collections')
        ->select('date', DB::raw('SUM(amount) as total_amount'))
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->paginate(15); // pagination 

    return view('backend.deposit_collection.deposit_collection_index', compact('collections'));
    }

    public function create()
    {
        $deposits =  Deposit::where('status', 2)->get();
        return view('backend.deposit_collection.deposit_collection_create', compact('deposits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
    $date = $request->input('date'); // Get the top-level date

   $total_amount = 0;
   
    if ($request->collections) {
       

        foreach ($request->collections as $data) {
            if (!empty($data['amount']) && $data['amount'] > 0) {
                DepositCollection::create([
                    
                    'user_id' => $data['user_id'],
                    'amount'  => $data['amount'],
                    'date'    => $date, // Use the shared form date
                ]);
               
                $request->validate([
                    'date' => 'required|date',
                    'collections.*.amount' => 'nullable|numeric|min:0',
                ]);
                 $total_amount += $data['amount']; // Add to total
            }
            
        }
       transactions($date,'deposit Collections', $total_amount ,'in');
    }

    return redirect()->route('deposit_collections.index')->with('success', 'deposit collection added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function editDate($date)
    {
    $deposits =  Deposit::where('status', 2)->get();

    return view('backend.deposit_collection.deposit_collection_edit', compact('date', 'deposits'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateDate(Request $request, $date){
       

    if ($request->collections) {
          $newAmount = 0;
        $oldAmount = DepositCollection::whereDate('date', $date)->sum('amount'); // Total of old records
          
        foreach ($request->collections as $data) {
            if (!empty($data['amount']) && $data['amount'] > 0) {
                DepositCollection::where('user_id', $data['user_id'])
                    ->whereDate('date', $date)
                    ->update(
                        [
                            'amount' => $data['amount'],
                        ]
                    );
                     $newAmount += $data['amount'];
            }
        }
         if ($oldAmount != $newAmount) {
            if ($oldAmount > 0) {
                transactions($date, 'Deposit Collection (Update Reversal)', $oldAmount, 'out');
            }
            if ($newAmount > 0) {
                transactions($date, 'Deposit deposit collection (Updated)', $newAmount, 'in');
            }
        }
    }

    return redirect()->route('deposit_collections.index')->with('success', 'deposit collection updated successfully.');
    }

    public function destroyDate($date)
    {
    DepositCollection::whereDate('date', $date)->delete();

    return redirect()->route('deposit_collections.index')->with('success', 'All collections for date ' . $date . ' deleted successfully.');
    }


}