<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DepositCollection;
use App\Models\User;
use Illuminate\Http\Request;

class DepositCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $depositCollections = DepositCollection::with('user')->latest()->paginate(10);
        return view('backend.deposit_collection.deposit_collection_index', compact('depositCollections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()

    {
        $users = User::all();
        return view('backend.deposit_collection.deposit_collection_create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valided = $request -> validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'nullable|date',
            'amount' => 'nullable|numeric|min:0',

        ]);
        DepositCollection::create($valided);
        return redirect()->route('deposit_collections.index')->with('success', 'deposit collection added successfully.');
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
          $depositCollection = DepositCollection::findOrFail($id);
        $users = User::all();
        return view('backend.deposit_collection.deposit_collection_edit', compact('users','depositCollection' ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DepositCollection $depositCollections)
    {
       $valided = $request -> validate([
            'user_id' => 'required|exists:users,id',
            'date' => 'nullable|date',
            'amount' => 'nullable|numeric|min:0',

        ]);
        $depositCollections->update( $valided) ;
        return redirect()->route('deposit_collections.index')->with('success', 'dps collection added successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
   

     public function destroy(DepositCollection $DepositCollection)
    {
        $DepositCollection->delete();
         return redirect()->route('deposit_collections.index')->with('success', 'dps collection Delete successfully.');
    }
}
