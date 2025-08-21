@extends('backend.admin_master')

@section('content')
<main class="main-content px-3">
    <h3 class="pt-3 text-muted">Edit User</h3>
    <nav aria-label="breadcrumb px-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User List</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Member</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Nominee</button>
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Note</button>
    </div>
    </nav>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

        {{-- Member Info --}}
        <div class="card mb-3">
            <div class="card-header"><h5>Member Information</h5></div>
            <div class="card-body">
                <div class="row gy-3">
                  

                    <div class="col-md-6">
                        <label>Member Number</label>
                        <input type="text" name="member_number" class="form-control " value="{{ old('member_number', $user->member_number) }}">
                        @error('member_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6"><label>Name*</label><input type="text" name="name" class="form-control" required
                        value="{{ old('name', $user->name) }}"> @error('name')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror</div>

                    <div class="col-md-6"><label>Name (Bangla)</label><input type="text" name="name_bn" class="form-control"
                        value="{{ old('name_bn', $user->name_bn) }}"></div>

                    <div class="col-md-6">
                        <label>Father's Name</label>
                        <input type="text" name="father_name" class="form-control" value="{{ old('name_bn', $user->father_name) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Mother's Name</label>
                        <input type="text" name="mother_name" class="form-control" value="{{ old('name_bn', $user->mother_name) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Husband Name</label>
                        <input type="text" name="husband_name" class="form-control" value="{{ old('name_bn', $user->husband_name) }}">
                    </div>
                    <div class="col-md-6">
                        <label>Wife Name</label>
                        <input type="text" name="wife_name" class="form-control" value="{{ old('name_bn', $user->wife_name) }}">
                    </div>    

                    <div class="col-md-6"><label>DOB</label><input type="date" name="dob" class="form-control"
                        value="{{ old('dob', $user->dob?->format('Y-m-d')) }}"></div>

                    <div class="col-md-6"><label>Mobile*</label><input type="tel" name="mobile_number" class="form-control"
                        required value="{{ old('mobile_number', $user->mobile_number) }}"> @error('mobile_number')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror</div>

                    <div class="col-md-6"><label>NID</label><input type="text" name="nid" class="form-control"
                        value="{{ old('nid', $user->nid) }}"></div>

                    <div class="col-md-6"><label>Occupation</label><input type="text" name="occupation" class="form-control"
                        value="{{ old('occupation', $user->occupation) }}"></div>

                    <div class="col-md-6"><label>Interest Rate</label><input type="text" name="interest_rate" class="form-control"
                        value="{{ old('	interest_rate', $user->	interest_rate) }}"></div>

                    <div class="col-md-6"><label>Member Fee</label><input type="text" name="member_fee" class="form-control"
                        value="{{ old('member_fee', $user->member_fee) }}"></div>

                    <div class="col-md-6"><label>Balance</label><input type="text" name="balance" class="form-control"
                        value="{{ old('balance', $user->balance) }}"></div>

                    {{-- Address dropdowns --}}
                    @foreach (['present', 'permanent'] as $type)
                        <div class="col-md-6"><label>{{ ucfirst($type) }} Address</label><input type="text" name="{{ $type }}_address"
                            class="form-control" value="{{ old($type . '_address', $user->{$type . '_address'}) }}"></div>

                        <div class="col-md-6"><label>{{ ucfirst($type) }} Division</label>
                            <select id="{{ $type }}_division" name="{{ $type }}_division" class="form-control">
                                <option value="">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}"
                                        {{ old($type.'_division', $user->{$type.'_division'}) == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6"><label>{{ ucfirst($type) }} District</label>
                            <select id="{{ $type }}_district" name="{{ $type }}_district" class="form-control">
                                <option value="">Select District</option>
                            </select>
                        </div>

                        <div class="col-md-6"><label>{{ ucfirst($type) }} Police Station</label>
                            <select id="{{ $type }}_police_station" name="{{ $type }}_police_station" class="form-control">
                                <option value="">Select Police Station</option>
                            </select>
                        </div>
                        
                    @endforeach
                    <div class="col-md-6"><label>Nationality</label><input type="text" name="nationality" class="form-control" value="{{ old('name_bn', $user->nationality) }}"></div>
                     <div class="col-md-6"><label>Mobile Number*</label><input type="tel" name="mobile_number" class="form-control"  value="{{ old('name_bn', $user->mobile_number) }}">
                    @error('mobile_number')
                            <div class="text-danger">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="col-md-6"><label>Mobile Number 2</label><input type="tel" name="mobile_number_2" class="form-control" value="{{ old('name_bn', $user->mobile_number_2) }}"></div>
                    <div class="col-md-6"><label>Mobile Number 3</label><input type="tel" name="mobile_number_3" class="form-control" value="{{ old('name_bn', $user->mobile_number_3) }}"></div>
                    

                    <div class="col-md-6"><label>Join Date</label><input type="date" name="join_date" class="form-control"
                        value="{{ old('join_date', $user->join_date?->format('Y-m-d')) }}"></div>

                    <div class="col-md-6"><label>Image</label><input type="file" name="image" class="form-control">
                        @if($user->image)<img src="{{ asset('uploads/files/' . $user->image) }}" width="50" class="mt-2">@endif
                    </div>

                    <div class="col-md-6"><label>Signature</label><input type="file" name="signature" class="form-control">
                        @if($user->signature)<img src="{{ asset('uploads/files/' . $user->signature) }}" width="50" class="mt-2">@endif
                    </div>
                </div>
            </div>
        </div>
        </div>

        {{-- Nominee Info --}}
        <!-- Nominee Information -->
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
        <div class="card mb-3">
            <div class="card-header"><h5>Nominee Information</h5></div>
            <div class="card-body">
                <div class="row gy-4">
                    <input type="text" name="nominee_name" class="form-control" required value="{{ old('nominee_name', $user->latestNominee?->name) }}">
                    <div class="col-md-6"><label>Relation</label>
                        <input type="text" name="nominee_relation" class="form-control" value="{{ old('nominee_relation', $user->latestNominee?->relation) }}">
                    </div>
                    <div class="col-md-6"><label>DOB</label>
                        <input type="date" name="nominee_dob" class="form-control" value="{{ old('nominee_dob', optional($user->latestNominee)->dob?->format('Y-m-d')) }}">
                    </div>
                    

                    <!-- Nominee Present Address -->
                    <div class="col-md-6"><label>Present Address</label>
                        <input type="text" name="nominee_present_address" class="form-control" value="{{ old('nominee_present_address', $user->latestNominee?->present_address) }}">
                    </div>
                    <div class="col-md-6"><label>Present Division</label>
                        <select id="nominee_present_division" name="nominee_present_division" class="form-control">
                            <option value="">Select Division</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}" {{ old('nominee_present_division', $user->latestNominee?->present_division) == $division->id ? 'selected' : '' }}>
                                    {{ $division->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label>Present District</label>
                        <select id="nominee_present_district" name="nominee_present_district" class="form-control">
                            <option value="">Select District</option>
                        </select>
                    </div>
                    <div class="col-md-6"><label>Present Police Station</label>
                        <select id="nominee_present_police_station" name="nominee_present_police_station" class="form-control">
                            <option value="">Select Police Station</option>
                        </select>
                    </div>

                    <!-- Nominee Permanent Address -->
                    <div class="col-md-6"><label>Permanent Address</label>
                        <input type="text" name="nominee_permanent_address" class="form-control" value="{{ old('nominee_permanent_address', $user->latestNominee?->permanent_address) }}">
                    </div>
                    <div class="col-md-6"><label>Permanent Division</label>
                        <select id="nominee_permanent_division" name="nominee_permanent_division" class="form-control">
                            <option value="">Select Division</option>
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}" {{ old('nominee_permanent_division', $user->latestNominee?->permanent_division) == $division->id ? 'selected' : '' }}>
                                    {{ $division->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label>Permanent District</label>
                        <select id="nominee_permanent_district" name="nominee_permanent_district" class="form-control">
                            <option value="">Select District</option>
                        </select>
                    </div>
                    <div class="col-md-6"><label>Permanent Police Station</label>
                        <select id="nominee_permanent_police_station" name="nominee_permanent_police_station" class="form-control">
                            <option value="">Select Police Station</option>
                        </select>
                    </div>

                    <div class="col-md-6"><label>Image</label>
                        <input type="file" name="nominee_image" class="form-control">
                        @if($user->latestNominee?->image)
                        <img src="{{ asset('uploads/files/' . $user->latestNominee->image) }}" width="50" class="mt-2">
                        @endif
                    </div>
                </div>
            </div>
            
</div>
</div>
<div class="card mb-3">
    <div class="card-body col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <button type="submit" class="btn btn-success form-control">Update</button>
            </div>
</div>
    </form>
</main>

<script>
function setupDropdownChain(prefix, selectedDistrict, selectedPs) {
    const dDiv = document.getElementById(`${prefix}_division`);
    const dDist = document.getElementById(`${prefix}_district`);
    const dPs = document.getElementById(`${prefix}_police_station`);
    if (!dDiv) return;

    dDiv.addEventListener('change', function(){
        fetch(`/locations/districts/${this.value}`)
            .then(r=>r.json())
            .then(arr=>{
                dDist.innerHTML = '<option value="">Select District</option>' +
                    arr.map(o => `<option value="${o.id}" ${o.id==selectedDistrict?'selected':''}>${o.name}</option>`).join('');
                dDist.disabled = false;
                dPs.innerHTML = '<option value="">Select Police Station</option>';
                dPs.disabled = true;
                if(selectedDistrict) dDist.dispatchEvent(new Event('change'));
            });
    });

    dDist.addEventListener('change', function(){
        fetch(`/locations/police-stations/${this.value}`)
            .then(r=>r.json())
            .then(arr=>{
                dPs.innerHTML = '<option value="">Select Police Station</option>' +
                    arr.map(o => `<option value="${o.id}" ${o.id==selectedPs?'selected':''}>${o.name}</option>`).join('');
                dPs.disabled = false;
            });
    });

    if(dDiv.value) dDiv.dispatchEvent(new Event('change'));
}

document.addEventListener('DOMContentLoaded', function(){
   
    setupDropdownChain('present', '{{ $user->present_district }}', '{{ $user->present_police_station }}');
    setupDropdownChain('permanent', '{{ $user->permanent_district }}', '{{ $user->permanent_police_station }}');

    setupDropdownChain('nominee_present', '{{ $user->latestNominee?->present_district }}', '{{ $user->latestNominee?->present_police_station }}');
    

    setupDropdownChain('nominee_permanent', '{{ $user->latestNominee?->permanent_district }}', '{{ $user->latestNominee?->permanent_police_station }}');
});
</script>
@endsection