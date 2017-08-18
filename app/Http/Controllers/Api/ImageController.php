<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\S3Service;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    /**
     * @var S3Service
     */
    private $service;

    /**
     * @var Response
     */
    private $response;

    public function __construct(S3Service $service, Response $response)
    {
        $this->service = $service;
        $this->response = $response;
    }

    public function create(Request $request)
    {
        $image = $request->elephpant->store(env('AWS_BUCKET'), 's3');

        return $this->response->setContent($image);
    }
}
