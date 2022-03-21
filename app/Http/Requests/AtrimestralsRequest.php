<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class AtrimestralsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check('user'))
            return true;
        return false;
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
            'btrimestral_id' => 'required',
            'file' => 'required',
        ];
    }
}
