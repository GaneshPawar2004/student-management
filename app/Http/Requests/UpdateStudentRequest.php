<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $id = $this->route('student')->id ?? null;

        return [
            'first_name' => ['required','string','max:100'],
            'last_name'  => ['required','string','max:100'],
            'email'      => ['required','email','max:255', Rule::unique('students','email')->ignore($id)],
            'phone'      => ['nullable','string','max:50'],
            'dob'        => ['nullable','date'],
            'gender'     => ['nullable','in:male,female,other'],
            'roll_no'    => ['required','string','max:50', Rule::unique('students','roll_no')->ignore($id)],
            'photo'      => ['nullable','image','max:2048'],
            'address'    => ['nullable','string','max:2000'],
        ];
    }
}
