<?php

namespace App\Repositories;

use App\Models\Banner;

class BannerRepository implements BannerRepositoryInterface
{
    public function getBannerById($id)
    {
        $banner = Banner::where('banner_id', $id)
                    ->first();
        return $banner;
    }

    public function getAllBanners()
    {
        $banners = Banner::all();
        return $banners;
    }
}
