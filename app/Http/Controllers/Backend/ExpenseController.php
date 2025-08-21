<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::all();
            return view('backend.expense.expense_index', compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expenseTypes = ExpenseType::all();
        return view('backend.expense.expense_create', compact('expenseTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_type_id' => 'required|exists:expense_types,id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date'    => 'required|date',
        ]);
        $date = $request->input('date'); 

        transactions($date, 'Expense Amount', floatval($request->amount), 'out');

        Expense::create($request->all());

        return redirect()->route('expense.index')->with('success', 'Expense created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)

    {
        $expenseTypes = ExpenseType::all();
        return view('backend.expense.expense_edit', compact('expense', 'expenseTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
{
    $request->validate([
        'expense_type_id' => 'required|exists:expense_types,id',
        'description'     => 'required|string|max:255',
        'amount'          => 'required|numeric|min:0',
        'date'            => 'required|date',
    ]);

    $newAmount = $request->input('amount');
    $date = $request->input('date');

    $oldAmount = Expense::whereDate('date', $date)->sum('amount');

    if ($oldAmount != $newAmount) {
        if ($oldAmount > 0) {
            transactions($date, 'expense Amount (Update Reversal)', $oldAmount, 'in');
        }
        if ($newAmount > 0) {
            transactions($date, 'expense Amount (Updated)', $newAmount, 'out');
        }
    }

    $expense->update($request->only(['expense_type_id', 'description', 'amount', 'date']));

    return redirect()->route('expense.index')->with('success', 'Expense updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->route('expense.index')->with('success', 'Expense deleted successfully.');
    }
}
