<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanType;
use App\Models\TimeExtension;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'loanType'])->latest()->get();
        return view('backend.loans.loans_index', compact('loans'));
    }

    public function create()
{
    $users = User::where('role', '=', 1)->get(); // exclude admin if needed
    $loanTypes = LoanType::all();

    return view('backend.loans.loans_create', compact('users', 'loanTypes'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'loan_number' => 'required|unique:loans',
            'user_id' => 'required|exists:users,id',
            "amount" => "nullable|string|max:10",
            'loan_type_id' => 'required|exists:loan_type,id',
            'open_date' => 'required|date',
            'close_date' => 'nullable|date|after_or_equal:open_date',
            'closed_date' => 'nullable|date|after_or_equal:open_date',
           
        ]);

        Loan::create($validated);

        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    public function show(Loan $loan)
    {
        return view('loans.show', compact('loan'));
    }

   public function edit(Loan $loan)
{
    $users = User::where('role', '=', 1)->get();
   
    $loanTypes = LoanType::all();

    return view('backend.loans.loans_edit', compact('loan', 'users', 'loanTypes'));
}

    public function update(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'loan_number' => 'required|unique:loans,loan_number,' . $loan->id,
            'user_id' => 'required|exists:users,id',
            "amount" => "nullable|string|max:10",
            'loan_type_id' => 'required|exists:loan_type,id',
            'open_date' => 'required|date',
            'close_date' => 'nullable|date|after_or_equal:open_date',
            'closed_date' => 'nullable|date|after_or_equal:open_date',
            
        ]);

        $loan->update($validated);

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }
    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:1,2,3',
    ]);

    $loan = Loan::findOrFail($id);
    $loan->status = $request->status;
    $loan->save();

    return back()->with('success', 'Loan status updated successfully.');
}



public function extensionstore(Request $request)
    {


        // Validate form data
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',  // Make sure you pass loan_id from form or controller
            'amount' => 'nullable|string',
            'close_date' => 'nullable|date',
        ]);

        // Create TimeExtension
       TimeExtension::updateOrCreate(
        ['loan_id' => $validated['loan_id']], // Match condition
        [                                     // Fields to update or create
            'amount' => $validated['amount'],
            'close_date' => $validated['close_date'],
        ] );

        // Redirect back with success message
        return redirect()->back()->with('success', 'Time extension saved successfully.');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }
}
