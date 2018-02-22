<?php

namespace App\Http\Controllers\Api;

use App\Api\CountTransformer;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CountController extends Controller
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var CountTransformer
     */
    private $transformer;

    public function __construct(Response $response, CountTransformer $transformer)
    {
        $this->response = $response;
        $this->transformer = $transformer;
    }

    public function index() : Response
    {
        $post = Post::all();

        return $this->response->setStatusCode(200)->setContent(fractal($post)->transformWith($this->transformer)->toArray());
    }
}
