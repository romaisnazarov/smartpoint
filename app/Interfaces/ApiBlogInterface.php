<?php

namespace App\Interfaces;

use App\Models\Blog;

interface ApiBlogInterface
{
    public function getBlogMeta(string $externalId): array;
    public function getPosts(Blog $blog): array;
}
