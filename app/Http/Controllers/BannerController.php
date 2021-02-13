<?php

namespace App\Http\Controllers;

use Storage;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;
use App\Repositories\BannerRepositoryInterface;

class BannerController extends Controller
{
    private $banner;

    public function __construct(BannerRepositoryInterface $banner_repo)
    {
        $this->banner = $banner_repo;
    }

    public function get(Request $request)
    {
        $banners = $request->all();
        $banners = $this->banner->getAllBanners();
        return response()->json($banners, 200);
    }

    public function getBannerById(Request $request)
    {
        $id = $request->all();
        $banner = $this->banner->getBannerById($id['banner_id']);
        return response()->json($banner, 200);
    }

    public function create(Request $request)
    {
        $data = request()->all();
        $s3 = Storage::disk('s3');
        $bannerName = time(). '.' . $data['file_banner']->getClientOriginalName();
        $file = $request->file('file_banner');
        if (!is_null($file)) {
            $uploaded = $s3->put('/banner/'.$bannerName, file_get_contents($file), 'public');
            $data['path_image'] = $bannerName;
        }
        $banner = $this->banner->createBanner($data);
        return response()->json($banner, 200);
    }
}
