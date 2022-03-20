<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\UsersRequest;

use Illuminate\Support\Facades\Input;
use Session;

use App\User;
use App\Permission;

class UsersController extends AdminController
{

    public $permissions = [
        // Mídias
        ['name' => "players", "displayName" => "Slider"], 
        ['name' => "banners", "displayName" => "Banners"], 
        ['name' => "floaters", "displayName" => "Floaters"], 
        ['name' => "uploads", "displayName" => "Gerenciador de arquivos"], 
        // Conteúdo
        ['name' => "pages", "displayName" => "Páginas"],
        ['name' => "notices", "displayName" => "Avisos"],
        ['name' => "posts", "displayName" => "Notícias"],
        ['name' => "diaries", "displayName" => "Diário Oficial"],
        // ['name' => "attachments", "displayName" => "Anexos"],
        // Licitações
        ['name' => "biddings", "displayName" => "Processos"], 
        ['name' => "b_trimestrals", "displayName" => "Processos Trimestrais"], 
        ['name' => "bidding_categories", "displayName" => "Áreas"], 
        ['name' => "newsletters", "displayName" => "Recebimento de notificações"], 
        // Fale conosco
        ['name' => "sections", "displayName" => "Secretarias"], 
        ['name' => "receivers", "displayName" => "Recebimento de e-mails"], 
        ['name' => "contacts", "displayName" => "Mensagens recebidas"],
        // Configurações
        ['name' => "users", "displayName" => "Usuários"],

        // ['name' => "media", "displayName" => "Mídias"],
        // ['name' => "content", "displayName" => "Conteúdo"],
        // ['name' => "bidding", "displayName" => "Licitações"],
        // ['name' => "talk-with-us", "displayName" => "Fale conosco"],
        // ['name' => "configuration", "displayName" => "Configurações"],
    ];

    public function index()
    {
        $this->saveSession(Input::all());
        $users = User::where('name', 'LIKE', '%'.Session::get("filter_users_name").'%')
            ->where('email', 'LIKE', '%'.Session::get("filter_users_email").'%')
            ->orderBy('name', 'ASC')
            ->sortable();


        $count = $users->count();
        $users = $users->paginate(20);
        return view('admin.users.index', ['users' => $users, 'count' => $count]);
    }

    public function create()
    {
        return view('admin.users.add', ['user' => new User(), 'permissions' => $this->permissions]);
    }

    public function store(UsersRequest $request)
    {
        $request = $request->all();
        if(!User::passwordMatch($request))
            return view('admin.users.add');
        $request['password'] = bcrypt($request['password']);
        if($user = User::create($request)){
          $user->savePermissions($request['permissions']);
          Session::flash('flash_sucess', 'add_sucess');
          return redirect()->route('admin.users.index');
        }
        Session::flash('flash_warnig', 'record_failed');
        return redirect()->route('admin.users.create');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if(AdminController::isEmpty($user))
            return redirect()->route('admin.users.index');
        return view('admin.users.edit', ['user' => $user, 'permissions' => $this->permissions, 'selectedPermissions' => $user->permissions->lists('route', 'route')->toArray()]);
    }

    public function update(UsersRequest $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->except('password'));
        if(AdminController::isEmpty($user))
          return redirect()->route('admin.users.index');
        if(!User::passwordMatch($request->only(['password', 'password_confirmation'])))
          return redirect()->route('admin.users.edit', $id);
        if(trim($request->get('password')) != "")
            $user['password'] = bcrypt($request->get('password'));
        if ($user->save()){
          $user->savePermissions($request->permissions);
          \Session::flash('flash_sucess', 'edit_sucess');
        }
        else
          \Session::flash('flash_danger', 'record_failed');
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($users = User::find($id)->delete())
            \Session::flash('flash_sucess', 'record_deleted');
        else
            \Session::flash('flash_danger', 'record_delete_failed');
        return redirect()->route('admin.users.index');
    }
}
