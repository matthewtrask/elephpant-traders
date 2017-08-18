<?php

namespace App\Http\Controllers\Api;

use App\Api\PostTransformer;
use App\Http\Requests\Api\ElephpantRequest;
use App\Http\Requests\Api\PostRequest;
use App\Http\Requests\Api\RemoveElephpantRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PostingsController extends Controller
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var PostRepository
     */
    private $repository;

    /**
     * @var PostTransformer
     */
    private $transformer;

    public function __construct(Response $response, PostRepository $repository, PostTransformer $transformer)
    {
        $this->response = $response;
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = $this->repository->get();

        return $this->response->setContent(fractal($listings)->transformWith($this->transformer)->toArray());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = $this->repository->fetch($request->id);

        return $this->response->setContent(fractal($data)->transformWith($this->transformer)->includeWanted()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param PostRequest $request
     */
    public function create(PostRequest $request)
    {
        $post = $this->repository->create($request);

        return $this->response->setContent('Post was created');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->repository->destroy($id);

        return $this->response->setStatusCode(204)->setContent('Deleted');
    }
}
