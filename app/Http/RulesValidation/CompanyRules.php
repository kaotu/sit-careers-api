<?php

namespace App\Http\RulesValidation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Validator;

trait CompanyRules
{
    private $rulesCreationCompany = [
        'company_name_th' => 'required|string',
        'company_name_en' => 'required|string',
        'company_type' => 'required|string',
        'description' => 'required|string',
        'about_us' => 'required|string',
        'start_business_day' => 'required|string',
        'end_business_day' => 'required|string',
        'start_business_time' => 'required|string',
        'end_business_time' => 'required|string',
        'e_mail_coordinator' => 'required|email|unique:companies',
        'e_mail_manager' => 'required|email|unique:companies',
        'website' => 'nullable|string',
        'tel_no' => 'nullable|max:10',
        'phone_no' => 'nullable|max:10',
        "address_one" => "required|string",
        "address_two" => "nullable|string",
        "lane" => "nullable|string",
        "road" => "nullable|string",
        "sub_district" => "required|string",
        "district" => "required|string",
        "province" => "required|string",
        "postal_code" => "required|string|max:5",
        "mou_link" => "nullable|string",
        "mou_type" => "nullable|string",
        "contact_period" => "nullable|string"
    ];

    private $rulesGetCompanyById = [
        'company_id' => 'required|string'
    ];
}