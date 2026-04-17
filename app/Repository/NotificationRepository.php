<?php

namespace App\Repository;

use App\Models\Notification;

class NotificationRepository
{
    public function __construct(
        private Notification $notification
    )
    {}

    public function create(array $data): Notification
    {
        return $this->notification::create($data);
    }
}
