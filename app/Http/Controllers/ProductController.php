<?php

namespace App\Http\Controllers;

use App\Models\Product; // Importa o Model
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Listar todos os produtos. (API)
     */
    public function index()
    {
        // Retorna todos os produtos como JSON e código 200 (OK)
        return response()->json(Product::all(), 200);
    }

    /**
     * Criar um novo produto. (API)
     */
    public function store(Request $request)
    {
        // ----- VALIDAÇÃO (Requisito 3) -----
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);
        
        // Cria o produto e retorna os dados + código 201 (Created)
        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    /**
     * Mostrar um produto específico. (API)
     */
    public function show(Product $product)
    {
        // O Laravel automaticamente encontra o produto pelo ID
        return response()->json($product, 200);
    }

    /**
     * Atualizar um produto. (API)
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
        ]);
        
        // Atualiza o produto que o Laravel encontrou
        $product->update($validatedData);
        return response()->json($product, 200);
    }

    /**
     * Excluir um produto. (API)
     */
    public function destroy(Product $product)
    {
        // Deleta o produto
        $product->delete();
        
        // Retorna uma resposta vazia com código 204 (No Content)
        return response()->json(null, 204);
    }

    // -----------------------------------------------------------------
    // ----- FUNÇÕES WEB (PARA O NAVEGADOR) -----
    // -----------------------------------------------------------------

    /**
     * Mostrar todos os produtos em uma página web (Blade).
     */
    public function showWeb()
    {
        $products = Product::all(); // Pega todos os produtos do banco
        return view('products', ['products' => $products]);
    }

    /**
     * 1. Mostrar o formulário de criação (web).
     */
    public function createWeb()
    {
        return view('create');
    }

    /**
     * 2. Salvar o novo produto (vindo do formulário web).
     */
    public function storeWeb(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($validatedData); 

        // ----- CORRIGIDO AQUI -----
        return redirect()->route('web.products.index'); // Redireciona para a lista WEB
    }

    /**
     * 3. Mostrar o formulário de edição (web).
     */
    public function editWeb(Product $product)
    {
        return view('edit', ['product' => $product]);
    }

    /**
     * 4. Atualizar o produto (vindo do formulário web).
     */
    public function updateWeb(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($validatedData);

        // ----- CORRIGIDO AQUI -----
        return redirect()->route('web.products.index'); // Redireciona para a lista WEB
    }

    /**
     * 5. Deletar um produto (vindo do botão web).
     */
    public function destroyWeb(Product $product)
    {
        $product->delete();
        
        // ----- CORRIGIDO AQUI -----
        return redirect()->route('web.products.index'); // Redireciona para a lista WEB
    }

} // <-- Fim da classe