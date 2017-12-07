<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ElephpantRequest;
use App\Services\S3Service;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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

    public function create(ElephpantRequest $request)
    {
        $image = $request->image;

        Storage::disk('s3')->put('elephpant', $image);

        return $this->response->setContent($image);
    }
}
