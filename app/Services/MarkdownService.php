<?php
/**
 * Created by PhpStorm.
 * User: trask
 * Date: 8/7/17
 * Time: 10:58 PM
 */

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