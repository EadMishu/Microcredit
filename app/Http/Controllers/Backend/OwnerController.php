<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Addbalance;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::whereIn('role',[4])->latest()->paginate(10);
        return view('backend.owner.owner_index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
     public function create()
    {
        $divisions = Location::whereNull("division_id")
            ->whereNull("district_id")
            ->where("status", 1)
            ->get();

        return view("backend.owner.owner_create", compact("divisions"));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function getDistricts($divisionId)
    {
        $districts = Location::where("division_id", $divisionId)
            ->whereNull("district_id")
            ->where("status", 1)
            ->get(["id", "name"]);
        return response()->json($districts);
    }

    public function getPoliceStations($districtId)
    {
        $stations = Location::where("district_id", $districtId)
            ->where("status", 1)
            ->get(["id", "name"]);
        return response()->json($stations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Step 1: Validate input first
        $validated = $request->validate([
            "date" => "nullable|date",
        
            "name" => "required|string|max:255",
            "name_bn" => "nullable|string|max:255",
            "father_name" => "nullable|string",
            "mother_name" => "nullable|string",
            "dob" => "nullable|date",
            "nid" => "nullable|string",
            "occupation" => "nullable|string",
            "present_address" => "nullable|string",
            "present_division" => "nullable|integer",
            "present_district" => "nullable|integer",
            "present_police_station" => "nullable|integer",
            "permanent_address" => "nullable|string",
            "permanent_division" => "nullable|integer",
            "permanent_district" => "nullable|integer",
            "permanent_police_station" => "nullable|integer",
            "nationality" => "nullable|string",
            "mobile_number" => "required|unique:users,mobile_number",
            "mobile_number_2" => "nullable|string",
            "mobile_number_3" => "nullable|string",
            "join_date" => "required|date",
            "password" => "required|string|confirmed|min:3",
            "image" => "nullable|image|max:2048",
            "signature" => "nullable|image|max:2048",
            "role" => "required|in:4",
        ]);

        // Step 2: Pre-process file uploads first (in memory, not DB)
        $imagePath = null;
        $signaturePath = null;

        if ($request->hasFile("image")) {
            $imagePath = uploadImage($request->file("image"));
            if (!$imagePath) {
                return back()->withErrors(['image' => 'Image upload failed.'])->withInput();
            }
        }

        if ($request->hasFile("signature")) {
            $signaturePath = uploadImage($request->file("signature"));
            if (!$signaturePath) {
                return back()->withErrors(['signature' => 'Signature upload failed.'])->withInput();
            }
        }

        // Step 3: All good? Now create the user safely
        $user = new User($validated);
        $user->role = 4;
        $user->password = bcrypt($request->input('password'));
        if ($imagePath) $user->image = $imagePath;
        if ($signaturePath) $user->signature = $signaturePath;
        $user->save(); // only happens now after everything is ready

        return redirect()
            ->route("owner.index")
            ->with("success", "owner created successfully.");
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
        $user = User::findOrFail($id);
        $divisions = Location::whereNull("division_id")
            ->whereNull("district_id")
            ->where("status", 1)
            ->get();
        return view("backend.owner.owner_edit", compact("user", "divisions"));
        
    }

    /**
     * Update the specified resource in storage.
     */
     public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:1,2,3',
        ]);

        $users = User::findOrFail($id);
        $users->status = $request->status;
        $users->save();
    return back()->with('success', 'Users status updated successfully.');
    }

   public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            "date" => "nullable|date",
            "name" => "required|string|max:255",
            "name_bn" => "nullable|string|max:255",
            "father_name" => "nullable|string",
            "mother_name" => "nullable|string",
            "dob" => "nullable|date",
            "nid" => "nullable|string",
            "occupation" => "nullable|string",
            "present_address" => "nullable|string",
            "present_division" => "nullable|integer",
            "present_district" => "nullable|integer",
            "present_police_station" => "nullable|integer",
            "permanent_address" => "nullable|string",
            "permanent_division" => "nullable|integer",
            "permanent_district" => "nullable|integer",
            "permanent_police_station" => "nullable|integer",
            "nationality" => "nullable|string",
            "mobile_number" => "required|unique:users,mobile_number," . $user->id,
            "mobile_number_2" => "nullable|string",
            "mobile_number_3" => "nullable|string",
            "join_date" => "nullable|date",
            "password" => "nullable|string|confirmed|min:3",
            "image" => "nullable|image|max:2048",
            "signature" => "nullable|image|max:2048",
            "role" => "required|in:4",
        ]);

        $user->fill($validated);

        if ($request->hasFile('image')) {
            $user->image = uploadImage($request->file('image'));
        }

        if ($request->hasFile('signature')) {
            $user->signature = uploadImage($request->file('signature'));
        }

        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('owner.index')->with('success', 'owner updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function addBalance(Request $request)
    {
        // Validate form data
        $validated = $request->validate([
            "date" => "nullable|date",
            'user_id' => 'required|exists:users,id',
            'balance' => 'required|numeric|min:0',
        ]);

        // Fetch the user
        $user = User::findOrFail($validated['user_id']);

        // Add the new balance to the current balance
        $user->increment('balance', $validated['balance']);

        if ($request->filled('balance')) {
            transactions($request->date, 'Owner Balance', floatval($request->balance), 'in');
        }

        // Save updated user
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Balance added successfully.');
    }
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()
            ->route("owner.index")
            ->with("success", "owner deleted successfully.");
        
    }
}
