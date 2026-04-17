<?php

namespace App\Repository;

use App\Models\Post;

class PostRepository
{
    public function __construct(
        private Post $post,
    )
    {}

    /**
     * @param array $data
     * @return mixed
     */
    public function upsert(array $data)
    {
        return $this->post->upsert($data, ['external_id', 'blog_id'], ['title', 'content', 'rating', 'reactions']);
    }
}
