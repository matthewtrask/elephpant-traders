<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SellersController extends Controller
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var SellerTransformer
     */
    private $transformer;

    public function __construct(Response $response, UserRepository $repository, SellerTransformer $transformer)
    {
        $this->response = $response;
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function create()
    {

    }

    public function show(Request $request)
    {
        $data = $this->repository->fetch($request->id);

        return $this->response->setContent(
            fractal($data)->transformWith($this->transformer)->includePosts()->includeWishlist()->toArray()
        );
    }
}
