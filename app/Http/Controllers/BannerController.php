<?php

namespace App\Http\Controllers;

use App\Repositories\BannerRepositoryInterface;
use Illuminate\Http\Request;

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

}
