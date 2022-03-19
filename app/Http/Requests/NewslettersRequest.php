<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewslettersRequest extends Request
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
            'name' => 'required',
            'email' => 'required',
            'bidding_category_id' => 'required_without_all:bidding_id',
            'bidding_id' => 'required_without_all:bidding_category_id',
        ];
    }
}
