<?php

namespace App\Http\Controllers;

use App\Services\ProdutoService;
use Illuminate\Http\Request;


class ProdutoController extends Controller
{
    private $produtoService;

    public function __construct(ProdutoService $produtoService)
    {
        $this->produtoService = $produtoService;
    }


    public function getAll()
    {
        return $this->produtoService->getAll();

    }

    public function get($id)
    {
        return $this->produtoService->get($id);
    }


    public function store(Request $request)
    {
        //dd($request);
        return $this->produtoService->store($request);
    }

    public function update($id, Request $request)
    {
        return $this->produtoService->update($id, $request);

    }

    public function destroy($id)
    {
        return $this->produtoService->destroy($id);
    }


}
