<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\Announcement;
use App\Models\JobType;
use Carbon\Carbon;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    public function getAllAnnouncements()
    {
        $announcement = DB::table('announcements')
        ->join('job_positions', 'job_positions.job_position_id', '=', 'announcements.job_position_id')
        ->join('job_types', 'job_types.announcement_id', '=', 'announcements.announcement_id')
        ->get();
        return $announcement;
    }

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
        $announcement->salary = $data['salary'];
        $announcement->welfare = $data['welfare'];
        $announcement->status = $data['status'];
        $announcement->save();

        $jobType = new JobType();
        $jobType->announcement_id = $announcement->announcement_id;
        $jobType->job_type = $data['job_type'];
        $jobType->save();

        return array_merge($announcement->toArray(), $jobType->toArray());
    }

    public function updateAnnouncement($data)
    {
        $announcement = Announcement::find($data['announcement_id']);

        $announcement->announcement_title = $data['announcement_title'];
        $announcement->job_description = $data['job_description'];
        $announcement->job_position_id = $data['job_position_id'];
        $announcement->property = $data['property'];
        $announcement->picture = $data['picture'];
        $announcement->start_date = $data['start_date'];
        $announcement->end_date = $data['end_date'];
        $announcement->salary = $data['salary'];
        $announcement->welfare = $data['welfare'];
        $announcement->status = $data['status'];
        $announcement->updated_at = Carbon::now();
        $announcement->save();

        $jobType = JobType::where('announcement_id', $data['announcement_id'])->first();
        $jobType->job_type = $data['job_type'];
        $announcement->updated_at = Carbon::now();
        $jobType->save();

        return array_merge($announcement->toArray(), $jobType->toArray());
    }

    public function deleteAnnouncementById($id)
    {
        $announcement = Announcement::find($id)->first();

        $jobType = JobType::where('announcement_id', $id)->first();;

        if($announcement && $jobType){
            $deleted_announcement = $announcement->delete();
            $deleted_jobType = $jobType->delete();
            return $deleted_announcement && $deleted_jobType;
        }

        return "Find not found announcement or job type.";
    }
}
