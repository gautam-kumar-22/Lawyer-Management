<?php

namespace App\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaffUpdateRequest extends FormRequest
{
    use ValidationMessage;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "employee_id" => "required_if:role_type,!=,'system_user'",
            "name" => "required",
            "phone" => "sometimes|nullable|string",
            "email" => "required|unique:users,email," . $this->user_id,
            "role_id" => "required|nullable",
            "date_of_birth" => "required_if:role_type,!=,'system_user'",
            "current_address" => "required_if:role_type,!=,'system_user'",
            "permanent_address" => "required_if:role_type,!=,'system_user'",
            "bank_name" => "required_if:role_type,!=,'system_user'",
            "bank_branch_name" => "required_if:role_type,!=,'system_user'",
            "bank_account_name" => "required_if:role_type,!=,'system_user'",
            "bank_account_no" => "required_if:role_type,!=,'system_user'",
            "date_of_joining" => "required_if:role_type,!=,'system_user'",
            "basic_salary" => "required_if:role_type,!=,'system_user'",
            "employment_type" => "required_if:role_type,!=,'system_user'",
            'photo' => 'nullable|mimes:jpeg,jpg,png',
            'signature_photo' => 'nullable|mimes:jpeg,jpg,png',
            'password' => 'sometimes|nullable|string|min:8|confirmed'
        ];
    }
}
