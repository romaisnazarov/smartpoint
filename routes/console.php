<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Schedule::call(function () {
    Artisan::call('blog:monitor', [
        'scheduler' => 'true',
    ]);
});
