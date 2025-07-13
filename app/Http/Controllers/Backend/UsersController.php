<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Nominee;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('role',1)
            ->latest()
            ->get();
        return view("backend.users.index", compact("users"));
    }

    public function create()
    {
        $divisions = Location::whereNull("division_id")
            ->whereNull("district_id")
            ->where("status", 1)
            ->get();

        return view("backend.users.create", compact("divisions"));
    }

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
            "member_number" => "required|string|max:10",
            "name" => "required|string|max:255",
            "name_bn" => "nullable|string|max:255",
            "father_name" => "nullable|string",
            "mother_name" => "nullable|string",
            "husband_name" => "nullable|string",
            "wife_name" => "nullable|string",
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

            "nominee_name" => "nullable|string",
            "nominee_relation" => "nullable|string",
            "nominee_dob" => "nullable|date",
            "nominee_nid" => "nullable|string",
            "nominee_present_address" => "nullable|string",
            "nominee_present_division" => "nullable|integer",
            "nominee_present_district" => "nullable|integer",
            "nominee_present_police_station" => "nullable|integer",
            "nominee_permanent_address" => "nullable|string",
            "nominee_permanent_division" => "nullable|integer",
            "nominee_permanent_district" => "nullable|integer",
            "nominee_permanent_police_station" => "nullable|integer",
            "nominee_image" => "nullable|image|max:2048",
        ]);
       
        $member = new User();
        if ($request->hasFile("image")) {
            $member->image = uploadImage($request->file("image"));
        }
        if ($request->hasFile("signature")) {
            $member->signature = uploadImage($request->file("signature"));
        }
        $member->name = $request->name;
        $member->name_bn = $request->name_bn;
        $member->father_name = $request->father_name;
        $member->mother_name = $request->mother_name;
        $member->husband_name = $request->husband_name;
        $member->wife_name = $request->wife_name;
        $member->dob = $request->dob;
        $member->nid = $request->nid;
        $member->occupation = $request->occupation;
        $member->present_address = $request->present_address;
        $member->present_division = $request->present_division;
        $member->present_district = $request->present_district;
        $member->present_police_station = $request->present_police_station;
        $member->permanent_address = $request->permanent_address;
        $member->permanent_division = $request->permanent_division;
        $member->permanent_district = $request->permanent_district;
        $member->permanent_police_station = $request->permanent_police_station;
        $member->nationality = $request->nationality;
        $member->mobile_number = $request->mobile_number;
        $member->mobile_number_2 = $request->mobile_number_2;

        $member->mobile_number_3 = $request->mobile_number_3;
        $member->password = Hash::make($request->password);
        if ($member->save()) {
            if ($request->nominee_name) {
                $nominee = new Nominee();

                if ($request->hasFile("nominee_image")) {
                    $nominee->image = uploadImage(
                        $request->file("nominee_image")
                    );
                }
            }

            $nominee->user_id = $member->id;
            $nominee->name = $request->nominee_name;
            $nominee->relation = $request->nominee_relation;
            $nominee->dob = $request->nominee_dob;
            $nominee->nid = $request->nominee_nid;
            $nominee->present_address = $request->nominee_present_address;
            $nominee->present_division = $request->nominee_present_division;
            $nominee->present_district = $request->nominee_present_district;
            $nominee->present_police_station =$request->nominee_present_police_station;
            $nominee->permanent_address = $request->nominee_permanent_address;
            $nominee->permanent_division = $request->nominee_permanent_division;
            $nominee->permanent_district = $request->nominee_permanent_district;
            $nominee->permanent_police_station =$request->nominee_permanent_police_station;
            $nominee->save();
        }

        return redirect()
            ->route("users.index")
            ->with("success", "Member created successfully.");
    }

    public function edit(\App\Models\User $user)
    {
        $divisions = \App\Models\Location::whereNull("division_id")
            ->whereNull("district_id")
            ->where("status", 1)
            ->get();
        return view("backend.users.edit", compact("user", "divisions"));
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            "member_number" => "required|string|max:10",
            "name" => "required|string|max:255",
            "name_bn" => "nullable|string|max:255",
            "father_name" => "nullable|string",
            "mother_name" => "nullable|string",
            "husband_name" => "nullable|string",
            "wife_name" => "nullable|string",
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
            "mobile_number" =>
                "required|unique:users,mobile_number," . $user->id,
            "mobile_number_2" => "nullable|string",
            "mobile_number_3" => "nullable|string",
            "join_date" => "nullable|date",
            "password" => "nullable|string|confirmed|min:3",
            "image" => "nullable|image|max:2048",
            "signature" => "nullable|image|max:2048",
        ]);

        // Update existing user
        if ($request->hasFile("image")) {
            $user->image = uploadImage($request->file("image"));
        }

        if ($request->hasFile("signature")) {
            $user->signature = uploadImage($request->file("signature"));
        }

        $user->fill(
            $request->except([
                "password",
                "password_confirmation",
                "image",
                "signature",
            ])
        );

        if ($request->filled("password")) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update or create nominee if needed
        if ($request->nominee_name) {
            $nominee = $user->nominees()->firstOrNew([]);

            if ($request->hasFile("nominee_image")) {
                $nominee->image = uploadImage($request->file("nominee_image"));
            }

            $nominee->name = $request->nominee_name;
            $nominee->relation = $request->nominee_relation;
            $nominee->dob = $request->nominee_dob;
            $nominee->nid = $request->nominee_nid;
            $nominee->present_address = $request->nominee_present_address;
            $nominee->present_division = $request->nominee_present_division;
            $nominee->present_district = $request->nominee_present_district;
            $nominee->present_police_station =
                $request->nominee_present_police_station;
            $nominee->permanent_address = $request->nominee_permanent_address;
            $nominee->permanent_division = $request->nominee_permanent_division;
            $nominee->permanent_district = $request->nominee_permanent_district;
            $nominee->permanent_police_station =
                $request->nominee_permanent_police_station;

            $nominee->user_id = $user->id;
            $nominee->save();
        }

        return redirect()
            ->route("users.index")
            ->with("success", "User updated successfully.");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route("users.index")
            ->with("success", "User deleted successfully.");
    }
}
