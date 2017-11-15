<?php

namespace App\Http\Controllers\Api;

use App\Api\UserTransformer;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
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
     * @var UserTransformer
     */
    private $transformer;

    public function __construct(Response $response, UserRepository $repository, UserTransformer $transformer)
    {
        $this->response = $response;
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function register(RegisterRequest $request)
    {
        $this->repository->create($request);

        return $this->response->setStatusCode(201)->setContent('User created');
    }

    public function create(LoginRequest $request)
    {
        $user = User::findByEmail($request->getEmail())->first();

        $token = $user->createToken('ElephpantTrader')->accessToken;

        return $this->response->setContent(fractal($token)->transformWith($this->transformer)->includeUser()->toArray());
    }
}
