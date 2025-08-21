<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    
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
    $totalAmount = $transactions->where('type', 'in')->sum('amount') -
                   $transactions->where('type', 'out')->sum('amount');

    // Sum amounts grouped by 'details'
   $groupedByDetails = $transactions->groupBy('details')->map(function ($group) {
    return [
        'in' => $group->where('type', 'in')->sum('amount'),
        'out' => $group->where('type', 'out')->sum('amount'),
        'net' => $group->where('type', 'in')->sum('amount') - $group->where('type', 'out')->sum('amount'),
    ];
});

    return view('backend.transaction.transation_index', compact('transactions', 'totalAmount', 'groupedByDetails'));
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
          // Get all transactions
    $transactions = Transaction::all();

    // Calculate sums
    $totalIn = Transaction::where('type', 'in')->sum('amount');
    $totalOut = Transaction::where('type', 'out')->sum('amount');

    return view('backend.transaction.transaction_show', compact('transactions', 'totalIn', 'totalOut'));
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
