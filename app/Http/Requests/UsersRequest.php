<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use Auth;

class UsersRequest extends Request
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
		$validations = [
			'name'      => 'required|max:150',
			'email'     => 'required|max:150|unique:users',
			'permissions' => 'required',
		];
		if($this->isMethod('PUT')){
			$validations['email'] = 'required|max:150';
		}
		if($this->isMethod('POST')){
			$validations['password'] = 'required|max:30|min:6';
		}
		return $validations;
	}
}
