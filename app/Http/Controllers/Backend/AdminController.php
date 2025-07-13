<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    
    {

         $users = User::whereIn('role',[2,3])->latest()
            ->get();
      return view('backend.admin.admin_index', compact("users") );
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

        return view("backend.admin.admin_create", compact("divisions"));
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
    public function store(Request $request)


    {


       
        // Validation
        $validated = $request->validate([
            "role" => "required|in:2,3",
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
            "mobile_number" => "required|unique:users",
            "mobile_number_2" => "nullable|string",
            "mobile_number_3" => "nullable|string",
            "join_date" => "nullable|date",
            "password" => "required|string|confirmed|min:3",
            "image" => "nullable|image|max:2048",
            "signature" => "nullable|image|max:2048",

            
        ]);
       
        $admin = new User();
        if ($request->hasFile("image")) {
            $admin->image = uploadImage($request->file("image"));
        }
        if ($request->hasFile("signature")) {
            $admin->signature = uploadImage($request->file("signature"));
            }
       
        $admin->role = $request->role;
        $admin->name = $request->name;
        $admin->name_bn = $request->name_bn;
        $admin->father_name = $request->father_name;
        $admin->mother_name = $request->mother_name;
        
        $admin->dob = $request->dob;
        $admin->nid = $request->nid;
        $admin->occupation = $request->occupation;
        $admin->present_address = $request->present_address;
        $admin->present_division = $request->present_division;
        $admin->present_district = $request->present_district;
        $admin->present_police_station = $request->present_police_station;
        $admin->permanent_address = $request->permanent_address;
        $admin->permanent_division = $request->permanent_division;
        $admin->permanent_district = $request->permanent_district;
        $admin->permanent_police_station = $request->permanent_police_station;
        $admin->nationality = $request->nationality;
        $admin->mobile_number = $request->mobile_number;
        $admin->mobile_number_2 = $request->mobile_number_2;

        $admin->mobile_number_3 = $request->mobile_number_3;
        $admin->password = Hash::make($request->password);
        $admin->save();
           


        return redirect()
            ->route("admin.index")
            ->with("success", "Member created successfully.");
        
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
    public function edit($id)

    {
         $admin = User::findOrFail($id);
        $divisions = \App\Models\Location::whereNull("division_id")
            ->whereNull("district_id")
            ->where("status", 1)
            ->get();
        return view("backend.admin.admin_edit", compact("admin", "divisions"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $admin)
{
    $validated = $request->validate([
        "role" => "required|string",
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
        "mobile_number" => "required|unique:users,mobile_number," . $admin->id,
        "mobile_number_2" => "nullable|string",
        "mobile_number_3" => "nullable|string",
        "join_date" => "nullable|date",
        "password" => "nullable|string|confirmed|min:3",
        "image" => "nullable|image|max:2048",
        "signature" => "nullable|image|max:2048",
    ]);
        // Update existing user
       
         if ($request->hasFile("image")) {
        $admin->image = uploadImage($request->file("image"));
    }

       if ($request->hasFile("signature")) {
        $admin->signature = uploadImage($request->file("signature"));
    }
$admin->role = $request->role;
    $admin->name = $request->name;
    $admin->name_bn = $request->name_bn;
    $admin->father_name = $request->father_name;
    $admin->mother_name = $request->mother_name;
    $admin->dob = $request->dob;
    $admin->nid = $request->nid;
    $admin->occupation = $request->occupation;
    $admin->present_address = $request->present_address;
    $admin->present_division = $request->present_division;
    $admin->present_district = $request->present_district;
    $admin->present_police_station = $request->present_police_station;
    $admin->permanent_address = $request->permanent_address;
    $admin->permanent_division = $request->permanent_division;
    $admin->permanent_district = $request->permanent_district;
    $admin->permanent_police_station = $request->permanent_police_station;
    $admin->nationality = $request->nationality;
    $admin->mobile_number = $request->mobile_number;
    $admin->mobile_number_2 = $request->mobile_number_2;
    $admin->mobile_number_3 = $request->mobile_number_3;
    $admin->join_date = $request->join_date;

    if ($request->filled('password')) {
        $admin->password = Hash::make($request->password);
    }

    $admin->save();

    return redirect()->route('admin.index')->with('success', 'Admin updated successfully!');
}

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return redirect()
            ->route("admin.index")
            ->with("success", "User deleted successfully.");
    }
}
