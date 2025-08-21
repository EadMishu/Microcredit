@extends('backend.admin_master') @section('content') 
<main class="main-content px-3">
    <h3 class="pt-3 text-muted">Edit Staff</h3>
    <nav aria-label="breadcrumb px-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('owner.index') }}">User List</a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
    <form action="{{ route('owner.update', $user->id) }}" method="POST" enctype="multipart/form-data"> @csrf @method('PUT') {{-- Member Info --}}
        <div class="card mb-3">
            <div class="card-header">
                <h5>owner Information</h5>
            </div>
            <div class="card-body">
                <div class="row gy-3">
               
                <div class="col-md-6">
                    <label>Name*</label>
                    <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}"> @error('name') <div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                
                 <input type="hidden" name="role" value="4">

                <div class="col-md-6">
                    <label>Name (Bangla)</label>
                    <input type="text" name="name_bn" class="form-control" value="{{ old('name_bn', $user->name_bn) }}">
                </div>
                <div class="col-md-6">
                    <label>Father's Name</label>
                    <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $user->father_name) }}">
                </div>
                <div class="col-md-6">
                    <label>Mother's Name</label>
                    <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name', $user->mother_name) }}">
                </div>
                <div class="col-md-6">
                    <label>DOB</label>
                    <input type="date" name="dob" class="form-control" value="{{ old('dob', $user->dob?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label>NID</label>
                    <input type="text" name="nid" class="form-control" value="{{ old('nid', $user->nid) }}">
                </div>
                <div class="col-md-6">
                    <label>Occupation</label>
                    <input type="text" name="occupation" class="form-control" value="{{ old('occupation', $user->occupation) }}">
                </div>
                {{-- Address dropdowns --}} @foreach (['present', 'permanent'] as $type) 
                <div class="col-md-6">
                    <label>{{ ucfirst($type) }} Address</label>
                    <input type="text" name="{{ $type }}_address" class="form-control" value="{{ old($type . '_address', $user->{$type . '_address'}) }}">
                </div>
                <div class="col-md-6">
                    <label>{{ ucfirst($type) }} Division</label>
                    <select id="{{ $type }}_division" name="{{ $type }}_division" class="form-control">
                        <option value="">Select Division</option> @foreach($divisions as $division) <option value="{{ $division->id }}" {{ old($type.'_division', $user->{$type.'_division'}) == $division->id ? 'selected' : '' }}>
                            {{ $division->name }}
                        </option> @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>{{ ucfirst($type) }} District</label>
                    <select id="{{ $type }}_district" name="{{ $type }}_district" class="form-control">
                        <option value="">Select District</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>{{ ucfirst($type) }} Police Station</label>
                    <select id="{{ $type }}_police_station" name="{{ $type }}_police_station" class="form-control">
                        <option value="">Select Police Station</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Nationality</label>
                    <input type="text" name="nationality" class="form-control" value="{{ old('nationality', $user->nationality) }}">
                </div> @endforeach <div class="col-md-6">
                    <label>Mobile Number*</label>
                    <input type="tel" name="mobile_number" class="form-control" value="{{ old('mobile_number', $user->mobile_number) }}"> @error('mobile_number') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label>Mobile Number 2</label>
                    <input type="tel" name="mobile_number_2" class="form-control" value="{{ old('mobile_number_2', $user->mobile_number_2) }}">
                </div>
                <div class="col-md-6">
                    <label>Mobile Number 3</label>
                    <input type="tel" name="mobile_number_3" class="form-control" value="{{ old('mobile_number_3', $user->mobile_number_3) }}">
                </div>
                <input type="hidden" name="date" value="{{ old('date', $user->date?->format('Y-m-d')) }}">
                <div class="col-md-6">
                    <label>Join Date</label>
                    <input type="date" name="join_date" class="form-control" value="{{ old('join_date', $user->join_date?->format('Y-m-d')) }}">
                </div>
                <div class="col-md-6">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control"> @if($user->image) <img src="{{ asset('uploads/files/' . $user->image) }}" width="50" class="mt-2">@endif
                </div>
                <div class="col-md-6">
                    <label>Signature</label>
                    <input type="file" name="signature" class="form-control"> @if($user->signature) <img src="{{ asset('uploads/files/' . $user->signature) }}" width="50" class="mt-2">@endif
                </div>
            </div>
        </div>
        </div>
        <div class="card-footer col-xl-4 col-lg-6 col-md-6 col-sm-12">
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
        dDiv.addEventListener('change', function() {
            fetch(`/locations/districts/${this.value}`).then(r => r.json()).then(arr => {
                dDist.innerHTML = ' < option value = "" > Select District < /option>' +
                arr.map(o => `
																	<option value="${o.id}" ${o.id==selectedDistrict?'selected':''}>${o.name}</option>`).join('');
                dDist.disabled = false;
                dPs.innerHTML = ' < option value = "" > Select Police Station < /option>';
                dPs.disabled = true;
                if (selectedDistrict) dDist.dispatchEvent(new Event('change'));
            });
        });
        dDist.addEventListener('change', function() {
            fetch(`/locations/police-stations/${this.value}`).then(r => r.json()).then(arr => {
                dPs.innerHTML = ' < option value = "" > Select Police Station < /option>' +
                arr.map(o => `
																	<option value="${o.id}" ${o.id==selectedPs?'selected':''}>${o.name}</option>`).join('');
                dPs.disabled = false;
            });
        });
        if (dDiv.value) dDiv.dispatchEvent(new Event('change'));
    }
    document.addEventListener('DOMContentLoaded', function() {
        setupDropdownChain('present', '{{ $user->present_district }}', '{{ $user->present_police_station }}');
        setupDropdownChain('permanent', '{{ $user->permanent_district }}', '{{ $user->permanent_police_station }}');
        setupDropdownChain('nominee_present', '{{ $user->latestNominee?->present_district }}', '{{ $user->latestNominee?->present_police_station }}');
        setupDropdownChain('nominee_permanent', '{{ $user->latestNominee?->permanent_district }}', '{{ $user->latestNominee?->permanent_police_station }}');
    });
</script> @endsection