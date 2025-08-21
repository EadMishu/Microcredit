<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DPS;
use App\Models\DpsType;
use App\Models\User;
use Illuminate\Http\Request;

class DpsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dps = DPS::with(['user', 'dpsType'])->latest()->get();
        return view('backend.dps.dps_index', compact('dps'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $users = User::where('role', '=', 1)->get(); // exclude admin if needed
    $dpsTypes = DpsType::all();

    return view('backend.dps.dps_create', compact('users', 'dpsTypes'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'dps_number' => 'required|unique:dps',
        'user_id' => 'required|exists:users,id',
        "amount" => "nullable|string|max:10",
        "dps_fee" => "nullable|string|max:10",
        "service_charge" => "nullable|string|max:10",
        "stamp_charge" => "nullable|string|max:10",
        "premium" => "nullable|string|max:10",
        'dps_type_id' => 'required|exists:dps_type,id',
        'open_date' => 'required|date',
        'close_date' => 'nullable|date|after_or_equal:open_date',
        'closed_date' => 'nullable|date|after_or_equal:open_date',
    ]);

   

        DPS::create($validated);

        return redirect()->route('dps.index')->with('success', 'DPS created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DPS $dps)
{
    $users = User::where('role', '=', 1)->get();
    $dpsType = DpsType::all();
  return view('backend.dps.dps_edit', compact('dps', 'users', 'dpsType'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $dps = DPS::findOrFail($id);

    $validated = $request->validate([
        'dps_number' => 'required|unique:dps,dps_number,' . $dps->id,
        'user_id' => 'required|exists:users,id',
        "amount" => "nullable|string|max:10",
        "dps_fee" => "nullable|string|max:10",
        "service_charge" => "nullable|string|max:10",
        "stamp_charge" => "nullable|string|max:10",
        "premium" => "nullable|string|max:10",
        'dps_type_id' => 'required|exists:dps_type,id',
        'open_date' => 'required|date',
        'close_date' => 'nullable|date|after_or_equal:open_date',
        'closed_date' => 'nullable|date|after_or_equal:open_date',
    ]);

    $date = $request->open_date;

    // Handle amount change
    $oldAmount = floatval($dps->amount);
    $newAmount = floatval($request->amount);
    $oldDPS = floatval($dps->dps_fee);
    $newDPS = floatval($request->dps_fee);
    $oldservice_charge = floatval($dps->service_charge);
    $newservice_charge = floatval($request->service_charge);
    $oldstamp_charge = floatval($dps->stamp_charge);
    $newstamp_charge = floatval($request->stamp_charge);

    if ($request->has('amount') && $oldAmount != $newAmount) {
        if ($oldAmount > 0) {
            transactions($date, 'Dps Amount (Update Reversal)', $oldAmount, 'out');
        }
        if ($newAmount > 0) {
            transactions($date, 'Dps Amount (Updated)', $newAmount, 'in');
        }
    }

     if ($request->has('dps_fee') && $oldDPS != $newDPS) {
        if ($oldDPS > 0) {
            transactions($date, 'DPS fee (Update Reversal)', $oldDPS, 'out');
        }
        if ($newDPS > 0) {
            transactions($date, 'DPS fee (Updated)', $newDPS, 'in');
        }
    }
    if ($request->has('service_charge') && $oldservice_charge != $newservice_charge) {
        if ($oldservice_charge > 0) {
            transactions($date, 'Service Charge (Update Reversal)', $oldservice_charge, 'out');
        }
        if ($newservice_charge > 0) {
            transactions($date, 'Service Charge (Updated)', $newservice_charge, 'in');
        }
    }
    if ($request->has('stamp_charge') && $oldstamp_charge != $newstamp_charge) {
        if ($oldstamp_charge > 0) {
            transactions($date, 'Stamp Charge (Update Reversal)', $oldstamp_charge, 'out');
        }
        if ($newstamp_charge > 0) {
            transactions($date, 'Stamp Charge (Updated)', $newstamp_charge, 'in');
        }
    }

    // Update the DPS record
    $dps->update($validated);

    return redirect()->route('dps.index')->with('success', 'DPS updated successfully.');
}


 public function updateStatus(Request $request, $id)
    {
    $dps = DPS::findOrFail($id);
     $oldStatus = $dps->status;
    $newStatus = $request->input('status');
    $dps ->status = $request->input('status');
    $dps ->save();

      if ($oldStatus != 2 && $newStatus == 2) {
        $date = $dps->open_date; // Assuming open_date is set on dps

        if ($dps->amount) {
            transactions($date, 'Dps Amount', floatval($dps->amount), 'in');
        }
        if ($dps->dps_fee) {
            transactions($date, 'dps Fee', floatval($dps->dps_fee), 'in');
        }
        if ($dps->service_charge) {
            transactions($date, 'Service Charge', floatval($dps->service_charge), 'in');
        }
        if ($dps->stamp_charge) {
            transactions($date, 'Stamp Charge', floatval($dps->stamp_charge), 'in');
        }
       
    }

    return redirect()->back()->with('success', 'dps  status updated successfully.');
    }

    public function cashwithdraw(Request $request)
{

    
    $validated = $request->validate([
        'amount' => 'required|numeric|min:0.01',
        'date' => 'required|date',
        'dps_id' => 'required|exists:dps,id',
    ]);
   

    $dps = Dps::findOrFail($validated['dps_id']);
    $date = $validated['date'];
    $amountWithdraw = $validated['amount'];
    

    // ✅ Check if user has sufficient balance
    if ($dps->amount < $amountWithdraw) {
        return redirect()->back()->with('error', 'Insufficient balance. Available: ' . $dps->amount);
    }

    // ✅ Record transaction
    transactions($date, 'DPS Balance Withdraw ', $amountWithdraw, 'out');

    withdraw($date, $dps->user_id, $amountWithdraw);


    // ✅ Deduct balance
    $dps->amount -= $amountWithdraw;
    $dps->save();

    return redirect()->back()->with('success', 'Cash withdrawn successfully.');
}
public function interestStore(Request $request)
{
   
    $validated = $request->validate([
        'amount' => 'required|numeric|min:0.01',
        'date' => 'required|date',
        'dps_id' => 'required|exists:dps,id',
    ]);

    $dps = Dps::findOrFail($validated['dps_id']);
    $date = $validated['date'];
    $amountAdd = $validated['amount'];

    interest($date, $dps->user_id, $amountAdd);

    // ✅ Record transaction
    transactions($date, 'DPS Interest Balance', $amountAdd, 'out');

    // ✅ Add balance
    $dps->amount += $amountAdd;
    $dps->save();

    return redirect()->back()->with('success', 'Interest added successfully.');
}





    /**
     * Remove the specified resource from storage.
     */
     public function destroy(DPS $dps)
    {
       $dps->delete();

        return redirect()->route('dps.index')->with('success', 'DPS deleted successfully.');
    }
}
