<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
{
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
            'title' => 'required',
            'price' => 'nullable|numeric',
            'days_amount' => 'nullable|numeric',
            'type_id' => 'nullable|numeric',
            'attachment_id' => 'nullable|numeric',
            'link_id' => 'nullable|numeric',
        ];
    }
}
