<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'first_name' => ['required','string','max:100'],
            'last_name'  => ['required','string','max:100'],
            'email'      => ['required','email','max:255','unique:students,email'],
            'phone'      => ['nullable','string','max:50'],
            'dob'        => ['nullable','date'],
            'gender'     => ['nullable','in:male,female,other'],
            'roll_no'    => ['required','string','max:50','unique:students,roll_no'],
            'photo'      => ['nullable','image','max:2048'],
            'address'    => ['nullable','string','max:2000'],
        ];
    }
}
