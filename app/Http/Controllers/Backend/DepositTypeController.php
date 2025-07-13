<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\DepositType;
use App\Models\DpsType;
use Illuminate\Http\Request;

class DepositTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depositTypes = DepositType::latest()->get();
       return view("backend.deposit_types.deposit_type_index", compact('depositTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('backend.deposit_types.deposit_type_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Valided = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        
            'status' => 'nullable|in:0,1',

        ]);
        DepositType::create($Valided);
        return redirect()->route('deposit-types.index')->with('success', 'deposit type created successfully.');

       
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
    $depositType = DepositType::findOrFail($id);
    $depositType->status = $depositType->status == 1 ? 0 : 1;
    $depositType->save();

    return redirect()->route('deposit-types.index')->with('success', 'Deposit type status updated successfully.');
}
    public function edit(string $id)

    {
        $depositType = DepositType::findOrFail($id);
      return view('backend.deposit_types.deposit_type_edit' , compact( 'depositType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,DepositType $depositType )
    {
        $Valided = $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            
            'status' => 'nullable|in:0,1',

        ]);
        $depositType->update($Valided);
        return redirect()->route('deposit-types.index')->with('success', 'deposit type created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepositType $depositType)

    {
       $depositType->delete();
       return redirect()->route('deposit-types.index')->with('success', 'deposit type Delete successfully.');
    }
}
