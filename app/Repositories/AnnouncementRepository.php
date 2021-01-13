<?php

namespace App\Repositories;

use App\Models\Announcement;
use App\Models\JobPosition;
use App\Models\JobType;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    public function createAnnouncement($data)
    {
        $announcement = new Announcement();
        $announcement->company_id = $data['company_id'];
        $announcement->announcement_title = $data['announcement_title'];
        $announcement->job_description = $data['job_description'];
        $announcement->job_position_id = $data['job_position_id'];
        $announcement->property = $data['property'];
        $announcement->picture = $data['picture'];
        $announcement->start_date = $data['start_date'];
        $announcement->end_date = $data['end_date'];
        $announcement->welfare = $data['welfare'];
        $announcement->status = $data['status'];
        $announcement->save();

        return array_merge($announcement->toArray());
    }
}
