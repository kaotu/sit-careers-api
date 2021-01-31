<?php

namespace App\Http\Controllers;

use Validator;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;
use App\Repositories\AnnouncementRepositoryInterface;
use App\Http\RulesValidation\AnnouncementRules;


class AnnouncementController extends Controller
{
    use AnnouncementRules;
    private $announcement;

    public function __construct(AnnouncementRepositoryInterface $announcement_repo)
    {
        $this->announcement = $announcement_repo;
    }

    public function get(Request $request)
    {
        $id = $request->all();
        $validated = Validator::make($id, $this->rulesGetAnnouncementById);
        if ($validated->fails()) {
            return response()->json($validated->messages(), 400);
        }
        $announcement = $this->announcement->getAnnouncementById($id['announcement_id']);
        return response()->json($announcement, 200);
    }

    public function getAnnouncements(Request $request)
    {
        $announcements = $request->all();
        $announcements = $this->announcement->getAllAnnouncements();
        return response()->json($announcements, 200);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $validated = Validator::make($data, $this->rulesCreationAnnouncement);
        if ($validated->fails()) {
            return response()->json($validated->messages(), 400);
        }
        $announcements = $this->announcement->createAnnouncement($data);
        return response()->json($announcements, 200);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $validated = Validator::make($data, $this->rulesUpdateAnnouncementById);
        // dd($validated);
        if ($validated->fails()) {
            return response()->json($validated->messages(), 400);
        }
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
