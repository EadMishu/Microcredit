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

            "loan_fee" => "nullable|string|max:10",
            "service_charge" => "nullable|string|max:10",
            "stamp_charge" => "nullable|string|max:10",
            "premium" => "nullable|string|max:10",
            'loan_type_id' => 'required|exists:loan_type,id',
            'open_date' => 'required|date',
            
            'closed_date' => 'nullable|date|after_or_equal:open_date',

        ]);
        $loanType = LoanType::findOrFail($validated['loan_type_id']);

        // Calculate interest and total balance
        $interestBalance = ($validated['amount'] * $loanType->percentage) / 100;
        $totalBalance = $validated['amount'] + $interestBalance;

        $validated['interest_balance'] = $interestBalance;
        $validated['total_balance'] = $totalBalance;


         // Automatically calculate closed_date based on duration (in months)
    $openDate = \Carbon\Carbon::parse($validated['open_date']);
    $validated['close_date'] = $openDate->copy()->addMonths($loanType->duration);

    // Optionally clear closed_date (if not manually set by system)
    $validated['closed_date'] = null;




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
            "loan_fee" => "nullable|string|max:10",
            "service_charge" => "nullable|string|max:10",
            "stamp_charge" => "nullable|string|max:10",
            "premium" => "nullable|string|max:10",
            'loan_type_id' => 'required|exists:loan_type,id',
            'open_date' => 'required|date',
            'close_date' => 'nullable|date|after_or_equal:open_date',
            'closed_date' => 'nullable|date|after_or_equal:open_date',

        ]);

        $loanType = LoanType::findOrFail($validated['loan_type_id']);

        // Calculate interest and total balance
        $interestBalance = ($validated['amount'] * $loanType->percentage) / 100;
        $totalBalance = $validated['amount'] + $interestBalance;

        $validated['interest_balance'] = $interestBalance;
        $validated['total_balance'] = $totalBalance;


        $date = $request->open_date;

        // Handle amount change
        $oldAmount = floatval($loan->amount);
        $newAmount = floatval($request->amount);


        $oldloan = floatval($loan->loan_fee);
        $newloan = floatval($request->loan_fee);
        $oldservice_charge = floatval($loan->service_charge);
        $newservice_charge = floatval($request->service_charge);
        $oldstamp_charge = floatval($loan->loan_tamp_charge);
        $newstamp_charge = floatval($request->loan_tamp_charge);

        if ($request->has('amount') && $oldAmount != $newAmount) {
            if ($oldAmount > 0) {
                transactions($date, 'loan Amount (Update Reversal)', $oldAmount, 'in');
            }
            if ($newAmount > 0) {
                transactions($date, 'loan Amount (Updated)', $newAmount, 'out');
            }
        }

        if ($request->has('loan_fee') && $oldloan != $newloan) {
            if ($oldloan > 0) {
                transactions($date, 'loan fee (Update Reversal)', $oldloan, 'out');
            }
            if ($newloan > 0) {
                transactions($date, 'loan fee (Updated)', $newloan, 'in');
            }
        }
        if ($request->has('service_charge') && $oldservice_charge != $newservice_charge) {
            if ($oldservice_charge > 0) {
                transactions($date, 'loan_service_charge (Update Reversal)', $oldservice_charge, 'out');
            }
            if ($newservice_charge > 0) {
                transactions($date, 'loan_service_charge (Updated)', $newservice_charge, 'in');
            }
        }
        if ($request->has('stamp_charge') && $oldstamp_charge != $newstamp_charge) {
            if ($oldstamp_charge > 0) {
                transactions($date, 'loan_stamp_charge (Update Reversal)', $oldstamp_charge, 'out');
            }
            if ($newstamp_charge > 0) {
                transactions($date, 'loan_stamp_charge (Updated)', $newstamp_charge, 'in');
            }
        }


        $loan->update($validated);

        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }
    public function updateStatus(Request $request, $id)
    {
        $loan = Loan::findOrFail($id);
        $oldStatus = $loan->status;
        $newStatus = $request->input('status');
        $loan->status = $request->input('status');
        $loan->save();

        if ($oldStatus != 2 && $newStatus == 2) {
            $date = $loan->open_date; // Assuming open_date is set on loan

            if ($loan->amount) {
                transactions($date, 'loan Amount', floatval($loan->amount), 'out');
            }
            if ($loan->loan_fee) {
                transactions($date, 'loan Fee', floatval($loan->loan_fee), 'in');
            }
            if ($loan->service_charge) {
                transactions($date, 'Service Charge', floatval($loan->service_charge), 'in');
            }
            if ($loan->stamp_charge) {
                transactions($date, 'Stamp Charge', floatval($loan->stamp_charge), 'in');
            }
        }


        return back()->with('success', 'Loan status updated successfully.');
    }



    public function extensionstore(Request $request)
    {
        
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',  // Make sure you pass loan_id from form or controller
            'amount' => 'required|string',
            'close_date' => 'required|date',
        ]);

         $loan = Loan::findOrFail($validated['loan_id']);

    // If an amount is provided, update the loan's total_balance
     if (!empty($validated['amount'])) {
        $loan->total_balance += $validated['amount'];
    }

    if (!empty($validated['close_date'])) {
        $loan->close_date = $validated['close_date'];
    }

    $loan->save();


        // Create TimeExtension
        TimeExtension::updateOrCreate(
            ['loan_id' => $validated['loan_id']], // Match condition
            [                                     // Fields to update or create
                'amount' => $validated['amount'],
                'close_date' => $validated['close_date'],
            ]
        );

        // Redirect back with success message
        return redirect()->back()->with('success', 'Time extension saved successfully.');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();

        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }
}
