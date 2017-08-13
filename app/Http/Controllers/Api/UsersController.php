<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
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

    public function show(Request $request)
    {
        $data = $this->repository->fetch($request->user()->userId());

        return $this->response->setContent(fractal($data)->transformWith($this->transformer)->includePosts()->toArray());
    }
}
