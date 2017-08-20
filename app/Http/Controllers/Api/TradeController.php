<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\TradeRequest;
use App\Repositories\TradeRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class TradeController extends Controller
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var TradeRepository
     */
    private $repository;

    public function __construct(Response $response, TradeRepository $repository)
    {
        $this->response = $response;
        $this->repository = $repository;
    }

    public function create(TradeRequest $request)
    {
        $user = User::findByEmail(JWTAuth::parseToken()->toUser()->email)->first();

        \Auth::setUser($user);

        $this->repository->create($request, $user);

        return $this->response->setStatusCode(201)->setContent('Trade initiated!');
    }
}
