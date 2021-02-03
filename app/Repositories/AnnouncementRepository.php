<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\Address;
use App\Models\Announcement;
use App\Models\JobType;
use Carbon\Carbon;

class AnnouncementRepository implements AnnouncementRepositoryInterface
{
    public function getAnnouncementById($id)
    {
        $announcement = Announcement::join('job_positions', 'job_positions.job_position_id', '=', 'announcements.job_position_id')
                        ->join('job_types', 'job_types.announcement_id', '=', 'announcements.announcement_id')
                        ->join('addresses', 'addresses.address_id', '=', 'announcements.address_id')
                        ->where('announcements.announcement_id', $id)
                        ->first();
        return $announcement;
    }

    public function getAllAnnouncements()
    {
        $announcements = Announcement::join('addresses', 'addresses.address_id', '=', 'announcements.address_id')
                        ->join('job_types', 'job_types.announcement_id', '=', 'announcements.announcement_id')
                        ->join('job_positions', 'job_positions.job_position_id', '=', 'announcements.job_position_id')
                        ->where('addresses.address_type', 'announcement')
                        ->get();
        return $announcements;
    }

    public function createAnnouncement($data)
    {
        $address = new Address();
        $address->address_one = $data['address_one'];
        $address->address_two = $data['address_two'] == "" ? "-": $data['address_two'];
        $address->lane = $data['lane'] == "" ? "-": $data['lane'];
        $address->road = $data['road'] == "" ? "-": $data['road'];
        $address->sub_district = $data['sub_district'];
        $address->district = $data['district'];
        $address->province = $data['province'];
        $address->postal_code = $data['postal_code'];
        $address->address_type = 'announcement';
        $address->company_id =  $data['company_id'];
        $address->save();

        $announcement = new Announcement();
        $announcement->company_id = $data['company_id'];
        $announcement->address_id = $address->address_id;
        $announcement->announcement_title = $data['announcement_title'];
        $announcement->job_description = $data['job_description'];
        $announcement->job_position_id = $data['job_position_id'];
        $announcement->property = $data['property'];
        $announcement->picture = $data['picture'] == "" ? "-": $data['picture'];
        $announcement->start_date = $data['start_date'];
        $announcement->end_date = $data['end_date'];
        $announcement->salary = $data['salary'];
        $announcement->welfare = $data['welfare'];
        $announcement->status = $data['status'];
        $announcement->start_business_day = $data['start_business_day'];
        $announcement->end_business_day = $data['end_business_day'];
        $announcement->start_business_time = $data['start_business_time'];
        $announcement->end_business_time = $data['end_business_time'];
        $announcement->save();

        $jobType = new JobType();
        $jobType->announcement_id = $announcement->announcement_id;
        $jobType->job_type = $data['job_type'];
        $jobType->save();

        return array_merge($announcement->toArray(), $jobType->toArray(), $address->toArray());
    }

    public function updateAnnouncement($data)
    {
        $announcement = Announcement::find($data['announcement_id']);

        $announcement->announcement_title = $data['announcement_title'];
        $announcement->job_description = $data['job_description'];
        $announcement->job_position_id = $data['job_position_id'];
        $announcement->property = $data['property'];
        $announcement->picture = $data['picture'] == "" ? "-": $data['picture'];
        $announcement->start_date = $data['start_date'];
        $announcement->end_date = $data['end_date'];
        $announcement->salary = $data['salary'];
        $announcement->welfare = $data['welfare'];
        $announcement->status = $data['status'];
        $announcement->start_business_day = $data['start_business_day'];
        $announcement->end_business_day = $data['end_business_day'];
        $announcement->start_business_time = $data['start_business_time'];
        $announcement->end_business_time = $data['end_business_time'];
        $announcement->updated_at = Carbon::now();
        $announcement->save();

        $jobType = JobType::where('announcement_id', $data['announcement_id'])->first();
        $jobType->job_type = $data['job_type'];
        $jobType->save();

        $address = Address::where('address_type', 'announcement')
                ->where('address_id', $data['address_id'])->first();
        $address->address_one = $data['address_one'];
        $address->address_two = $data['address_two'] == "" ? "-": $data['address_two'];
        $address->lane = $data['lane'] == "" ? "-": $data['lane'];
        $address->road = $data['road'] == "" ? "-": $data['road'];
        $address->sub_district = $data['sub_district'];
        $address->district = $data['district'];
        $address->province = $data['province'];
        $address->postal_code = $data['postal_code'];
        $address->save();

        return array_merge($announcement->toArray(), $jobType->toArray(), $address->toArray());
    }

    public function deleteAnnouncementById($id)
    {
        $announcement = Announcement::find($id)->first();

        $jobType = JobType::where('announcement_id', $id)->first();
        $address = Address::where('address_id', $announcement->address_id)->first();

        if($announcement && $jobType && $address){
            $deleted_address = $address->delete();
            $deleted_announcement = $announcement->delete();
            $deleted_jobType = $jobType->delete();
            return $deleted_announcement && $deleted_jobType && $deleted_address;
        }

        return "Find not found announcement or job type or address or business day.";
    }
}
