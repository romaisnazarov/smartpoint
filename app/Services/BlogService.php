<?php

namespace App\Services;

use App\Interfaces\ApiBlogInterface;
use App\Models\Blog;
use App\Repository\PostRepository;
use App\Repository\NotificationRepository;

class BlogService
{
    public function __construct(
        public ApiBlogInterface $apiBlog,
        public PostRepository $postRepository,
        public NotificationRepository $notificationRepository
    )
    {}

    public function monitorBlog(Blog $blog): void
    {
        $meta = $this->apiBlog->getBlogMeta($blog->external_id);
        $postsData = $this->apiBlog->getPosts($blog);

        $blog->update([
            'name' => $meta['name'],
            'rating' => $meta['rating'],
            'cat_name' => $meta['cat_name'],
            'author' => $meta['author']
        ]);

        $blog->load('posts');
        $existPostIds = $blog->posts->pluck('id')->toArray();

        $this->postRepository->upsert($postsData);
        $externalPostIds = array_column($postsData, 'external_id');
        $blog->posts()
            ->whereNotIn('external_id', $externalPostIds)
            ->delete();

        $this->notificationRepository->create([
            'blog_id' => $blog->id,
            'date' => now(),
            'new_posts' => array_diff($externalPostIds, $existPostIds)
        ]);
    }
}
