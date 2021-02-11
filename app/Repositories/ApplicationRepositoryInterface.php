<?php

namespace App\Repositories;

interface ApplicationRepositoryInterface
{
    public function getApplications();
    public function getApplicationById($id);
    public function createApplication($data);
    public function updateApplication($data);
    public function deleteApplicationById($id);
}
