<?php

namespace App\Console\Commands;

use App\Jobs\MonitorBlogJobs;
use App\Models\Blog;
use Illuminate\Console\Command;
use Carbon\Carbon;

class MonitorBlogsCommand extends Command
{
    protected $signature = 'blog:monitor {scheduler}';
    protected $description = 'Мониторим все блоги';

    public function handle()
    {
        $scheduler = $this->argument('scheduler');
        if ($scheduler) {
            $now = Carbon::now()->hour;
            foreach ([4, 6, 8] as $monitoring_frequency) {
                if($now % $monitoring_frequency == 0) {
                    Blog::where('monitoring_frequency', $monitoring_frequency)->chunk(100, function ($blogs) {
                        foreach ($blogs as $blog) {
                            MonitorBlogJobs::dispatch($blog);
                        }
                    });
                }
            }
        } else {
            Blog::chunk(100, function ($blogs) {
                foreach ($blogs as $blog) {
                    MonitorBlogJobs::dispatch($blog);
                }
            });
        }
    }
}
