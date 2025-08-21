<?php


namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Savings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = DB::table('savings')
        ->select('date', DB::raw('SUM(amount) as total_amount'))
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->paginate(15); // pagination 

    return view('backend.savings.savings_index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 1)->where('status',2)->get();
        $savings = Savings::all();
       
        return view('backend.savings.savings_create', compact('savings','users',));
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
                Savings::create([
                    'user_id' => $data['user_id'],
                    'amount'  => $data['amount'],
                    'date'    => $date, // Use the shared form date
                ]);
                $total_amount += $data['amount'];
                User::findOrFail($data['user_id'])->increment('balance',$data['amount']);
            }
        }
         transactions($date,'Savings Collections',$total_amount,'in');
    }
    return redirect()->route('savings.index')->with('success', 'Savings added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Savings $savings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
   
    public function editDate($date)
    {
        $users = User::where('role', 1)->where('status',2)->get();
   
    return view('backend.savings.savings_edit', compact('date','users'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function updateDate(Request $request, $date)
    {
        $date = $request->input('date', $date); // Use input date or fallback to route param

    if ($request->collections) {
        $newAmount = 0;
        $oldAmount = Savings::whereDate('date', $date)->sum('amount'); // Total of old records

        // Process and store new savings
        foreach ($request->collections as $data) {
            if (!empty($data['amount']) && $data['amount'] > 0) {
                Savings::create([
                    'user_id' => $data['user_id'],
                    'amount'  => $data['amount'],
                    'date'    => $date,
                ]);
                User::findOrFail($data['user_id'])->increment('balance', $data['amount']);
                $newAmount += $data['amount'];
            }
        }

        // If amount changed, log transactions
        if ($oldAmount != $newAmount) {
            if ($oldAmount > 0) {
                transactions($date, 'Savings Amount (Update Reversal)', $oldAmount, 'out');
            }
            if ($newAmount > 0) {
                transactions($date, 'Savings Amount (Updated)', $newAmount, 'in');
            }
        }
        return redirect()->route('savings.index')->with('success', 'Savings updated successfully.');
    }

    return redirect()->route('savings.index')->with('warning', 'No collections were provided.');
    }

    public function destroyDate($date)
    {
     Savings::whereDate('date', $date)->delete();

    return redirect()->route('savings.index')->with('success', 'All collections for date ' . $date . ' deleted successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */

}
