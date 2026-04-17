<?php

namespace App\Repository;

use App\Models\Blog;

class BlogRepository
{
    public function __construct(
        private Blog $blog
    )
    {}

    /**
     * @param int $resourceId
     * @param int $externalId
     * @return ?Blog
     */
    public function getByResourceIdAndExternalId(int $resourceId, int $externalId): ?Blog
    {
        return $this->blog::where('resource_id', $resourceId)->where('external_id', $externalId)->first();
    }

    public function create(array $data): Blog
    {
        return $this->blog::create($data);
    }
}
