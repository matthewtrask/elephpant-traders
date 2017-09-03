<?php

namespace App\Services;

use League\CommonMark\CommonMarkConverter;

class MarkdownService
{
    public function convertMarkdown(string $post) : CommonMarkConverter
    {
        $html = new CommonMarkConverter();

        $html->convertToHtml($post);

        return $html;
    }
}
