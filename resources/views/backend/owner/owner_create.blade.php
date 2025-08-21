@extends('backend.admin_master') @section('content') <main class="main-content px-3">
    <h3 class="pt-3 text-muted">Staff Form</h3>
    <nav aria-label="breadcrumb px-2">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('/dashboard') }}">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Input</li>
        </ol>
    </nav>
    <form action="{{ route('owner.store') }}" method="POST" enctype="multipart/form-data"> 
        @csrf 
        <div class="card card-dark mb-3">
            <div class="card-header">
                <h5>Staff Information</h5>
            </div>
            <div class="card-body">
                <div class="row gy-4">
                    {{-- User fields --}}
                    <input type="hidden" name="role" value="4">
                    <div class="col-md-6">
                        <label>Name*</label>
                        <input type="text" name="name" class="form-control " value="{{ old('name') }}">
                        @error('name')
                        <div class="text-danger">{{ $message }}
                        </div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Name (Bangla)</label>
                        <input type="text" name="name_bn" class="form-control" value="{{ old('name_bn') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Father's Name</label>
                        <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Mother's Name</label>
                        <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name') }}">
                    </div>
                    <div class="col-md-6">
                        <label>DOB</label>
                        <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                    </div>
                    <div class="col-md-6">
                        <label>NID</label>
                        <input type="text" name="nid" class="form-control" value="{{ old('nid') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Occupation</label>
                        <input type="text" name="occupation" class="form-control" value="{{ old('occupation') }}">
                    </div>
                    {{-- Present Address --}}
                    <div class="col-md-6">
                        <label>Present Address</label>
                        <input type="text" name="present_address" class="form-control" value="{{ old('present_address') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Present Division</label>
                        <select id="present_division" name="present_division" class="form-control">
                            <option value="">Select Division</option> @foreach ($divisions as $division) <option value="{{ $division->id }}">{{ $division->name }}</option> @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Present District</label>
                        <select id="present_district" name="present_district" class="form-control">
                            <option value="">Select District</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Present Police Station</label>
                        <select id="present_police_station" name="present_police_station" class="form-control">
                            <option value="">Select Police Station</option>
                        </select>
                    </div>
                    {{-- Permanent Address --}}
                    {{-- permanent Address --}}
                    <div class="col-md-6">
                        <label>Permanent Address</label>
                        <input type="text" name="permanent_address" class="form-control" value="{{ old('permanent_address') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Permanent Division</label>
                        <select id="permanent_division" name="permanent_division" class="form-control">
                            <option value="">Select Division</option> @foreach ($divisions as $division) <option value="{{ $division->id }}">{{ $division->name }}</option> @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Permanent District</label>
                        <select id="permanent_district" name="permanent_district" class="form-control">
                            <option value="">Select District</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Permanent Police Station</label>
                        <select id="permanent_police_station" name="permanent_police_station" class="form-control">
                            <option value="">Select Police Station</option>
                        </select>
                    </div>
                    {{-- Other --}}
                    <div class="col-md-6">
                        <label>Nationality</label>
                        <input type="text" name="nationality" class="form-control" value="{{ old('nationality') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Mobile Number*</label>
                        <input type="tel" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}"> @error('mobile_number') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <input type="hidden" name="date" value="{{ old('date', date('Y-m-d')) }}">
                    <div class="col-md-6">
                        <label>Mobile Number 2</label>
                        <input type="tel" name="mobile_number_2" class="form-control" value="{{ old('mobile_number_2') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Mobile Number 3</label>
                        <input type="tel" name="mobile_number_3" class="form-control" value="{{ old('mobile_number_3') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Join Date</label>
                        <input type="date" name="join_date" class="form-control" value="{{ old('join_date') }}">
                    </div>
                    <div class="col-md-6">
                        <label>Signature</label>
                        <input type="file" name="signature" class="form-control">
                    </div>
                    {{-- Password --}}
                    <div class="col-md-6">
                        <label>Password*</label>
                        <input type="password" name="password" class="form-control"> @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Confirm Password*</label>
                        <input type="password" name="password_confirmation" class="form-control"> @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
            <div class="card-footer w-50">
                <button type="submit" class="btn btn-success w-100">Submit</button>
            </div>
        </div>
    </form>
</main>
<script>
    function setupLocationDropdowns(prefix) {
        const division = document.getElementById(`${prefix}_division`);
        const district = document.getElementById(`${prefix}_district`);
        const policeStation = document.getElementById(`${prefix}_police_station`);
        if (!division || !district || !policeStation) return;
        division.addEventListener('change', function() {
            fetch(`/locations/districts/${this.value}`).then(res => res.ok ? res.json() : Promise.reject(res.status)).then(data => {
                district.innerHTML = ' < option > Select District < /option>' +
                data.map(d => `
																					<option value="${d.id}">${d.name}</option>`).join('');
                district.disabled = false;
                policeStation.innerHTML = ' < option > Select Police Station < /option>';
                policeStation.disabled = true;
            }).catch(e => console.error(`Error fetching districts for ${prefix}:`, e));
        });
        district.addEventListener('change', function() {
            fetch(`/locations/police-stations/${this.value}`).then(res => res.ok ? res.json() : Promise.reject(res.status)).then(data => {
                policeStation.innerHTML = ' < option > Select Police Station < /option>' +
                data.map(ps => `
																					<option value="${ps.id}">${ps.name}</option>`).join('');
                policeStation.disabled = false;
            }).catch(e => console.error(`Error fetching police stations for ${prefix}:`, e));
        });
    }
    // Initialize all address dropdowns
    setupLocationDropdowns('present');
    setupLocationDropdowns('permanent');
    setupLocationDropdowns('nominee_present');
    setupLocationDropdowns('nominee_permanent');
</script> @endsection