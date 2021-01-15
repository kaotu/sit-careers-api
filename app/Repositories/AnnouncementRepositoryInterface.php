<?php

namespace App\Repositories;

interface AnnouncementRepositoryInterface
{
    public function getAllAnnouncements();
    public function createAnnouncement($data);
}
