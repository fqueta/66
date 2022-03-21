<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\AtrimestralsRequest;
use App\Http\Controllers\Controller;
use App\Atrimestral;
use App\Btrimestral;


class A_trimestralsController extends Controller
{
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
        // Filename to store
        //$fileNameToStore= $filename.'_'.time().'.'.$extension;
        $fileNameToStore= $filename.'.'.$extension;
        // Upload Image
        //dd($extension);
        //if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='zip' || $extension=='pdf' || $extension=='PDF'){
            $dados = $request->all();
            $token_produto = $dados['btrimestral_id'];
            //$ultimoValor = _upload::where('token_produto','=',$token_produto)->max('ordem');
            //$ordem = $ultimoValor ? $ultimoValor : 0;
            //$ordem++;
            $pasta = isset($dados['pasta'])?$dados['pasta']:base_path().'/uploads/atrimestrals/'.$token_produto;
            $nomeArquivoSavo = $file->move($pasta,$fileNameToStore);
			dd($nomeArquivoSavo);
            $exec = false;
            $salvar = false;
            /*
			if($nomeArquivoSavo){
                $exec = true;
                $salvar = _upload::create([
                    'token_produto'=>$token_produto,
                    'pasta'=>$nomeArquivoSavo,
                    'ordem'=>$ordem,
                    'nome'=>$filenameWithExt,
                    'config'=>json_encode(['extenssao'=>$extension])
                ]);
            }*/
            //$lista = _upload::where('token_produto','=',$token_produto)->get();
            if($salvar){
                return response()->json(['Arquivo enviado com sucesso'=>200]);
            }
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
		if (empty($attachment = Atrimestral::find($id))) {
			\Session::flash('flash_danger', 'invalid_record');
			return redirect()->route('admin.b_trimestrals.attachments.index', $parent_id);
		}

		if($attachment->delete()) {
			\Session::flash('flash_sucess', 'record_deleted');
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
