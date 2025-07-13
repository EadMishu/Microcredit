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
            'dps_type_id' => 'required|exists:dps_type,id',
            'open_date' => 'required|date',
            'close_date' => 'nullable|date|after_or_equal:open_date',
            'closed_date' => 'nullable|date|after_or_equal:open_date',
            
        ]);

        DPS::create($validated);

        return redirect()->route('dps.index')->with('success', 'Loan created successfully.');
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
    public function update(Request $request, DPS $dps )
    {
       $validated = $request->validate([
            'dps_number' => 'required|unique:dps', 
            'user_id' => 'required|exists:users,id',
            "amount" => "nullable|string|max:10",
            'dps_type_id' => 'required|exists:dps_type,id',
            'open_date' => 'required|date',
            'close_date' => 'nullable|date|after_or_equal:open_date',
            'closed_date' => 'nullable|date|after_or_equal:open_date',
            
        ]);

        $dps->update($validated);

        return redirect()->route('dps.index')->with('success', 'Loan created successfully.');
    }


public function updateStatus(Request $request, $id)
{
    $dps = Dps::findOrFail($id);
    $dps->status = $request->input('status');
    $dps->save();

    return redirect()->back()->with('success', 'DPS status updated successfully.');
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
