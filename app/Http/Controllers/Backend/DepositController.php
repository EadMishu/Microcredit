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
            'deposit_number' => 'required|unique:deposit',
            'member_id' => 'required|exists:users,id',
            "amount" => "nullable|string|max:10",
            'deposit_type_id' => 'required|exists:deposit_type,id',
            'open_date' => 'required|date',
            'close_date' => 'nullable|date|after_or_equal:open_date',
            'closed_date' => 'nullable|date|after_or_equal:open_date',
            
        ]);

        Deposit::create($validated);

        return redirect()->route('deposit.index')->with('success', 'deposit created successfully.');
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
        $validated = $request->validate([
            'deposit_number' => 'required|unique:deposit', 
            'member_id' => 'required|exists:users,id',
            "amount" => "nullable|string|max:10",
            'deposit_type_id' => 'required|exists:deposit_type,id',
            'open_date' => 'required|date',
            'close_date' => 'nullable|date|after_or_equal:open_date',
            'closed_date' => 'nullable|date|after_or_equal:open_date',
            
        ]);

        $deposit->update($validated);

        return redirect()->route('deposit.index')->with('success', 'Loan created successfully.');
    }

    public function updateStatus(Request $request, $id)
{
    $deposit = Deposit::findOrFail($id);
    $deposit ->status = $request->input('status');
    $deposit ->save();

    return redirect()->back()->with('success', 'deposit  status updated successfully.');
}
    public function destroy(Deposit $deposit)
    {
        $deposit->delete();
        return redirect()->route('deposit.index')->with('success', 'Loan Delete successfully.');
    }
}
