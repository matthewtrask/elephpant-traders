<?php

namespace Tests\Feature\app\Service;

use App\Services\MarkdownService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MarkdownServiceTest extends TestCase
{
    /**
     * @var MarkdownService
     */
    private $service;

    public function setup()
    {
        $this->service = new MarkdownService();
    }

    public function testCanGetInstance()
    {
        $this->assertInstanceOf(MarkdownService::class, $this->service);
    }

    public function testServiceCanConvertMarkDown()
    {
        $string = '### Hello World!';

        $html = $this->service->convertMarkdown($string);

        $this->assertContains('<h3>', $html);
    }
}
