<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class BtrimestralsRequest extends Request
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
            //'genre_id' => 'required',
            //'phase_id' => 'required',
            //'type_id' => 'required',
            //'bidding_category_id' => 'required',
            'opening' => 'required',
            //'indentifier' => 'required',
            'object' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'O Titulo é obrigatório',
            'object.required' => 'A Descrição é obrigatório',
        ];
    }
}
