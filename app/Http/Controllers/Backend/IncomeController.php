<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $from = $request->input('from');
    $to = $request->input('to');

    // Filter transactions by date if provided
    $transactions = Transaction::when($from && $to, function ($q) use ($from, $to) {
        return $q->whereDate('date', '>=', $from)
                 ->whereDate('date', '<=', $to);
    })->get();

    // Calculate total amount (in - out)
   

    // Sum amounts grouped by 'details'
    $groupedByDetails = $transactions
        ->whereIn('details', ['Interest Balance', 'Stamp Charge','loan Fee','Service Charge'])
        ->groupBy('details')
        ->map(function ($group) {
            return [
                'in' => $group->where('type', 'in')->sum('amount'),

                
            ];
        });

         $totalAmount = $groupedByDetails->sum('in');



          $groupedByDetailsExpense = $transactions
        ->whereIn('details', ['Deposit Interest Balance','DPS Interest Balance',])
        ->groupBy('details')
        ->map(function ($group) {
            return [
                'out' => $group->where('type', 'out')->sum('amount'),

                
            ];
        });

         $totalAmountExpense = $groupedByDetailsExpense->sum('out');

         $totalSummary = $totalAmount - $totalAmountExpense;

    return view('backend.income.income_index', compact('transactions', 'totalAmount', 'groupedByDetails', 'totalAmountExpense', 'groupedByDetailsExpense', 'totalSummary'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
