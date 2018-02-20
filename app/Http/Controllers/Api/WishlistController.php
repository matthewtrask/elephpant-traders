<?php

namespace App\Http\Controllers\Api;

use App\Api\WantedTransformer;
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

    /**
     * @var WantedTransformer
     */
    private $transformer;

    public function __construct(Response $response, WishlistRepository $repository, WantedTransformer $transformer)
    {
        $this->response = $response;
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function index()
    {
        $elephpants = $this->repository->get();

        $this->response->setStatusCode(200)->setContent(fractal($elephpants)->transformWith($this->transformer)->toArray());
    }

    public function create(WishlistRequest $request)
    {
        $this->repository->create($request, $request->user()->userId()->toInteger());

        return $this->response->setContent('Elephpant added to wishlist');
    }

    public function destroy(Request $request) : Response
    {
        $this->repository->delete($request);

        return $this->response->setContent('Deleted item ' . $request->id);
    }
}
