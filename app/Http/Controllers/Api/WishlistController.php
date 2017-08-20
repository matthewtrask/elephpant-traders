<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\WishlistRequest;
use App\Repositories\WishlistRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class WishlistController extends Controller
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var WishlistRepository
     */
    private $repository;

    public function __construct(Response $response, WishlistRepository $repository)
    {
        $this->response = $response;
        $this->repository = $repository;
    }

    public function create(WishlistRequest $request)
    {
        if ($request->has('token') && !is_null($request->token)) {
            $user = User::findByEmail(JWTAuth::parseToken()->toUser()->email)->first();
            \Auth::setUser($user);
        }

        $this->repository->create($request, $user->userId());

        return $this->response->setContent('Elephpant added to wishlist');
    }

    public function destroy(Request $request) : Response
    {
        $this->repository->delete($request);

        return $this->response->setContent('Deleted item ' . $request->id);
    }
}
