<?php

namespace Modules\Setting\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
{
    use ValidationMessage;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'favicon_logo' => 'nullable|image|mimes:png,jpeg,jpg',
            'site_logo' => 'nullable|image|mimes:png,jpeg,jpg',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }
}
