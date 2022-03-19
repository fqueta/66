<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class PagesRequest extends Request
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
            'type' => 'required',
            'link' => 'required_if:type,link',
            'subtitle' => 'required_if:type,content',
            'subtitle' => 'required_if:type,marketing',
            'content' => 'required_if:type,content',
            'content' => 'required_if:type,marketing',
        ];
    }
}
