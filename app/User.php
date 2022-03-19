<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Sofa\Eloquence\Eloquence;
use Heroicpixels\Filterable\FilterableTrait;
use Kyslik\ColumnSortable\Sortable;
use Session;

use App\Permission;

class User extends Model implements AuthenticatableContract,
									AuthorizableContract,
									CanResetPasswordContract
{
	use Authenticatable, Authorizable, CanResetPassword, Eloquence, Sortable;

	protected $table = 'users';

	protected $fillable = ['name', 'email', 'password'];

	protected $hidden = ['password'];

	protected $sortable = ['id', 'name', 'email', 'created_at', 'updated_at'];

	static function passwordMatch($items){
		if($items['password'] == $items['password_confirmation']){
			return true;
		}
		Session::flash('flash_danger', 'password_dont_match');
		return false;
	}

	public function permissions()
	{
		return $this->hasMany('App\Permission');
	}

	public function savePermissions($permissions){
		Permission::where(['user_id' => $this->id])->delete();
		if($permissions){
      foreach ($permissions as $key => $permission){
        Permission::create(['user_id' => $this->id, 'route' => $permission]);
      }
    }
	}
}
