<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LostRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ture;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'number' => 'required|string',
            'find_Time' => 'required|date',
            'situation' => 'required|string'
        ];
    }
}
