<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\ModelProduto;
use App\Models\ModelProdutoSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProdutoController extends Controller
{
    //Listagem
    public function iindex1(Request $request){
     

      $produtos = ModelProduto::all();
        return view('produtos.index', [
            'menu' => 'produtos',
            '$produtos' => '$produtos'
        ]);
    }

    //LISTAGEM DOS DADOS
    public function index(Request $request)
    {
        // Carregar produtos com relacionamentos para evitar N+1
        $produtos = ModelProduto::with(['relation_series', 'relation_marca', 'relation_estado'])->get();

        return view('produtos.index', [
            'menu' => 'produtos',
            'produtos' => $produtos
        ]);
    }

     public function create()
    {
        return view('produtos.create', ['menu' => 'produtos']);
    }

    public function store(ProdutoRequest $request)
    {
         DB::beginTransaction(); // Inicia a transação
        try {
            // Tratar quantidade
            $quantidade = $request->has_series && $request->series_json
                ? count(json_decode($request->series_json, true))
                : $request->quantidade_prod;

            // Tratar preço KZ$
            $preco = str_replace(['KZ$', '.', ' '], '', $request->preco_kwanza);
            $preco = str_replace(',', '.', $preco);

            // Criar produto
            $produto = ModelProduto::create([
                'designacao_produto' => $request->descricao_produto,
                'descricao_produto'  => $request->descricao_produto,
                'preco_produto'      => (float) $preco,
                'quantidade_produto' => $quantidade,
                'marca_id'           => $request->marca_id,
                'estado_id'          => $request->estado_produto,
                'status'             => true,
            ]);

            // Criar séries
            if ($request->has_series && $request->series_json) {
                $seriesList = json_decode($request->series_json, true);
                foreach ($seriesList as $serie) {
                    ModelProdutoSerie::create([
                        'produto_id'   => $produto->id,
                        'numero_serie' => $serie['serie'],
                        'status'       => true,
                    ]);
                }
            }


        DB::commit(); // Confirma a transação
            return redirect()->route('produto.show', $produto->id)
                             ->with('success', 'Produto cadastrado com sucesso!');

        } catch (\Throwable $th) {
            DB::rollBack(); // Reverte tudo em caso de erro
            Log::error('Erro ao cadastrar produto', ['error' => $th->getMessage()]);
            return back()->withErrors('Erro ao cadastrar produto.');
        }
    }

    // MOSTRAR DETALHES 
    public function show(ModelProduto $produto)
    {
        // Carrega as relações para evitar N+1
       // $produto->load(['marca.categoria', 'relation_series']);
       //dd($produto); exit;

        return view('produtos.show', [
            'menu'    => 'produtos',
            'produto' => $produto
        ]);
    }


}











   

