<?php

namespace App\Jobs;

use App\Models\Blog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\BlogService;

class MonitorBlogJobs implements ShouldQueue
{
    use Dispatchable;
    use Queueable;

    public function __construct(
        private readonly Blog $blog
    )
    {}

    public function handle(BlogService $blogService): void
    {
        $blogService->monitorBlog($this->blog);
    }
}
