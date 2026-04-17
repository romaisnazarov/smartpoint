<?php

namespace App\Services\ApiBlog;

use App\Interfaces\ApiBlogInterface;
use App\Models\Blog;
use Illuminate\Support\Facades\Cache;

class MockApiBlogService implements ApiBlogInterface
{
    public function getBlogMeta(string $externalId): array
    {
        return Cache::remember('blog_'.$externalId, 600, function () use ($externalId) {
            return [
                'name' => 'Blog ' . $externalId,
                'rating' => rand(1, 10),
                'cat_name' => 'Whiskers',
                'author' => 'John Doe'
            ];
        });
    }

    public function getPosts(Blog $blog): array
    {
        $posts = [];
        for ($i = 0; $i < rand(5, 15); $i++) {
            $posts[] = [
                'blog_id' => $blog->id,
                'external_id' => uniqid(),
                'title' => 'Post ' . $i,
                'content' => 'Content ' . $i,
                'rating' => rand(1, 10),
                'reactions' => json_encode(['❤️' => rand(0, 100), '😂' => rand(0, 50)])
            ];
        }

        return Cache::remember('posts_blog_'.$blog->id, 600, function () use ($posts) {
            return $posts;
        });
    }
}
