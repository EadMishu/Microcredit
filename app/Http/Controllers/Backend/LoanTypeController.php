<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\LoanType;
use Illuminate\Http\Request;

class LoanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $loanTypes = LoanType::latest()->get();
    return view('backend.loan_types.type_index', compact('loanTypes'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('backend.loan_types.type_create', );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'percentage' => 'required|numeric|min:0',
        'duration' => 'required|integer|min:1',
        'number_of_installments' => 'required|integer|min:1',
        'status' => 'required|in:0,1',
    ]);

    LoanType::create($validated);

    return redirect()->route('loan-types.index')->with('success', 'Loan type created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function toggleStatus($id)
{
    $loanType = LoanType::findOrFail($id);
    $loanType->status = $loanType->status == 1 ? 0 : 1;
    $loanType->save();

    return redirect()->route('loan-types.index')->with('success', 'Loan type status updated successfully.');
}

    /**
     * Show the form for editing the specified resource.
     */
    
     public function edit($id)
{
    $loanType = LoanType::findOrFail($id);
    return view('backend.loan_types.type_edit', compact('loanType'));
}
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoanType $loanType)
    {
          $validated = $request->validate([
        'name' => 'required|string|max:255',
        'percentage' => 'required|numeric|min:0',
        'duration' => 'required|integer|min:1',
        'number_of_installments' => 'required|integer|min:1',
        'status' => 'required|in:0,1',
    ]);

   $loanType->update($validated);

    return redirect()->route('loan-types.index')->with('success', 'Loan type Update successfully.');
}
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoanType $loanType)
    {
        $loanType ->delete();

        return redirect()->route('loan-types.index')->with('success', 'Loan deleted successfully.');
    }
}
