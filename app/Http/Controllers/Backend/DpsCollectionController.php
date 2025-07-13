<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DPS;
use App\Models\DpsCollection;

use App\Models\User;
use Illuminate\Http\Request;

class DpsCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $dpsCollections = DpsCollection::with('user','dps')->latest()->paginate(10);
    
        return view('backend.dps_collection.dps_collection_index', compact('dpsCollections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $users=User::all();
        $dpss=DPS::all();
        return view('backend.dps_collection.dps_collection_create',compact('users','dpss'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Valided = $request-> validate([
             'user_id' => 'required|exists:users,id',
            'dps_id' => 'nullable|exists:dps,id',
            'date' => 'nullable|date',
            'amount' => 'nullable|numeric|min:0',

        ]);
        DpsCollection::create($Valided);
        return redirect()->route('dps_collections.index')->with('success', 'dps collection added successfully.');
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
    public function edit(DpsCollection $dpsCollection)
    {
       $users = User::all();
       $dpss = DPS::all();
       return view('backend.dps_collection.dps_collection_edit', compact('users','dpss','dpsCollection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DpsCollection $dpsCollection)
    {
        $Valided = $request-> validate([
             'user_id' => 'required|exists:users,id',
            'dps_id' => 'nullable|exists:dps,id',
            'date' => 'nullable|date',
            'amount' => 'nullable|numeric|min:0',

        ]);
        $dpsCollection -> update($Valided);
        return redirect()->route('dps_collections.index')->with('success', 'dps collection added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DpsCollection $dpsCollection)
    {
        $dpsCollection->delete();
         return redirect()->route('dps_collections.index')->with('success', 'dps collection Delete successfully.');
    }
}
