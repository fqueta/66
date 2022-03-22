<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use App\Http\Requests\AtrimestralsRequest;
use App\Http\Controllers\Controller;
use App\Atrimestral;
use App\Btrimestral;



class A_trimestralsController extends Controller
{
    public $path;
	public function __construct()
	{
		$this->path = public_path().'/uploads/atrimestrals/';
	}
	public function index($parent_id)
	{
		if ($parent = Btrimestral::find($parent_id)) {
			return view('admin.a_trimestrals.index', [
				'parent_page' => $parent,
				'attachments' => $parent->attachments,
			]);
		}
		else
			return redirect()->route('admin.b_trimestrals.index');
	}
	
	public function create($parent_id)
	{
		if ($parent = Btrimestral::find($parent_id))
			return view('admin.a_trimestrals.add', ['parent_page' => $parent, 'attachments' => new Attachment(), 'status' => 'creating']);
		else
			return redirect()->route('admin.b_trimestrals.index');
	}
	
	public function store($parent_id, AtrimestralsRequest $request)
	{
		//$request = $request->all();
		$file = $request->file('file');
        $filenameWithExt = $file->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();
        $mimeType = $extension;
        // Filename to store
        //$fileNameToStore= $filename.'_'.time().'.'.$extension;
        $fileNameToStore= $filename.'.'.$extension;
        // Upload Image
        //if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='zip' || $extension=='pdf' || $extension=='PDF'){
			$dados = $request->all();
            $btrimestral_id = $dados['btrimestral_id'];
            $ultimoValor = Atrimestral::where('btrimestral_id','=',$btrimestral_id)->max('order');
            $order = $ultimoValor ? $ultimoValor : 0;
            $order++;
            $pasta = isset($dados['pasta'])?$dados['pasta']:$this->path.$btrimestral_id;
            $nomeArquivoSavo = $file->move($pasta,$fileNameToStore);
			$exec = false;
            $salvar = false;
            if($nomeArquivoSavo){
				$exec = true;
                $salvar = Atrimestral::create([
                    'title'=>$dados['title'],
                    'file_content_type'=>$mimeType,
                    'btrimestral_id'=>$btrimestral_id,
                    'file_file_name'=>$fileNameToStore,
                    'order'=>$order,
                ]);
			}
            //$lista = _upload::where('btrimestral_id','=',$btrimestral_id)->get();
            if($salvar){
                //return response()->json(['Arquivo enviado com sucesso'=>200]);
            	\Session::flash('flash_sucess', 'add_sucess');
				return redirect()->route('admin.b_trimestrals.attachments.index', $parent_id);
			} else
				return view('admin.a_trimestrals.add', ['parent_page' => Atrimestral::find($parent_id), 'attachments' => $request]);
		/*
		if (!empty($request) && ($request = Atrimestral::create($request)) ) {
			\Session::flash('flash_sucess', 'add_sucess');
			return redirect()->route('admin.b_trimestrals.attachments.index', $parent_id);
		} else
			return view('admin.a_trimestrals.add', ['parent_page' => Atrimestral::find($parent_id), 'attachments' => $request]);
		*/
	}

	public function edit($parent_id, $id)
	{
		if ($request = Atrimestral::find($id))
			return view('admin.a_trimestrals.edit', ['parent_page' => $request->parent, 'attachments' => $request, 'status' => 'editing']);
		else
			return redirect()->route('admin.b_trimestrals.attachments.index', $parent_id);
	}

	public function update(AttachmentsRequest $request, $parent_id, $id)
	{

		if(empty($attachment = Atrimestral::find($id))) {
			\Session::flash('flash_danger', 'invalid_record');
			return redirect()->route('admin.b_trimestrals.attachments.index', $parent_id);
		}
		else {
			$attachment->fill($request->all());
			$attachment->slug = null;
			if ($attachment->save()) {
				\Session::flash('flash_sucess', 'edit_sucess');
				return redirect()->route('admin.b_trimestrals.attachments.index', $parent_id);
			}
			else {
				\Session::flash('flash_danger', 'record_failed');
				return view('admin.a_trimestrals.edit', [
					'parent_page' => $attachment->parent,
					'attachments' => $attachment
				]);
			}
		}
	}

	public function destroy($parent_id, $id)
	{
		$data = Atrimestral::find($id);
		$arquivo = $this->path.$parent_id.'/'.$data['file_file_name'];
		//dd( file_exists($arquivo) );
		if (!file_exists($arquivo)) {
			\Session::flash('flash_danger', 'invalid_record');
			$del = Atrimestral::where('id',$id)->delete();
			return redirect()->route('admin.b_trimestrals.attachments.index', $parent_id);
		}
			
		if(File::delete($arquivo)) {
			\Session::flash('flash_sucess', 'record_deleted');
			$del = Atrimestral::where('id',$id)->delete();
			return redirect()->route('admin.b_trimestrals.attachments.index', $parent_id);
		}
		else{
			\Session::flash('flash_danger', 'record_delete_failed');
			return redirect()->route('admin.b_trimestrals.attachments.index', $parent_id);
		}    
	}


    public function postSort(Request $request)
    {
        $order = 0;
        foreach ($request->get('featured_enterprises') as $key => $id) {
            Atrimestral::find($id)->update(['order' => $order]);
            $order++;
        }
        abort(200);
    }
}
