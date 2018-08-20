<?php

namespace App\Services;

use App\Models\ValidationProduto;
use App\Repositories\ProdutoRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProdutoService
{
    private $produtoRepository;


    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->produtoRepository = $produtoRepository;
    }


    public function getAll()
    {

        $produtos = $this->produtoRepository->getAll();

        try {
            if (count($produtos) > 0) {
                return response()->json($produtos, Response::HTTP_OK);
            } else {
                return response()->json([], Response::HTTP_OK);
            }
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function get($id)
    {
        try {
            $produto = $this->produtoRepository->get($id);

            if (!is_null($produto)) {
                return response()->json($produto, Response::HTTP_OK);
            } else {
                return response()->json(null, Response::HTTP_OK);
            }
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        
        

        $validator = Validator::make(
            $request->all(),
            ValidationProduto::RULES_PRODUTO
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {
                $produto = $this->produtoRepository->store($request);
                return response()->json($produto, Response::HTTP_CREATED);
                

            } catch (QueryException $exception) {
                return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

    }

    public function update($id, Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ValidationProduto::RULES_PRODUTO
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        } else {
            try {
                $produto = $this->produtoRepository->update($id, $request);
                return response()->json($produto, Response::HTTP_OK);
            } catch (QueryException $exception) {
                return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }


    }

    public function destroy($id)
    {
        try {
           $this->produtoRepository->destroy($id);

            return response()->json(null, Response::HTTP_OK);
        } catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexão com o banco de dados'], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

}