<?php

namespace App\Repositories;

interface CompanyRepositoryInterface
{
    public function getAllCompanies();
    public function getCompanyById($id);
    public function createCompany($data);
    public function updateCompanyById($data);
    public function deleteCompanyById($id);
}