<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;
use App\Repositories\AnnouncementRepositoryInterface;

class AnnouncementController extends Controller
{
    private $announcement;

    public function __construct(AnnouncementRepositoryInterface $announcement_repo)
    {
        $this->announcement = $announcement_repo;
    }

    public function get(Request $request)
    {
        //Get id from QueryString
        $id = $request['announcement_id'];
        $announcement = $this->announcement->getAnnouncementById($id);
        return response()->json($announcement, 200);

        //Get id from body
        // $id = $request->all();
        // $announcement = $this->announcement->getAnnouncementById($id['announcement_id']);
        // return response()->json($announcement, 200);
    }

    public function getAnnouncements(Request $request)
    {
        $announcement = $request->all();
        $announcement = $this->announcement->getAllAnnouncements();
        return response()->json($announcement, 200);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $announcements = $this->announcement->createAnnouncement($data);
        return response()->json($announcements, 200);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $announcement_updated = $this->announcement->updateAnnouncement($data);
        return response()->json($announcement_updated, 200);
    }

    public function destroy(Request $request)
    {
        $id = $request->all(['announcement_id']);
        $announcement_deleted = $this->announcement->deleteAnnouncementById($id);
        return response()->json($announcement_deleted, 200);
    }
}
