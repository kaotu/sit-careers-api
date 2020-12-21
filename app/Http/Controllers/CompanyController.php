<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Repositories\CompanyRepositoryInterface;
use App\Http\RulesValidation\CompanyRules;
use Validator;

class CompanyController extends Controller
{
    use CompanyRules;
    private $company;

    public function __construct(CompanyRepositoryInterface $company_repo)
    {
        $this->company = $company_repo;
    }

    public function get(Request $request)
    {
        $id = $request->all();
        $validated = Validator::make($data, $this->rulesCreationCompany);
        if ($validated->fails()) {
            return response()->json($validated->messages(), 400);
        }
        $company = $this->company->getCompanyById($id['company_id']);
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
        $validated = Validator::make($data, $this->rulesCreationCompany);
        if ($validated->fails()) {
            return response()->json($validated->messages(), 400);
        }
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