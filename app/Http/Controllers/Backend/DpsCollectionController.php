<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DPS;
use App\Models\DpsCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DpsCollectionController extends Controller
{
    public function index()
    {
    // dps_collections 
    $collections = DB::table('dps_collections')
        ->select('date', DB::raw('SUM(amount) as total_amount'))
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->paginate(15); // pagination 

    return view('backend.dps_collection.dps_collection_index', compact('collections'));
    }

    public function create()
    {
        $dpss =  DPS::where('status', 2)->get();
        return view('backend.dps_collection.dps_collection_create', compact('dpss'));
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
                DpsCollection::create([
                    'dps_id' => $data['dps_id'],
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
         transactions($date,'DPS Collections', $total_amount ,'in');
    }

    return redirect()->route('dps_collections.index')->with('success', 'dps collection added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function editDate($date)
    {
    $dpss =  DPS::where('status', 2)->get();
    
    return view('backend.dps_collection.dps_collection_edit', compact('date', 'dpss'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateDate(Request $request, $date){
        

    if ($request->collections) {
         $newAmount = 0;
        $oldAmount = DpsCollection::whereDate('date', $date)->sum('amount'); // Total of old records
        foreach ($request->collections as $data) {
            if (!empty($data['amount']) && $data['amount'] > 0) {
                DpsCollection::where('dps_id', $data['dps_id'])
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
        if ($oldAmount != $newAmount) {
            if ($oldAmount > 0) {
                transactions($date, 'DPS Amount (Update Reversal)', $oldAmount, 'out');
            }
            if ($newAmount > 0) {
                transactions($date, 'DPS Amount (Updated)', $newAmount, 'in');
            }
        }
    }

    return redirect()->route('dps_collections.index')->with('success', 'dps collection updated successfully.');
    }

    public function destroyDate($date)
    {
    dpsCollection::whereDate('date', $date)->delete();

    return redirect()->route('dps_collections.index')->with('success', 'All collections for date ' . $date . ' deleted successfully.');
    }


}