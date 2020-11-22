<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Repositories\CompanyRepositoryInterface;

class CompanyController extends Controller
{
    private $company;

    public function __construct(CompanyRepositoryInterface $company_repo)
    {
        $this->company = $company_repo;
    }

    public function get(Request $request)
    {
        $id = $request->all()['company_id'];
        $company = $this->company->getCompanyById($id);
        return response()->json($company, 200);
    }

    public function getCompanies(Request $request)
    {
        $companies = $this->company->getAllCompanies();
        return response()->json($companies, 200);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $companies = $this->company->createCompany($data);
        return response()->json($companies, 200);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $updated = $this->company->updateCompanyById($data);
        return response()->json($updated, 200);
    }

    public function destroy(Request $request)
    {
        $id = $request->all()['company_id'];
        $deleted = $this->company->deleteCompanyById($id);
        return response()->json($deleted, 200);
    }
}