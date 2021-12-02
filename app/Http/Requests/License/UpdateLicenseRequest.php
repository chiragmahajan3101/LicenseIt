<?php

namespace App\Http\Requests\License;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLicenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'software_id' => 'required|exists:software,id',
            'buyer_id' => 'required|exists:users,id',
            'buy_date' => 'required',
            'hardware_id' => 'required',
            'activation_code' => 'required',
            'amount' => 'required|min:0',
            'transaction_id' => 'required',
            'notes' => 'required',
        ];
    }
}
