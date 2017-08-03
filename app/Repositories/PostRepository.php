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

    }

    public function update($data)
    {

    }

    public function destroy(int $id)
    {

    }
}