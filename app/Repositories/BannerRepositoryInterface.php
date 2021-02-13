<?php

namespace App\Repositories;


interface BannerRepositoryInterface
{
    public function getBannerById($id);
    public function getAllBanners();
    public function createBanner($data);
}
