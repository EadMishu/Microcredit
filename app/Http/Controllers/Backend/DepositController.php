<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\DepositType;
use App\Models\User;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deposit = Deposit::with(['member', 'depositType'])->latest()->get();
       return view('backend.deposit.deposit_index',compact('deposit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = User::where('role', '=', 1)->get(); // exclude admin if needed
    $depositTypes = DepositType::all();

    return view('backend.deposit.deposit_create', compact('members', 'depositTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
  

    $validated = $request->validate([
        'deposit_number'   => 'required|unique:deposit',
        'member_id'        => 'required|exists:users,id',
        'amount'           => 'nullable|string|max:10',
        'deposit_fee'      => 'nullable|string|max:10',
        'service_charge'   => 'nullable|string|max:10',
        'stamp_charge'     => 'nullable|string|max:10',
       
        'deposit_type_id'  => 'required|exists:deposit_type,id',
        'open_date'        => 'required|date',
        'close_date'       => 'nullable|date|after_or_equal:open_date',
        'closed_date'      => 'nullable|date|after_or_equal:open_date',
    ]);

    
    // Store the deposit
    Deposit::create($validated);
    // Only insert transactions if status == 2
    


    return redirect()->route('deposit.index')->with('success', 'Deposit created successfully.');

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
    public function edit(Deposit $deposit)
    {
       $members = User::where('role', '=', 1)->get();
    $depositType = DepositType::all();
  return view('backend.deposit.deposit_edit', compact('deposit', 'members', 'depositType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deposit $deposit)
    {
        $total_amount = 0;

    $validated = $request->validate([
        'deposit_number'   => 'required|unique:deposit,deposit_number,' . $deposit->id,
        'member_id'        => 'required|exists:users,id',
        'amount'           => 'nullable|string|max:10',
        'deposit_fee'      => 'nullable|string|max:10',
        'service_charge'   => 'nullable|string|max:10',
        'stamp_charge'     => 'nullable|string|max:10',
        
        'deposit_type_id'  => 'required|exists:deposit_type,id',
        'open_date'        => 'required|date',
        'close_date'       => 'nullable|date|after_or_equal:open_date',
        'closed_date'      => 'nullable|date|after_or_equal:open_date',
    ]);

    $date = $request->open_date;

    // Handle amount change
    $oldAmount = floatval($deposit->amount);
    $newAmount = floatval($request->amount);
    $olddeposit = floatval($deposit->deposit_fee);
    $newdeposit = floatval($request->deposit_fee);
    $oldservice_charge = floatval($deposit->service_charge);
    $newservice_charge = floatval($request->service_charge);
    $oldstamp_charge = floatval($deposit->stamp_charge);
    $newstamp_charge = floatval($request->stamp_charge);

    if ($request->has('amount') && $oldAmount != $newAmount) {
        if ($oldAmount > 0) {
            transactions($date, 'deposit Amount (Update Reversal)', $oldAmount, 'out');
        }
        if ($newAmount > 0) {
            transactions($date, 'deposit Amount (Updated)', $newAmount, 'in');
        }
    }

     if ($request->has('deposit_fee') && $olddeposit != $newdeposit) {
        if ($olddeposit > 0) {
            transactions($date, 'deposit fee (Update Reversal)', $olddeposit, 'out');
        }
        if ($newdeposit > 0) {
            transactions($date, 'deposit fee (Updated)', $newdeposit, 'in');
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

        $deposit->update($validated);

        return redirect()->route('deposit.index')->with('success', 'Loan created successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
    $deposit = Deposit::findOrFail($id);
     $oldStatus = $deposit->status;
    $newStatus = $request->input('status');
    $deposit ->status = $request->input('status');
    $deposit ->save();

      if ($oldStatus != 2 && $newStatus == 2) {
        $date = $deposit->open_date; // Assuming open_date is set on deposit

        if ($deposit->amount) {
            transactions($date, 'Deposit Amount', floatval($deposit->amount), 'in');
        }
        if ($deposit->deposit_fee) {
            transactions($date, 'Deposit Fee', floatval($deposit->deposit_fee), 'in');
        }
        if ($deposit->service_charge) {
            transactions($date, 'Service Charge', floatval($deposit->service_charge), 'in');
        }
        if ($deposit->stamp_charge) {
            transactions($date, 'Stamp Charge', floatval($deposit->stamp_charge), 'in');
        }
       
    }

    return redirect()->back()->with('success', 'deposit  status updated successfully.');
    }

    public function cashwithdraw(Request $request)
{

    $validated = $request->validate([
        'amount' => 'required|numeric|min:0.01',
        'date' => 'required|date',
        'deposit_id' => 'required|exists:deposit,id',
    ]);
    

    $deposit = Deposit::findOrFail($validated['deposit_id']);
    $date = $validated['date'];
    $amountWithdraw = $validated['amount'];

    // ✅ Check if user has sufficient balance
    if ($deposit->amount < $amountWithdraw) {
        return redirect()->back()->with('error', 'Insufficient balance. Available: ' . $deposit->balance);
    }

    // ✅ Record transaction
    transactions($date, 'Deposit Balance Withdraw', $amountWithdraw, 'out');
    // ✅ Record withdrawal
   withdraw($date, $deposit->member_id, $amountWithdraw);
   



    // ✅ Deduct balance
    $deposit->amount -= $amountWithdraw;
    $deposit->save();

    return redirect()->back()->with('success', 'Cash withdrawn successfully.');
}
public function interestStore(Request $request)
{
   
    $validated = $request->validate([
        'amount' => 'required|numeric|min:0.01',
        'date' => 'required|date',
        'deposit_id' => 'required|exists:deposit,id',
    ]);

    $deposit = Deposit::findOrFail($validated['deposit_id']);
    $date = $validated['date'];
    $amountAdd = $validated['amount'];

    interest($date, $deposit->member_id, $amountAdd);


    // ✅ Record transaction
    transactions($date, 'Deposit Interest Balance', $amountAdd, 'out');

    // ✅ Add balance
    $deposit->amount += $amountAdd;
    $deposit->save();

    return redirect()->back()->with('success', 'Interest added successfully.');
}





    public function destroy(Deposit $deposit)
    {
        $deposit->delete();
        return redirect()->route('deposit.index')->with('success', 'Loan Delete successfully.');
    }
}
