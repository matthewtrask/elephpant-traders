<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ElephpantRequest;
use App\Services\S3Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * @var Response
     */
    private $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function create(Request $request)
    {
        $image = $request->file('file');

        Storage::disk('s3')->putFileAs(
            snake_case($request->user()->email()),
            $image,
            $image->getClientOriginalName()
        );

        Storage::disk('s3')->setVisibility(snake_case($request->user()->email()).'/'.$image->getClientOriginalName(), 'public');

        return $this->response->setContent($request->user()->email().'/'. $image->getClientOriginalName());
    }
}
