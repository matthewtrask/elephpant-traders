<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository
{
    /**
     * @var Post
     */
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
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
        $post->description = $data->getDescription();
        $post->seller_id = $data->getUserId();
        $post->image_link = $data->getImageUrl();

        return $post->save();
    }

    public function destroy(int $id)
    {
        $post = $this->post->find($id);

        return $post->delete();
    }
}
