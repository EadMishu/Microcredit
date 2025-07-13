<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DpsType;
use Illuminate\Http\Request;

class DpsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $dpsTypes = DpsType::latest()->get();
    return view('backend.dps_types.dps_type_index', compact('dpsTypes'));
}

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
         return view('backend.dps_types.dps_type_create', );
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

    dpsType::create($validated);

    return redirect()->route('dps-types.index')->with('success', 'dps type created successfully.');
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
    $dpsType = dpsType::findOrFail($id);
    $dpsType->status = $dpsType->status == 1 ? 0 : 1;
    $dpsType->save();

    return redirect()->route('dps-types.index')->with('success', 'dps type status updated successfully.');
}

    /**
     * Show the form for editing the specified resource.
     */
       public function edit($id)
{
    $dpsType = dpsType::findOrFail($id);
    return view('backend.dps_types.dps_type_edit', compact('dpsType'));
}

    /**
     * Update the specified resource in storage.
     */
      public function update(Request $request, dpsType $dpsType)
    {
          $validated = $request->validate([
        'name' => 'required|string|max:255',
        'percentage' => 'required|numeric|min:0',
        'duration' => 'required|integer|min:1',
        'number_of_installments' => 'required|integer|min:1',
        'status' => 'required|in:0,1',
    ]);

   $dpsType->update($validated);

    return redirect()->route('dps-types.index')->with('success', 'dps type Update successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(dpsType $dpsType)
    {
        $dpsType ->delete();

        return redirect()->route('dps-types.index')->with('success', 'dps deleted successfully.');
    }
}
