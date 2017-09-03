<?php

namespace App\Services;

use Aws\S3\S3Client;

class S3Service
{
    public function client() : S3Client
    {
        $options = [
            'region'            => 'us-west-2',
            'version'           => '2006-03-01',
            'signature_version' => 'v4',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY'),
                'secret' => env('AWS_SECRET_KEY')
            ]
        ];

        $client = new S3Client($options);

        return $client;
    }
}
