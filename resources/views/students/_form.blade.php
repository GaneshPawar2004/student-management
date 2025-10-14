@csrf
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">First name</label>
        <input name="first_name" value="{{ old('first_name', $student->first_name ?? '') }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Last name</label>
        <input name="last_name" value="{{ old('last_name', $student->last_name ?? '') }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="{{ old('email', $student->email ?? '') }}" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input name="phone" value="{{ old('phone', $student->phone ?? '') }}" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">Roll no</label>
        <input name="roll_no" value="{{ old('roll_no', $student->roll_no ?? '') }}" class="form-control" required>
    </div>
    <div class="col-md-3">
        <label class="form-label">DOB</label>
        <input type="date" name="dob" value="{{ old('dob', optional($student->dob ?? null)->format('Y-m-d')) }}" class="form-control">
    </div>
    <div class="col-md-3">
        <label class="form-label">Gender</label>
        <select name="gender" class="form-select">
            @php($g = old('gender', $student->gender ?? ''))
            <option value="">Select</option>
            <option value="male" @selected($g==='male')>Male</option>
            <option value="female" @selected($g==='female')>Female</option>
            <option value="other" @selected($g==='other')>Other</option>
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Address</label>
        <textarea name="address" rows="3" class="form-control">{{ old('address', $student->address ?? '') }}</textarea>
    </div>
    <div class="col-12">
        <label class="form-label">Photo</label>
        <input type="file" name="photo" class="form-control">
        @isset($student->photo_path)
            <div class="mt-2">
                <img src="{{ asset('storage/'.$student->photo_path) }}" width="64" class="rounded" alt="">
            </div>
        @endisset
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Save</button>
        <a class="btn btn-outline-secondary" href="{{ route('students.index') }}">Cancel</a>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
