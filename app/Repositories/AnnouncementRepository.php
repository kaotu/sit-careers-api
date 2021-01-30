<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\Announcement;
use App\Models\BusinessDays;
use App\Models\JobPosition;
use App\Models\JobType;
use Carbon\Carbon;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    public function getAnnouncementById($id)
    {
        $announcement = Announcement::join('job_positions', 'job_positions.job_position_id', '=', 'announcements.job_position_id')
                        ->join('job_types', 'job_types.announcement_id', '=', 'announcements.announcement_id')
                        ->join('business_days', 'business_days.company_id', '=', 'announcements.company_id')
                        ->where('announcements.announcement_id', $id)
                        ->first();
        return $announcement;
    }

    public function getAllAnnouncements()
    {
        $announcements = Announcement::join('job_positions', 'job_positions.job_position_id', '=', 'announcements.job_position_id')
                        ->join('job_types', 'job_types.announcement_id', '=', 'announcements.announcement_id')
                        ->join('business_days', 'business_days.company_id', '=', 'announcements.company_id')
                        ->get();
        return $announcements;
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

        $businessDay = new BusinessDays();
        $businessDay->company_id = $announcement->company_id;
        $businessDay->business_day_type = $data['business_day_type'];
        $businessDay->start_business_day = $data['start_business_day'];
        $businessDay->end_business_day = $data['end_business_day'];
        $businessDay->start_business_time = $data['start_business_time'];
        $businessDay->end_business_time = $data['end_business_time'];
        $businessDay->save();

        return array_merge($announcement->toArray(), $jobType->toArray(), $businessDay->toArray());
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
        $jobType->save();

        $businessDay = BusinessDays::where('company_id', $data['company_id'])->first();
        $businessDay->start_business_day = $data['start_business_day'];
        $businessDay->end_business_day = $data['end_business_day'];
        $businessDay->start_business_time = $data['start_business_time'];
        $businessDay->end_business_time = $data['end_business_time'];
        $businessDay->save();

        return array_merge($announcement->toArray(), $jobType->toArray(), $businessDay->toArray());
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
