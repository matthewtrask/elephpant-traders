<?php

namespace App\Http\Controllers\Api;

use App\Events\SendAcceptedEmail;
use App\Events\SendTradeEmail;
use App\Http\Requests\Api\TradeRequest;
use App\Repositories\TradeRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
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

        $tradeId = $this->repository->create($request, $user);

        $this->sendTradeEmail($tradeId);

        return $this->response->setStatusCode(201)->setContent('Trade initiated!');
    }

    public function edit(TradeRequest $request)
    {
        $postId = $this->repository->approveTrade($request->getPostId());

        $this->sendAcceptanceEmails($postId);

        return $this->response->setStatusCode(204)->setContent('Trade Approved!');
    }

    public function delete(TradeRequest $request)
    {

    }

    private function sendTradeEmail($tradeId)
    {
        event(new SendTradeEmail($tradeId));
    }

    private function sendAcceptanceEmails($postId)
    {
        event(new SendAcceptedEmail($postId));
    }
}
