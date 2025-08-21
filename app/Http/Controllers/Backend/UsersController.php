<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Nominee;
use App\Models\User;
use App\Models\Location;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('role', 1)->latest()->get();
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

       
        $date = $request->input('join_date');
        $member_fee = $request->input('member_fee'); // Get the top-level date
        $validated = $request->validate([
            "member_number" => "required|string|max:10|unique:users",
            "name" => "required|string|max:255",
            "name_bn" => "nullable|string|max:255",
            "father_name" => "nullable|string",
            "mother_name" => "nullable|string",
            "husband_name" => "nullable|string",
            "wife_name" => "nullable|string",
            "dob" => "nullable|date",
            "nid" => "nullable|string",
            "occupation" => "nullable|string",
            "interest_rate" => "nullable|numeric|min:0",
            "member_fee" => "nullable|integer|min:1",
            "balance" => "nullable|integer|min:1",
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
            "join_date" => "required|nullable|date",
            "password" => "required|string|confirmed|min:3",
            "image" => "nullable|image",
            "signature" => "nullable|image",
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
        $member->fill($request->except(['password', 'image', 'signature']));
        $member->password = Hash::make($request->password);

        if ($request->hasFile("image")) {
            $member->image = uploadImage($request->file("image"));
        }

        if ($request->hasFile("signature")) {
            $member->signature = uploadImage($request->file("signature"));
        }
        transactions($date,'Member fee ' . $request->member_number, $member_fee,'in');

        $member->save();

        // Save Nominee if exists
        if ($member->save()) {
    if ($request->nominee_name) {
        $nominee = new Nominee();

        if ($request->hasFile("nominee_image")) {
            $nominee->image = uploadImage($request->file("nominee_image"));
        }

        $nominee->user_id = $member->id;
        $nominee->name = $request->nominee_name;
        $nominee->relation = $request->nominee_relation;
        $nominee->dob = $request->nominee_dob;
        $nominee->nid = $request->nominee_nid;
        $nominee->present_address = $request->nominee_present_address;
        $nominee->present_division = $request->nominee_present_division;
        $nominee->present_district = $request->nominee_present_district;
        $nominee->present_police_station = $request->nominee_present_police_station;
        $nominee->permanent_address = $request->nominee_permanent_address;
        $nominee->permanent_division = $request->nominee_permanent_division;
        $nominee->permanent_district = $request->nominee_permanent_district;
        $nominee->permanent_police_station = $request->nominee_permanent_police_station;
        $nominee->save();
    }
}

        return redirect()
            ->route("users.index")
            ->with("success", "Member created successfully.");
    }

    public function edit(User $user)
    {
        $divisions = Location::whereNull("division_id")
            ->whereNull("district_id")
            ->where("status", 1)
            ->get();

        return view("backend.users.edit", compact("user", "divisions"));
    }

    public function update(Request $request, User $user)
{
     $date = $request->input('join_date');
        $newAmount = $request->input('member_fee'); // Get the top-level date
        $oldAmount = floatval($user->member_fee);
        
    $request->validate([
        'member_number' => 'required|unique:users,member_number,' . $user->id,
        'name' => 'required|string|max:255',
        'mobile_number' => 'required',
        // other user validations...

        // Nominee validation
        'nominee_name' => 'required|string|max:255',
        // Add other nominee fields validation as needed
    ]);

    // Update user info
    $user->update($request->only([
         "member_number",
            "name",
            "name_bn",
            "father_name",
            "mother_name",
            "husband_name",
            "wife_name",
            "dob" ,
            "nid",
            "occupation",
            "interest_rate",
            "member_fee",
            "balance",
            "present_address",
            "present_division",
            "present_district",
            "present_police_station",
            "permanent_address",
            "permanent_division",
            "permanent_district",
            "permanent_police_station",
            "nationality",
            "mobile_number",
            "mobile_number_2",
            "mobile_number_3",
            "join_date",
            "image",
            "signature",
    ]));

    // Update or create nominee
    $nomineeData = [
        'name' => $request->input('nominee_name'),
        'relation' => $request->input('nominee_relation'),
        'dob' => $request->input('nominee_dob'),
         'nominee_nid' => $request->input('nominee_nid'),
        'present_address' => $request->input('nominee_present_address'),
        'present_division' => $request->input('nominee_present_division'),
        'present_district' => $request->input('nominee_present_district'),
        'present_police_station' => $request->input('nominee_present_police_station'),
        'permanent_address' => $request->input('nominee_permanent_address'),
        'permanent_division' => $request->input('nominee_permanent_division'),
        'permanent_district' => $request->input('nominee_permanent_district'),
        'permanent_police_station' => $request->input('nominee_permanent_police_station'),
         'nominee_image' => $request->input('nominee_image'),
        // include other nominee fields here
    ];



    if ($request->has('member_fee') && $oldAmount != $newAmount) {
        if ($oldAmount > 0) {
            transactions($date, 'Member fee (Update Reversal)'. $request->member_number, $oldAmount, 'out');
        }
        if ($newAmount > 0) {
            transactions($date, 'Member fee (Updated)'. $request->member_number, $newAmount, 'in');
        }
    }

    // Check if nominee exists, update it, or create new
    if ($user->latestNominee) {
        $user->latestNominee->update($nomineeData);
    } else {
        $user->nominees()->create($nomineeData);
    }

    // Handle file uploads (images, signature) here as needed

    return redirect()->route('users.index')->with('success', 'User updated successfully!');
}


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

public function cashwithdraw(Request $request)
{
    $validated = $request->validate([
        'balance' => 'required|numeric|min:0.01',
        'date' => 'required|date',
        'user_id' => 'required|exists:users,id',
    ]);

    $user = User::findOrFail($validated['user_id']);
    $date = $validated['date'];
    $balanceWithdraw = $validated['balance'];

    // ✅ Check if user has sufficient balance
    if ($user->balance < $balanceWithdraw) {
        return redirect()->back()->with('error', 'Insufficient balance. Available: ' . $user->balance);
    }

    // ✅ Record transaction
    transactions($date, 'Balance Withdraw by user: ' . $user->name, $balanceWithdraw, 'out');
    

    // ✅ Deduct balance
    $user->balance -= $balanceWithdraw;
    $user->save();

    return redirect()->back()->with('success', 'Cash withdrawn successfully.');
}
public function interestStore(Request $request)
{
   
    $validated = $request->validate([
        'balance' => 'required|numeric|min:0.01',
        'date' => 'required|date',
        'user_id' => 'required|exists:users,id',
    ]);

    $user = User::findOrFail($validated['user_id']);
    $date = $validated['date'];
    $balanceadd = $validated['balance'];

    

    // ✅ Record transaction
    transactions($date, 'Interest Balance added by user: ' . $user->name, $balanceadd, 'in');

    // ✅ Add balance
    $user->balance += $balanceadd;
    $user->save();

    return redirect()->back()->with('success', 'Interest added successfully.');
}



    public function destroy(User $user)
    {
        $user->delete();
        return redirect()
            ->route("users.index")
            ->with("success", "User deleted successfully.");
    }
}