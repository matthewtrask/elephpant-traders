<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use App\Services\MarkdownService;

class PostRepository
{
    /**
     * @var Post
     */
    private $post;

    /**
     *
     */
    private $service;

    public function __construct(Post $post, MarkdownService $service)
    {
        $this->post = $post;
        $this->service = $service;
    }

    public function get() : Collection
    {
        return $this->post->all();
    }

    public function fetch(int $id) : Collection
    {
        return $this->post->byId($id)->get();
    }

    public function create($data)
    {
        $post = new Post();

        $post->title = $data->getTitle();
        $post->seller_id = $data->getUserId();
        $post->description = $this->service->convertMarkdown($data->getDescription());
        $post->image_link = $data->getImageUrl();

        return $post->save();
    }

    public function destroy(int $id)
    {
        $post = $this->post->find($id);

        return $post->delete();
    }
}
