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

    public function getAnnouncements(Request $request)
    {
        $id = $request->all();
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
        $announcement = $this->announcement->updateAnnouncement($data);
        return response()->json($announcement, 200);
    }
}
