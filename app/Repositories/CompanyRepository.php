<?php

namespace App\Repositories;

use Carbon\Carbon;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use App\Models\Company;
use App\Models\Address;
use App\Models\MOU;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getCompanyById($id)
    {

        $company = Company::join('mou', 'mou.company_id', '=', 'companies.company_id')
        ->join('addresses', 'addresses.address_type_id', '=', 'companies.company_id')
        ->where('companies.company_id', $id)
        ->first();
        return $company;
    }

    public function getAllCompanies()
    {
        $companies = Company::join('mou', 'mou.company_id', '=', 'companies.company_id')
            ->join('addresses', 'addresses.address_type_id', '=', 'companies.company_id')
            ->where('addresses.address_type', '=', 'company')
            ->get();
        return $companies;
    }

    public function createCompany($data)
    {
        $company = new Company();
        $company->company_name_th = $data['company_name_th'];
        $company->company_name_en = $data['company_name_en'];
        $company->company_type = $data['company_type'];
        $company->description = $data['description'];
        $company->about_us = $data['about_us'];
        $company->logo = $data['logo'] == "" ? "-": $data['logo'];
        $company->e_mail_manager = $data['e_mail_manager'];
        $company->e_mail_coordinator = $data['e_mail_coordinator'];
        $company->tel_no = $data['tel_no'] == "" ? "-": $data['tel_no'];
        $company->phone_no = $data['phone_no'] == "" ? "-": $data['phone_no'];
        $company->website = $data['website'] == "" ? "-": $data['website'];
        $company->start_business_day = $data['start_business_day'];
        $company->end_business_day = $data['end_business_day'];
        $company->start_business_time = $data['start_business_time'];
        $company->end_business_time = $data['end_business_time'];
        $company->save();

        $address = new Address();
        $address->address_one = $data['address_one'];
        $address->address_two = $data['address_two'] == "" ? "-": $data['address_two'];
        $address->lane = $data['lane'] == "" ? "-": $data['lane'];
        $address->road = $data['road'] == "" ? "-": $data['road'];
        $address->sub_district = $data['sub_district'];
        $address->district = $data['district'];
        $address->province = $data['province'];
        $address->postal_code = $data['postal_code'];
        $address->address_type = 'company';
        $address->address_type_id = $company->company_id;
        $address->save();

        $mou = new MOU();
        $mou->company_id = $company->company_id;
        $mou->mou_link = $data['mou_link'] == "" ? "-": $data['mou_link'];
        $mou->mou_type = $data['mou_type'] == "" ? "-": $data['mou_type'];
        $mou->contact_period = $data['contact_period'] == "" ? "-": $data['contact_period'];
        $mou->save();

        return array_merge($company->toArray(),  $address->toArray(), $mou->toArray());
    }

    public function updateCompanyById($data)
    {
        $id = $data['company_id'];
        $company = Company::find($id);

        $company->company_name_th = $data['company_name_th'];
        $company->company_name_en = $data['company_name_en'];
        $company->company_type = $data['company_type'];
        $company->description = $data['description'];
        $company->about_us = $data['about_us'];
        $company->logo = $data['logo'] == "" ? "-": $data['logo'];
        $company->e_mail_manager = $data['e_mail_manager'];
        $company->e_mail_coordinator = $data['e_mail_coordinator'];
        $company->tel_no = $data['tel_no'] == "" ? "-": $data['tel_no'];
        $company->phone_no = $data['phone_no'] == "" ? "-": $data['phone_no'];
        $company->website = $data['website'] == "" ? "-": $data['website'];
        $company->start_business_day = $data['start_business_day'];
        $company->end_business_day = $data['end_business_day'];
        $company->start_business_time = $data['start_business_time'];
        $company->end_business_time = $data['end_business_time'];
        $company->save();

        $address = Address::where('address_type_id', $id)->first();
        $address->address_one = $data['address_one'];
        $address->address_two = $data['address_two'] == "" ? "-": $data['address_two'];
        $address->lane = $data['lane'] == "" ? "-": $data['lane'];
        $address->road = $data['road'] == "" ? "-": $data['road'];
        $address->sub_district = $data['sub_district'];
        $address->district = $data['district'];
        $address->province = $data['province'];
        $address->postal_code = $data['postal_code'];
        $address->address_type = 'company';
        $address->address_type_id = $company->company_id;
        $address->save();

        $mou = MOU::where('company_id', $id)->first();
        $mou->company_id = $company->company_id;
        $mou->mou_link = $data['mou_link'] == "" ? "-": $data['mou_link'];
        $mou->mou_type = $data['mou_type'] == "" ? "-": $data['mou_type'];
        $mou->contact_period = $data['contact_period'] == "" ? "-": $data['contact_period'];
        $mou->save();

        return array_merge($company->toArray(),  $address->toArray(), $mou->toArray());
    }

    public function deleteCompanyById($id)
    {
        $company = Company::find($id);
        $address = Address::where('address_type_id', $id)->first();
        $mou = MOU::where('company_id', $id)->first();

        if($company && $address && $mou) {
            $deleted_company = $company->delete();
            $deleted_address = $address->delete();
            $deleted_mou = $mou->delete();
            return $deleted_company && $deleted_address && $deleted_mou;
        }

        return "Find not found company or mou or address.";
    }
}
