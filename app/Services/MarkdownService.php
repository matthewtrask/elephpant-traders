<?php

namespace App\Services;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;

class MarkdownService
{
    public function convertMarkdown(string $post)
    {
        $environment = Environment::createCommonMarkEnvironment();

        $parser = new DocParser($environment);

        $htmlRenderer = new HtmlRenderer($environment);

        $document = $parser->parse($post);

        return $htmlRenderer->renderBlock($document);
    }
}
