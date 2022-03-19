<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
class DiariesRequest extends Request
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
        $validation = [];

        $validation['code'] = 'required';
        $validation['date'] = 'required';
        $validation['description'] = 'required';
        if($this->method() == "POST"){
            $validation['file'] = 'required|max:500000';
        }
        return $validation;
    }
}
