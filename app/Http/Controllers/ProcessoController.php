<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProcessoRequest;
use App\Models\ModelProcesso;
use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class ProcessoController extends Controller
{
    /* ******************  REGISTAR NO BANCO DE DADOS O PROCESSO       ******************* */


    //LISTAGEM DOS DADOS
    public function index()
    {
        // Carregar processo com relacionamentos para evitar N+1
        $processos = ModelProcesso::with([ 'relation_entidade','ralation_situacao_processo' ])->get();
           
            
      

        return view('processos.index', [
            'menu' => 'processos',
            'processos' => $processos
        ]);
    }

    // MOSTRAR DETALHES 
    public function show(ModelProcesso $processo)
    {
        // Carrega as relações para evitar N+1
        // $produto->load(['marca.categoria', 'relation_series']);
        // Salvar log
        Log::info('Visualizou detalhes do Produto.', ['processo' => $processo->id, 'action_user_id' => Auth::id()]);
        $processo->load(['ralation_situacao_processo', 'relation_entidade']);

        // dd($produto, 'id'); exit;
        // Carregar a view 
        return view('processos.show', [
            'menu'    => 'processo',
            'processo' => $processo
        ]);
    }


    /*                         MOSTRAR PÁGINA DE REGISTRO                                  */
    /* *********************************************************************************** */

    public function create()
    {
        return view('processos.create', [
            'menu' => 'processos'
        ]);
    }


    public function store(ProcessoRequest $request)
    {

        // dd($request); exit;
        //DB::beginTransaction(); // Inicia a transação
        try {
            $processo = ModelProcesso::create([
                'numero_processo' => $request->numero_processo,
                'descricao_processo' => $request->descricao_processo,
                'ano_instrucao' => $request->ano_de_instrucao,
                'data_entrada' => $request->data_de_entrada,
                'situacao_id' => $request->situacao_processo,
                'entidade_id' => $request->entidade_judicial
                //'infracao_id' => $request->infracao
            ]);

            //   DB::commit(); // Confirma a transação
            return redirect()->route('processo.show', $processo->id)->with('success', 'Processo cadastrado com sucesso!');
        } catch (\Exception $e) {
            //  DB::rollBack(); // Reverte tudo em caso de erro
            Log::error('Erro ao cadastrar Processo', ['error' => $e->getMessage()]);
            return back()->withErrors('Erro ao cadastrar Processo.');
        }
    }
}
