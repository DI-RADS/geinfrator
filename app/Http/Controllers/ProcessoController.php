<?php

namespace App\Http\Controllers;

use App\Http\Requests\HistoricoSitProcessoRequest;
use App\Http\Requests\ProcessoRequest;
use App\Models\ModelHistoricoSitProcesso;
use App\Models\ModelProcesso;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

#use Illuminate\Container\Attributes\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Termwind\Components\Dd;

class ProcessoController extends Controller
{
    /* ******************  REGISTAR NO BANCO DE DADOS O PROCESSO       ******************* */


    //LISTAGEM DOS DADOS
    public function index()
    {

        // Carregar processo com relacionamentos para evitar N+1
        $processos = ModelProcesso::with(['relation_situacaoAtual', 'relation_entidade', 'relation_historico_situacoes.relation_situacao'])->get();
        //dd($processos->toArray()); exit;
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
        $processo->load(['relation_situacaoAtual', 'relation_entidade', 'relation_historico_situacoes.relation_situacao']);

        // dd($produto, 'id'); exit;
        // Carregar a view 
        return view('processos.show', [
            'menu'    => 'processo',
            'processo' => $processo
        ]);
    }

    // EDITAR DETALHES PROCESSO  
    public function edit(ModelProcesso $processo)
    {
        return view('processos.edit', [
            'menu' => 'processos',
            'processo' => $processo
        ]);
    }
    public function update(ProcessoRequest $request, ModelProcesso $processo)
    {
        // dd($processo); exit;
        DB::beginTransaction(); // Inicia a transação
        try {
            $processo->update([
                'numero_processo' => $request->numero_processo,
                'situacao_id' => $request->situacao_processo, // <- select
                'ano_instrucao' => $request->ano_de_instrucao,
                'data_entrada' => $request->data_de_entrada,
                'entidade_id' => $request->entidade_judicial, //  name do select
                'descricao_processo' => $request->descricao_processo
            ]);
            DB::commit(); // Confirma a transação
            return redirect()->route('processo.show', $processo->id)->with('success', 'Processo actualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack(); // Reverte tudo em caso de erro
            Log::error('Erro ao editar Processo', ['error' => $e->getMessage()]);
            return back()->withErrors('Erro ao editar Processo.');
        }
    }

    // EDITAR ELIMINAR PROCESSO  
    public function destroy(ModelProcesso $processo)
    {
        DB::beginTransaction();
        try {
            $processo->delete();
            DB::commit();

            Log::info('excluido com sucesso.', ['processo_id' => $processo->id, 'user_id' => Auth::id()]);

            return redirect()->route('processos.index')->with('success', 'Processo excluído com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Erro ao excluir Processo', ['error' => $e->getMessage(), 'user_id' => Auth::id()]);
            return back()->withErrors('Erro ao excluir Processo.');
        }
    }

    public function altsituacaoprocesso(HistoricoSitProcessoRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $processo = ModelProcesso::findOrFail($id);

            // Atualizar situação atual
            $processo->update([
                'situacao_id' => $request->situacao_processo_id
            ]);

            // Histórico
            ModelHistoricoSitProcesso::create([
                'processo_id'          => $processo->id,
                'situacao_processo_id' => $request->situacao_processo_id,
                'motivo_alteracao'     => $request->motivo_alteracao,
                'data_alt_situacao'    => $request->data_alt_situacao ?? now()->toDateString(),
            ]);

            DB::commit();

            Log::info('Situação do processo alterada.', ['processo_id' => $processo->id, 'user_id' => Auth::id()]);

            return redirect()->route('processo.show', $processo->id)->with('success', 'Situação alterada com sucesso!');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Erro ao alterar situação do processo.', ['error'   => $e->getMessage(), 'user_id' => Auth::id()]);

            return back()->withInput()->with('error', 'Não foi possível alterar a situação.');
        }
    }

    /*                      MOSTRAR PÁGINA DE REGISTRO                                      */
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
        DB::beginTransaction(); // Inicia a transação
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

            DB::commit(); // Confirma a transação
            return redirect()->route('processo.show', $processo->id)->with('success', 'Processo cadastrado com sucesso!');
        } catch (\Exception $e) {
            DB::rollBack(); // Reverte tudo em caso de erro
            Log::error('Erro ao cadastrar Processo', ['error' => $e->getMessage()]);
            return back()->withErrors('Erro ao cadastrar Processo.');
        }
    }

    /*                      GERAR PDF DOS PROCESSOS                                         */
    /* *********************************************************************************** */

    public function pdfIndexProcessos()
    {
        $processos = ModelProcesso::all();
       // dd($processos->toArray());
       // exit;
        try {
            // Buscar todos os processos
            // mesma consulta da página index
            $processos = ModelProcesso::with([
                'relation_situacaoAtual',
                'relation_entidade',
                'relation_historico_situacoes.relation_situacao'
            ])->get();


            // Limite de registros
            $numberRecordsAllowed = 500;
            if ($processos->count() > $numberRecordsAllowed) {
                Log::notice("Limite de registros ultrapassado para gerar PDF. Limite: $numberRecordsAllowed", ['action_user_id' => Auth::id()]);
                return back()->withInput()->with('error', "Limite de registros ultrapassado para gerar PDF. Limite: $numberRecordsAllowed registros!");
            }

            // Gerar PDF
            $pdf = Pdf::loadView('processos.pdf-index', ['processos' => $processos])
                ->setPaper('a4', 'portrait');

            return $pdf->stream('lista_geral_processos.pdf'); // abrir no navegador
        } catch (\Exception $e) {
            Log::notice('PDF dos processos não gerado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);
            return back()->withInput()->with('error', 'PDF dos processos não gerado!');
        }
    }


    public function pdfIndexprocessosd(Request $request)
    {
        try {
            // Buscar todos os processos
            $processos = ModelProcesso::all();

            // Somar total de registros
            $totalRecords = $processos->count('id');

            // Verificar se a quantidade de registros ultrapassa o limite para gerar PDF
            $numberRecordsAllowed = 500;
            if ($totalRecords > $numberRecordsAllowed) {
                // Salvar log
                Log::notice("Limite de registros ultrapassado para gerar PDF. O limite é de $numberRecordsAllowed registros.", ['action_user_id' => Auth::id()]);

                // Redirecionar o usuário, enviar a mensagem de erro
                return back()->withInput()->with('error', "Limite de registros ultrapassado para gerar PDF. O limite é de $numberRecordsAllowed registros!");
            }

            // Carregar a string com o HTML/conteúdo e determinar a orientação e o tamanho do arquivo
            $pdf = Pdf::loadView('processos.pdf-index', ['processos' => $processos])->setPaper('a4', 'portrait');

            // Fazer o download do arquivo
            return $pdf->stream('lista_geral_processos.pdf');
        } catch (\Exception $e) {
            //throw $e;
            // Salvar log
            Log::notice('PDF dos usuários não gerado.', ['error' => $e->getMessage(), 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de erro
            return back()->withInput()->with('error', 'PDF dos processos não gerado!');
        }
    }
}
